<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID', '222301579012442'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET', '35dff5de62e57546ce2685fe08e87d99'),
        'redirect' => env('APP_URL') . '/login/facebook/callback',
    ],
    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID', '151932329530-i03gp2b0u6obcvpjpd50avo8mt3ej43i.apps.googleusercontent.com'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET', '8rAo44KnOfEl4RONti9a4MEE'),
        'redirect' => env('APP_URL') . '/login/google/callback',
    ],

];
