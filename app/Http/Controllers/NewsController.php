<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewsController extends Controller
{
    /**
     * Show sports news or search results
     */
    public function index(Request $request)
    {
        $query = $request->input('query'); // Search query
        $articles = $this->fetchNews(null, $query);

        // Save/update articles in DB
        foreach ($articles as $item) {
            News::updateOrCreate(
                ['title' => $item['title']],
                [
                    'description'  => $item['description'] ?? '',
                    'url'          => $item['url'] ?? '',
                    'image'        => $item['urlToImage'] ?? '',
                    'source'       => $item['source']['name'] ?? '',
                    'published_at' => $item['publishedAt'] ?? null,
                ]
            );
        }

        // Fetch news from DB with search filter if query exists
        if ($query) {
            $news = News::where('title', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%")
                        ->latest()
                        ->take(12)
                        ->get();
        } else {
            $news = News::latest()->take(12)->get();
        }

        return view('welcome', ['news' => $news]);
    }

    /**
     * Show news by category (soccer, basketball, tennis)
     */
    public function category($category, Request $request)
    {
        $query = $request->input('query'); // Optional search within category
        $articles = $this->fetchNews($category, $query);

        // Save/update articles in DB
        foreach ($articles as $item) {
            News::updateOrCreate(
                ['title' => $item['title']],
                [
                    'description'  => $item['description'] ?? '',
                    'url'          => $item['url'] ?? '',
                    'image'        => $item['urlToImage'] ?? '',
                    'source'       => $item['source']['name'] ?? '',
                    'published_at' => $item['publishedAt'] ?? null,
                ]
            );
        }

        // Fetch news from DB filtered by category and optional search
        $newsQuery = News::query();

        if ($category) {
            $newsQuery->where('description', 'like', "%{$category}%")
                      ->orWhere('title', 'like', "%{$category}%");
        }

        if ($query) {
            $newsQuery->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            });
        }

        $news = $newsQuery->latest()->take(12)->get();

        return view('welcome', ['news' => $news]);
    }

    /**
     * Fetch news from NewsAPI
     */
    private function fetchNews($category = null, $query = null)
    {
        $apiKey  = config('services.sports_api.key');
        $baseUrl = config('services.sports_api.base_url', 'https://newsapi.org/v2/');

        $params = [
            'pageSize' => 12,
            'language' => 'en',
            'category' => 'sports',
        ];

        if ($query) {
            $params['q'] = $query;
        } elseif ($category) {
            switch ($category) {
                case 'basketball':
                    $params['q'] = 'basketball OR NBA OR WNBA';
                    break;
                case 'soccer':
                    $params['q'] = 'soccer OR football';
                    break;
                case 'tennis':
                    $params['q'] = 'tennis OR ATP OR WTA';
                    break;
                default:
                    $params['q'] = $category;
                    break;
            }
        }

        $response = Http::withHeaders([
            'X-Api-Key' => $apiKey,
        ])->get($baseUrl . 'top-headlines', $params);

        if (!$response->successful()) {
            return [[
                'title'       => 'Unable to fetch live news',
                'description' => 'Please try again later.',
                'urlToImage'  => 'https://source.unsplash.com/400x250/?sports',
                'url'         => '#',
                'source'      => ['name' => 'Unknown'],
                'publishedAt' => null,
            ]];
        }

        $data = $response->json();

        return $data['articles'] ?? [[
            'title'       => 'No news available at the moment.',
            'description' => 'Please check back later.',
            'urlToImage'  => 'https://source.unsplash.com/400x250/?sports',
            'url'         => '#',
            'source'      => ['name' => 'Unknown'],
            'publishedAt' => null,
        ]];
    }

    /**
     * Show a single news item
     */
    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }
}
