<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Email Codes settings and credentials
    |--------------------------------------------------------------------------
    */

    'mailer' => env('EMAIL_CODES_MAILER'),

    'address' => env('EMAIL_CODES_ADDRESS', ''),

    'name' => env('EMAIL_CODES_NAME', env('APP_NAME')),

    'plaintext' => env('EMAIL_CODES_PLAINTEXT', false),

    'fake_send' => env('EMAIL_CODES_FAKE_SEND', true),

    'code_size' => env('EMAIL_CODES_CODE_SIZE', 6),

    'code_lifetime' => env('EMAIL_CODES_CODE_LIFETIME', 120),

    'token_lifetime' => env('EMAIL_CODES_TOKEN_LIFETIME', 600),

    'queue_connection' => env('EMAIL_CODES_QUEUE_CONNECTION'),

    'throttling_limit' => env('EMAIL_CODES_THROTTLING_LIMIT', 2),

];
