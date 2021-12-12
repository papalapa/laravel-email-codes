<?php /* @var \Papalapa\Laravel\EmailCodes\Models\EmailCode $emailCode */ ?>

@component('mail::message')
{{ __('email-codes.your_code_is') }}

@component('mail::button', ['url' => $url])
    View Order
@endcomponent

Thanks!

{{ config('app.name') }}
@endcomponent
