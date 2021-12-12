<?php

namespace Papalapa\Laravel\EmailCodes\Services;

use Papalapa\Laravel\EmailCodes\Models\EmailCode;
use Papalapa\Laravel\EmailCodes\Email;

final class CodeCreator
{
    public function __construct(private CodeGenerator $codeGenerator)
    {
    }

    public function create(Email $email): EmailCode
    {
        $code = new EmailCode([
            'email' => $email->email(),
            'code' => $this->codeGenerator->generate(),
        ]);

        if (!$code->save()) {
            throw new \PDOException(__('email-codes.code_creation_failed'));
        }

        return $code;
    }
}
