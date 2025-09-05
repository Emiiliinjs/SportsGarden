<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewsController extends Controller
{
    // Show all sports news
    public function index()
    {
        $news = $this->fetchNews();
        return view('welcome', ['news' => $news]);
    }

    // Show news by category (soccer, basketball, tennis)
    public function category($category)
    {
        $news = $this->fetchNews($category);
        return view('welcome', ['news' => $news]);
    }

    // Helper function to fetch news from NewsAPI
    private function fetchNews($category = null)
    {
        // Default params
        $params = [
            'pageSize'   => 9,
            'language'   => 'en',
        ];

        // Endpoint logic
        if ($category === 'basketball') {
            // Use everything endpoint for NBA/WNBA
            $endpoint = 'https://newsapi.org/v2/everything';
            $params['q'] = 'NBA OR WNBA OR basketball';
            $params['sortBy'] = 'publishedAt';
        } else {
            // Use top-headlines for general sports
            $endpoint = 'https://newsapi.org/v2/top-headlines';
            $params['category'] = 'sports';
            $params['country']  = 'us';

            if ($category) {
                // Allow filtering by keyword (soccer, tennis, etc.)
                $params['q'] = $category;
            }
        }

        // Send request with API key in header
        $response = Http::withHeaders([
            'X-Api-Key' => env('NEWS_API_KEY'),
        ])->get($endpoint, $params);

        // Debug if request fails
        if (!$response->successful()) {
            return [
                [
                    'title'       => 'Unable to fetch live news',
                    'description' => 'Please try again later.',
                    'urlToImage'  => 'https://source.unsplash.com/400x250/?sports',
                    'url'         => '#',
                    'source'      => ['name' => 'Unknown'],
                    'publishedAt' => null,
                ]
            ];
        }

        $data = $response->json();

        return $data['articles'] ?? [
            [
                'title'       => 'No news available at the moment.',
                'description' => 'Please check back later.',
                'urlToImage'  => 'https://source.unsplash.com/400x250/?sports',
                'url'         => '#',
                'source'      => ['name' => 'Unknown'],
                'publishedAt' => null,
            ]
        ];
    }
}
