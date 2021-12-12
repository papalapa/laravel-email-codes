<?php

namespace Papalapa\Laravel\EmailCodes\Contracts;

use Papalapa\Laravel\EmailCodes\EmailMessage;

interface SenderContract
{
    public function send(EmailMessage $emailMessage): void;
}
