<?php /* @var string $code */ ?>

@component('mail::message')
# {{ __('email-codes.your_code_is') }}

@component('mail::panel')
{{ $code }}
@endcomponent

@component('mail::subcopy')
This message was sent automatically, do not reply to it.
@endcomponent

Thanks! Your [{{ config('app.name') }}]({{ config('app.url') }})
@endcomponent
