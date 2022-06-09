@component('mail::message')
# Introduction

{{-- New message from {{$name}}


 {{$email}}
 <br>
 {{$message}} --}}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
