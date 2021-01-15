@component('mail::message')
# Introduction

The body of your message.

Hi {{ $member->first_name }} {{ $member->last_name }}

Your membership **{{ $membership->membership_type }}** starts on {{ $membership->join_date }} and will expire on {{
$membership->expiry_date }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
