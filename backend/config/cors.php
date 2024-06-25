<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie', 'login', 'logout'],
    'allowed_methods' => ['*'],
    // 'allowed_origins' => [env('FRONTEND_URL', 'http://localhost:5173')],
    'allowed_origins' => ['*'],
    // 'allowed_headers' => ['Authorization', 'Content-Type', 'Accept', 'X-Requested-With'],
    'allowed_headers' => ['Content-Type', 'Authorization'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true,
];
