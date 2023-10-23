<x-mail::message>
# Hello

We'd like to inform you, the request to use email based authentication to access Hajime portal **has been declined**.

**{{ $user->email }}** email address cannot be used for that purpose.

Apologies for the inconvenience.

<x-mail::button :url="''">
Hajime Portal
</x-mail::button>

Thank you,<br>
{{ config('app.name') }}
</x-mail::message>
