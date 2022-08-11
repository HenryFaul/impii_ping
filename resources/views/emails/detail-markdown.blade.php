@component('mail::message')
Dear {{$user->first_name}} {{$user->last_name}}

We have received your security detail request with the following details:

@component('mail::table')
| Item       | value         |
| :--------- | :------------- |
| Start date | {{$detail->start_date}} |
| Planned end date | {{$detail->planned_end_date}} |
| Briefing | {{$detail->client_briefing}} |
| Address | {{$detail->address}} |
| City | {{$detail->city}} |
@endcomponent


@component('mail::button', ['url' => 'https://app.impii.co.za/login'])
LOG IN
@endcomponent

Kind Regards,<br>

The Impii Team

<a href="https://impii.co.za/terms-conditions/">** Terms & Conditions</a>
@endcomponent
