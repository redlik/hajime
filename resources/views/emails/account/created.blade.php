<x-mail::message>
# Hello,
New user account has been created

**Name:** {{ $user->name }}

**Email:** {{ $user->email }}

**Club:** {{ $user->club_manager->name }}

**Date:** {{ $user->created_at->format('d M Y') }}

<x-mail::button :url="$url">
View user
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
