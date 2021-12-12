<?php

namespace Papalapa\Laravel\EmailCodes\Services;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Encryption\Encrypter;
use Papalapa\Laravel\EmailCodes\CodeToken;
use Papalapa\Laravel\EmailCodes\Email;
use Papalapa\Laravel\EmailCodes\Exceptions\DecryptTokenException;
use Papalapa\Laravel\EmailCodes\Exceptions\ExpiredTokenException;
use Papalapa\Laravel\EmailCodes\Exceptions\InvalidTokenException;

final class TokenGenerator
{
    public function __construct(private Encrypter $encrypter, private int $lifetime)
    {
    }

    public function generate(Email $phoneNumber): string
    {
        $token = CodeToken::create($phoneNumber, $this->lifetime);

        return $this->encrypter->encrypt($token);
    }

    public function validate(string $data): Email
    {
        try {
            $token = $this->encrypter->decrypt($data);
            if (!($token instanceof CodeToken)) {
                throw new InvalidTokenException(__('email-codes.invalid_token'));
            }
            if (!$token->isStillValid()) {
                throw new ExpiredTokenException(__('email-codes.expired_token'));
            }
        } catch (DecryptException) {
            throw new DecryptTokenException(__('email-codes.token_decryption_failed'));
        }

        return $token->getEmail();
    }
}
