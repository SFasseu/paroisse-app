@extends('layouts.auth')

@section('content')
<a href="{{ url('/') }}" class="text-nowrap logo-img text-center d-block py-3 w-100">
  <img width="8%" src="{{ asset('charitize/img/logo.png') }}" alt="">
  <h3 style="color: #e68908;font-family: 'josefin Sans' !important; font-weight: bold;">Holy Spirit Bepanda</h3>
</a>
@if (session('resent'))
<div class="alert alert-success mb-3" role="alert">
  {{ __('A fresh verification link has been sent to your email address.') }}
</div>
@endif
<p class="mb-3">{{ __('Before proceeding, please check your email for a verification link.') }}</p>
<p>{{ __('If you did not receive the email') }},
<form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
  @csrf
  <button type="submit" class="btn btn-link p-0 m-0 align-baseline" style="background-color: #1a685b; color: #ffffff;">{{ __('click here to request another') }}</button>.
</form></p>
@endsection
