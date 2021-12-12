<?php

namespace Papalapa\Laravel\EmailCodes\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\MailManager;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Papalapa\Laravel\EmailCodes\EmailMessage;
use Papalapa\Laravel\EmailCodes\Mail\CodeMail;

final class EmailMessageJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $timeout = 5;

    public function __construct(
        private EmailMessage $message
    ) {
    }

    public function handle(MailManager $mailManager, Repository $config): void
    {
        $mailer = $config->get('email-codes.mailer');
        $mailManager->mailer($mailer)->send(new CodeMail($this->message));
    }
}
