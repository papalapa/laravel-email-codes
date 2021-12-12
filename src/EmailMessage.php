<?php

namespace Papalapa\Laravel\EmailCodes;

final class EmailMessage
{
    public function __construct(
        private Email $email,
        private string $code,
    ) {
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function code(): string
    {
        return $this->code;
    }
}
