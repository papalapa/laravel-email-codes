<?php

namespace Papalapa\Laravel\EmailCodes\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Papalapa\Laravel\EmailCodes\EmailMessage;

class CodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        private EmailMessage $message,
    ) {
    }

    public function build(): self
    {
        $address = (string)config('email-codes.address');
        $name = (string)config('email-codes.name');
        $plaintext = (bool)config('email-codes.plaintext');

        return $this
            ->from($address, $name)
            ->to($this->message->email()->email())
            ->setContent($plaintext);
    }

    private function setContent(bool $plaintext): self
    {
        if ($plaintext) {
            return $this->text(vsprintf('%s: %s', [
                'text' => __('email-codes.your_code_is'),
                'code' => $this->message->code(),
            ]));
        }

        return $this->markdown('email-codes.mail', [
            'code' => $this->message->code(),
        ]);
    }
}
