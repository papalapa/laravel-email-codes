<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Email Codes settings and credentials
    |--------------------------------------------------------------------------
    */

    // Mailer
    'mailer' => env('EMAIL_CODES_MAILER'),

    // From name
    'address' => env('EMAIL_CODES_ADDRESS', ''),

    // App name
    'name' => env('EMAIL_CODES_NAME', env('APP_NAME')),

    // Subject translation key
    'subject' => env('EMAIL_CODES_SUBJECT_KEY'),

    // Use plaintext message instead of markdown
    'plaintext' => env('EMAIL_CODES_PLAINTEXT', false),

    // Do not really send
    'fake_send' => env('EMAIL_CODES_FAKE_SEND', true),

    // Code numbers count
    'code_size' => env('EMAIL_CODES_CODE_SIZE', 6),

    // Code lifetime
    'code_lifetime' => env('EMAIL_CODES_CODE_LIFETIME', 120),

    // Token lifetime
    'token_lifetime' => env('EMAIL_CODES_TOKEN_LIFETIME', 600),

    // Queue connection
    'queue_connection' => env('EMAIL_CODES_QUEUE_CONNECTION'),

    // Throttling
    'throttling_limit' => env('EMAIL_CODES_THROTTLING_LIMIT', 2),

];
