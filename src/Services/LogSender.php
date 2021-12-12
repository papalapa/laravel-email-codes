<?php

namespace Papalapa\Laravel\EmailCodes\Services;

use Illuminate\Log\Logger;
use Papalapa\Laravel\EmailCodes\Contracts\SenderContract;
use Papalapa\Laravel\EmailCodes\EmailMessage;

final class LogSender implements SenderContract
{
    public function __construct(private Logger $logger)
    {
    }

    public function send(EmailMessage $emailMessage): void
    {
        $message = sprintf('Email code to %s is: %s', $emailMessage->email()->email(), $emailMessage->code());

        $this->logger->info($message);
    }
}
