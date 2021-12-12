<?php

namespace Papalapa\Laravel\EmailCodes\Services;

use Papalapa\Laravel\EmailCodes\Exceptions\InvalidEmailCodeException;
use Papalapa\Laravel\EmailCodes\Models\EmailCode;
use Papalapa\Laravel\EmailCodes\Email;

final class CodeValidator
{
    public function __construct(private int $lifetime)
    {
    }

    public function ensure(Email $email, string $code): void
    {
        if (false === $this->validate($email, $code)) {
            throw new InvalidEmailCodeException(__('email-codes.invalid_code'));
        }
    }

    public function validate(Email $email, string $code): bool
    {
        $emailCode = $this->findLatest($email, $code);

        if ($emailCode instanceof EmailCode) {
            $emailCode->delete();

            return $emailCode->isAliveAfter($this->lifetime);
        }

        return false;
    }

    private function findLatest(Email $email, string $code): ?EmailCode
    {
        $emailCode = EmailCode::query()
            ->where('email', '=', $email->email())
            ->where('code', '=', $code)
            ->orderByDesc('serial')
            ->first();

        if ($emailCode instanceof EmailCode) {
            return $emailCode;
        }

        return null;
    }
}
