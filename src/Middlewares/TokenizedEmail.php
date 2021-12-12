<?php

namespace Papalapa\Laravel\EmailCodes\Middlewares;

use Illuminate\Http\Request;
use Papalapa\Laravel\EmailCodes\Email;
use Papalapa\Laravel\EmailCodes\Services\TokenGenerator;

final class TokenizedEmail
{
    public const TOKENIZED_EMAIL = 'tokenizedEmail';

    public function __construct(private TokenGenerator $tokenGenerator)
    {
    }

    public static function getEmail(Request $request): Email
    {
        return $request->attributes->get(self::TOKENIZED_EMAIL);
    }

    public function handle(Request $request, \Closure $next)
    {
        $token = $request->input('token');
        $email = $this->tokenGenerator->validate($token);
        $request->attributes->set(self::TOKENIZED_EMAIL, $email);

        return $next($request);
    }
}
