<?php

namespace Papalapa\Laravel\EmailCodes\Services;

use Papalapa\Laravel\EmailCodes\Contracts\SenderContract;
use Papalapa\Laravel\EmailCodes\Email;
use Papalapa\Laravel\EmailCodes\EmailMessage;
use Papalapa\Laravel\EmailCodes\Models\EmailCode;

final class MessageHandler
{
    public function __construct(
        private SenderContract $sender,
        private CodeCreator $codeCreator,
        private CodeValidator $codeChecker,
        private TokenGenerator $tokenGenerator,
    ) {
    }

    public function sendCode(Email $email): EmailMessage
    {
        $code = $this->codeCreator->create($email);

        return $this->send($email, $code->code);
    }

    private function send(Email $email, string $code): EmailMessage
    {
        $message = new EmailMessage($email, $code);
        $this->sender->send($message);

        return $message;
    }

    public function validateCode(Email $email, string $code): bool
    {
        return $this->codeChecker->validate($email, $code);
    }

    public function generateToken(Email $email): string
    {
        return $this->tokenGenerator->generate($email);
    }

    public function validateToken(string $data): Email
    {
        return $this->tokenGenerator->validate($data);
    }
}
