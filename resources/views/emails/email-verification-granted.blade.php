<x-mail::message>
# Hello

Your request to use email based authentication for Hajime access has been granted.

Please make sure you have access to this email **{{ $user->email }}** when making connection to the portal

<x-mail::button :url="$url">
Hajime Portal
</x-mail::button>

Thank you,<br>
{{ config('app.name') }}
</x-mail::message>
