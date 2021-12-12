<?php

namespace Papalapa\Laravel\EmailCodes;

use Papalapa\Laravel\EmailCodes\Exceptions\InvalidEmailException;

final class Email
{
    private string $email;

    public function __construct(string $email)
    {
        $this->email = $this->validate($email);
    }

    public function email(): string
    {
        return $this->email;
    }

    private function validate(string $email): string
    {
        if ($this->isValid($email)) {
            return $email;
        }

        throw new InvalidEmailException(__('email_code.invalid_email'));
    }

    private function isValid(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
