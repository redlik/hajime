<x-mail::message>
# Hello
You've been invited to join Hajime - Irish Judo Association membership portal.

To activate your account click on the link below to setup your password.

The portal uses 2 Factor authentication so make sure you have an app such as Google Authenticator or Authy installed or your smartphone.

Your details: {{ $user->email }}

Your club: {{ $user->club_manager->name }}

<x-mail::button :url="$url">
Activate account
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
