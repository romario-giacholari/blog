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
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model'       => App\User::class,
        'key'         => env('STRIPE_KEY'),
        'secret'      => env('STRIPE_SECRET'),
        'success_url' => env('STRIPE_SUCCESS_URL', 'https://giacholari.com/coffee/success'),
        'cancel_url'  => env('STRIPE_CANCEL_URL', 'https://giacholari.com/coffee/cancel'),
    ],

    'photos' => [
        'gallery' => [
            'endpoint' => 'https://assets.giacholari.com/json/images-meta-data.json',
        ],
    ],

    'cv' => [
        'endpoint' => 'https://assets.giacholari.com/pdf/cv.pdf',
    ],

    'privacy' => [
        'endpoint' => 'https://assets.giacholari.com/json/privacy.json',
    ],

    'post' => [
        'pagination' => [
            'limit' => 15,
        ]
    ]
];
