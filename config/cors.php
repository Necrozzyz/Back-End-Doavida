<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Configurações de CORS
    |--------------------------------------------------------------------------
    |
    | Aqui você pode configurar as políticas de CORS da sua aplicação.
    | Isso determina quais origens podem acessar seus recursos, quais métodos
    | HTTP são permitidos e outras configurações.
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'], // Permite todos os métodos HTTP

    'allowed_origins' => ['http://loacalhost:3000'], // Permite todas as origens

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'], // Permite todos os headers

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,
];
