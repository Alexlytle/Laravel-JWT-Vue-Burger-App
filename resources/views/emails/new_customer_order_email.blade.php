{{-- @component('mail::message') --}}

@php
     $data= json_decode($burger);
@endphp

<h1>Order</h1>
<p>Name:{{$name}}</p>
<p>Email:{{$email}}</p>
<p>Phone:{{$phone}}</p>
<p>Zip:{{$zip}}</p>
<p>City:{{$city}}</p>


{{-- <p>Fries: {{$data[0]->fries[0]->quantity}}</p>

<p>Sprite:  {{$data[1]->drink[0]->Pepsi[0]->quantity}}</p> --}}