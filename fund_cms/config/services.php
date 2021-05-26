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
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],
   'braintree' => [
    'model'  => App\Models\User::class,
    'environment' => env('BRAINTREE_ENV'),
    'merchant_id' => env('BRAINTREE_MERCHANT_ID'),
    'public_key' => env('BRAINTREE_PUBLIC_KEY'),
    'private_key' => env('BRAINTREE_PRIVATE_KEY'),
    ],
    'stripe' => [
        'model' => App\Models\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
      'client_id' => "249006893048925", // configure with your app id
      'client_secret' => '661c1a41cfa9385cd1dff77e3dfce9fc', // your app secret
      'redirect' => ('/oauth/facebook/callback'), // IMPORTANT NOT REMOVE /oauth/facebook/callback
      //'redirect' => app('url')->to('/oauth/facebook/callback'), // IMPORTANT NOT REMOVE /oauth/facebook/callback
      ],




    'twitter' => [
      'client_id' => "APP_ID", // configure with your app id
      'client_secret' => 'APP_SECRET', // your app secret
      'redirect' => 'http://YOURSITE.COM/oauth/twitter/callback', // IMPORTANT NOT REMOVE /oauth/twitter/callback
      ],

];