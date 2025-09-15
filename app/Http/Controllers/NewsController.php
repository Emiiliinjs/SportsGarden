<?php

namespace App\Http\Controllers;

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
        $news  = $this->fetchNews(null, $query);

        return view('welcome', ['news' => $news]);
    }

    /**
     * Show news by category
     */
    public function category($category, Request $request)
    {
        $query = $request->input('query'); // Optional search within category
        $news  = $this->fetchNews($category, $query);

        return view('welcome', ['news' => $news]);
    }

    /**
     * Helper: fetch news from NewsAPI
     */
    private function fetchNews($category = null, $query = null)
    {
        $apiKey  = config('services.sports_api.key');
        $baseUrl = config('services.sports_api.base_url', 'https://newsapi.org/v2/');

        // Default params
        $params = [
            'pageSize' => 9,
            'language' => 'en',
            'country'  => 'us',
            'category' => 'sports',
        ];

        // Add filters
        if ($query) {
            // User search overrides category
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

        // Always use top-headlines with sports category
        $response = Http::withHeaders([
            'X-Api-Key' => $apiKey,
        ])->get($baseUrl . 'top-headlines', $params);

        // Error fallback
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
}
