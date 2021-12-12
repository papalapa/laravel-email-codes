<?php /* @var string $code */ ?>

@component('mail::message')
# {{ __('email-codes.your_code_is') }}

@component('mail::panel')
{{ $code }}
@endcomponent

Thanks!

[{{ config('app.url') }}]({{ config('app.name') }})
@endcomponent
