<x-mail::message>
# Hello
Your account to Hajime Portal has been activated.

You can now login and view your club's data.

Your details: {{ $user->email }}

Your club: {{ $user->club_manager->name }}

<x-mail::button :url="$url">
Login
</x-mail::button>

Thank you,<br>
{{ config('app.name') }}
</x-mail::message>
