@component('mail::message')
# Welcome {{$name}}
Now you are a member of LARAGRAM.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
