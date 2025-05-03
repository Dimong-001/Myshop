<?php

// return [

//     'paths' => ['api/*', 'sanctum/csrf-cookie'],

//     'allowed_methods' => ['*'],

//     'allowed_origins' => ['http://localhost:3000'], // your Nuxt dev server

//     'allowed_headers' => ['*'],

//     'exposed_headers' => [],

//     'max_age' => 0,

//     'supports_credentials' => false, // ✅ important — disables session-based auth

// ];

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie', '*'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['*'], // In production, limit this to your frontend domain
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];

