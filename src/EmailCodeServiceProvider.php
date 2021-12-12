<?php

namespace Papalapa\Laravel\EmailCodes;

use Illuminate\Support\ServiceProvider;
use Papalapa\Laravel\EmailCodes\Contracts\SenderContract;
use Papalapa\Laravel\EmailCodes\Middlewares\ThrottleRequests;
use Papalapa\Laravel\EmailCodes\Services\CodeGenerator;
use Papalapa\Laravel\EmailCodes\Services\CodeValidator;
use Papalapa\Laravel\EmailCodes\Services\GatewaySender;
use Papalapa\Laravel\EmailCodes\Services\LogSender;
use Papalapa\Laravel\EmailCodes\Services\TokenGenerator;

final class EmailCodeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerPublishable();

        $this->mergeConfigFrom(__DIR__ . '/../config/email-codes.php', 'email-codes');

        $this->app->when(CodeGenerator::class)
            ->needs('$size')->give(config('email-codes.code_size'));

        $this->app->when(CodeValidator::class)
            ->needs('$lifetime')->give(config('email-codes.code_lifetime'));

        $this->app->when(TokenGenerator::class)
            ->needs('$lifetime')->give(config('email-codes.token_lifetime'));

        $this->app->when(GatewaySender::class)
            ->needs('$connection')->give(config('email-codes.queue_connection'));

        $this->app->when(ThrottleRequests::class)
            ->needs('$limit')->give(config('email-codes.throttling_limit'));
    }

    protected function registerPublishable(): void
    {
        $this->publishes([
            __DIR__ . '/../config/email-codes.php' => config_path('email-codes.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/../resources/lang/en/email-codes.php' => resource_path('lang/en/email-codes.php'),
            __DIR__ . '/../resources/lang/ru/email-codes.php' => resource_path('lang/ru/email-codes.php'),
        ], 'lang');

        $this->publishes([
            __DIR__ . '/../resources/views/email-codes/mail.blade.php' => resource_path('views/email-codes/mail.blade.php'),
        ], 'views');

        $this->publishes([
            __DIR__ . '/../database/migrations/stub_create_email_codes_table.php'
            => database_path('migrations/' . date('Y_m_d_His') . '_create_email_codes_table.php'),
        ], 'migrations');
    }

    public function register(): void
    {
        $sender = config('email-codes.fake_send') ? LogSender::class : GatewaySender::class;
        $this->app->bind(SenderContract::class, $sender);
    }
}
