<?php

namespace Papalapa\Laravel\EmailCodes\Services;

use Illuminate\Bus\Dispatcher;
use Papalapa\Laravel\EmailCodes\Contracts\SenderContract;
use Papalapa\Laravel\EmailCodes\EmailMessage;
use Papalapa\Laravel\EmailCodes\Jobs\EmailMessageJob;

final class GatewaySender implements SenderContract
{
    public function __construct(
        private Dispatcher $jobDispatcher,
        private ?string $connection = null
    ) {
    }

    public function send(EmailMessage $emailMessage): void
    {
        $job = new EmailMessageJob($emailMessage);
        $job->onConnection($this->connection);
        $this->jobDispatcher->dispatch($job);
    }
}
