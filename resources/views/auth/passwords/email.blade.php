@extends('layouts.auth')

@section('content')
<a href="{{ url('/') }}" class="text-nowrap logo-img text-center d-block py-3 w-100">
  <img width="8%" src="{{ asset('charitize/img/logo.png') }}" alt="Holy Spirit Bepanda Logo">
  <h3 style="color: #e68908;font-family: 'josefin Sans' !important; font-weight: bold;">Holy Spirit Bepanda</h3>
</a>
@if (session('status'))
<div class="alert alert-success mb-3" role="alert">
  {{ session('status') }}
</div>
@endif
<form method="POST" action="{{ route('password.email') }}">
  @csrf
  <div class="mb-4">
    <label for="email" class="form-label">{{ __('Email Address') }}</label>
    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    @error('email')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
  <button type="submit" class="btn w-100 py-8 fs-4 mb-4 rounded-2" style="background-color: #1a685b; color: #ffffff;">{{ __('Send Password Reset Link') }}</button>
  <div class="d-flex align-items-center justify-content-center">
    <p class="fs-4 mb-0 fw-bold">{{ __('Remember your password?') }}</p>
    <a class="fw-bolder ms-2" style="color: #1a685b;" href="{{ route('login') }}">{{ __('Login') }}</a>
  </div>
</form>
@endsection
