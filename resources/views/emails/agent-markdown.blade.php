@component('mail::message')
Dear {{$user->first_name}} {{$user->last_name}}

We have assigned an agent to your security detail.

**Security details:**

@component('mail::table')
| Item       | value         |
| :--------- | :------------- |
| Start date | {{$detail->start_date}} |
| Planned end date | {{$detail->planned_end_date}} |
| Briefing | {{$detail->client_briefing}} |
| Address | {{$detail->address}} |
| City | {{$detail->city}} |
@endcomponent

**Agent details:**

@component('mail::table')
| Item       | value         |
| :--------- | :------------- |
| Agent: |  {{$agent_user[0]->first_name}} {{$agent_user[0]->last_name}}  |
| Tag line: | {{$agent_user[0]->agentdetail->tag_line}}
@endcomponent


@component('mail::button', ['url' => $agent_url])
VIEW AGENT
@endcomponent

Kind Regards,<br>

The Impii Team
@endcomponent
