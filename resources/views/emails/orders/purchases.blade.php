<x-mail::message>
# Introduction
Client id: {{ $orderpurchases->user_id }}

The body of your message.

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
