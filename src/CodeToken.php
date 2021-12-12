<?php

namespace Papalapa\Laravel\EmailCodes;

use Carbon\Carbon;

final class CodeToken
{
    private int $expireAt;

    public function __construct(private Email $email, int $lifetime)
    {
        $this->expireAt = Carbon::now()->addSeconds($lifetime)->getTimestamp();
    }

    public static function create(Email $email, int $lifetime): self
    {
        return new self(...func_get_args());
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function isStillValid(): bool
    {
        return Carbon::now()->timestamp < $this->expireAt;
    }
}
