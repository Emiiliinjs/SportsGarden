<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Sports API
    |--------------------------------------------------------------------------
    |
    | This is your Sports API key used for fetching news and other sports data.
    |
    */
    'sports_api' => [
    'key' => env('NEWS_API_KEY'),
    'base_url' => env('NEWS_API_BASE_URL', 'https://newsapi.org/v2/'),
],

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | Credentials for third party services like Mailgun, Postmark, AWS, Slack, etc.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

];
