<x-mail::message>
# Hello admins

The user **{{ $user->name }}** from club **{{ $user->club_manager->name }}** with **{{ $user->email }}** address requested the authentication via email.

<x-mail::button :url="$url">
View Dashboard
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
