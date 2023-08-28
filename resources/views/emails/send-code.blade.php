<x-mail::message>
# Hello

Email verification code for Hajime portal:

## {{ $code }}

This code will be valid for 2 minutes only.

<x-mail::button :url="$url">
Hajime Portal
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
