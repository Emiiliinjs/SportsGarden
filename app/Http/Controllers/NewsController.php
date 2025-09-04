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

    // Show news by category (football, basketball, tennis)
    public function category($category)
    {
        $news = $this->fetchNews($category);
        return view('welcome', ['news' => $news]);
    }

    // Helper function to fetch news from NewsAPI
    private function fetchNews($category = null)
    {
        $params = [
            'country' => 'us',
            'pageSize' => 9,
            'category' => 'sports', // general sports
        ];

        if ($category) {
            $params['q'] = $category; // filter by keyword
        }

        // Correctly send API key via X-Api-Key header
        $response = Http::withHeaders([
            'X-Api-Key' => env('NEWS_API_KEY'),
        ])->get('https://newsapi.org/v2/top-headlines', $params);

        // Debug if request fails
        if (!$response->successful()) {
            dd($response->status(), $response->body());
        }

        $data = $response->json();

        return $data['articles'] ?? [
            [
                'title' => 'Unable to fetch live news',
                'description' => 'Please try again later.',
                'urlToImage' => 'https://source.unsplash.com/400x250/?sports',
                'url' => '#',
                'source' => ['name' => 'Unknown'],
                'publishedAt' => null,
            ]
        ];
    }
}
