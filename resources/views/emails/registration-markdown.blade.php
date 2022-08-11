@component('mail::message')
Dear {{$user->first_name}} {{$user->last_name}}

Our mission is to keep you save with our awesome app and dedicated protection agents.

@component('mail::panel')
As a welcoming gift here is free **R400** voucher for your first security experience.

Voucher Key: **{{$voucher->voucher_key}}**

Description: {{$voucher->description}}
@endcomponent


P.S Our 24/7 Panic button is free to use so tell your friends about us...

@component('mail::button', ['url' => 'https://app.impii.co.za/login'])
LOG IN
@endcomponent

Kind Regards,<br>

The Impii Team

<a href="https://impii.co.za/terms-conditions/">** Terms & Conditions</a>
@endcomponent
