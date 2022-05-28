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
        $subject = (string)__(config('email-codes.subject', 'email-codes.code_description'));

        return $this
            ->from($address, $name)
            ->to($this->message->email()->email())
            ->setContent($plaintext)
            ->subject($subject);
    }

    private function setContent(bool $plaintext): self
    {
        $code = preg_replace(
            '/^(\d{3})(\d{3})$/',
            '$1 $2',
            $this->message->code()
        );

        if ($plaintext) {
            return $this->html(vsprintf('%s: %s', [
                'text' => __('email-codes.your_code_is'),
                'code' => $code,
            ]));
        }

        return $this->markdown('email-codes.mail', [
            'code' => $code,
        ]);
    }
}
