@component('mail::message')



@php
     $data= json_decode($burger);
@endphp

<h1>Order</h1>
<p>Name:{{$name}}</p>
<p>Email:{{$email}}</p>
<p>Phone:{{$phone}}</p>
<p>Zip:{{$zip}}</p>
<p>City:{{$city}}</p>

@dump($data)

Thanks,<br>
{{ config('app.name') }}
@endcomponent
