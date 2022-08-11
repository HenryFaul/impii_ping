@component('mail::message')
Dear {{$user->first_name}} {{$user->last_name}}

We have received your emergency with the following details:

@component('mail::table')
    | Item       | value         |
    | :--------- | :------------- |
    | Emergency type | {{$emergency->type}} |
    | Emergency address | {{$emergency->address}} |
    | Emergency details | {{$emergency->emergency_details}} |
    | Browser pin | {{$emergency->browser_lat}} {{$emergency->browser_long}}|
    | Contact no | {{$user->cell_no}} |
@endcomponent

@component('mail::button', ['url' => 'https://app.impii.co.za/login'])
LOG IN
@endcomponent

Our team will contact you now.

Kind Regards,<br>

The Impii Team

<a href="https://impii.co.za/terms-conditions/">** Terms & Conditions</a>
@endcomponent
