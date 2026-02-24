@extends('layouts.auth')

@section('content')
<a href="{{ url('/') }}" class="text-nowrap logo-img text-center d-block py-3 w-100">
  <img width="8%" src="{{ asset('charitize/img/logo.png') }}" alt="">
  <h3 style="color: #e68908;font-family: 'josefin Sans' !important; font-weight: bold;">Holy Spirit Bepanda</h3>
</a>
<form method="POST" action="{{ route('register') }}">
  @csrf
  <div class="mb-3">
    <label for="name" class="form-label">{{ __('Name') }}</label>
    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
    @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">{{ __('Email Address') }}</label>
    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
    @error('email')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">{{ __('Password') }}</label>
    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
    @error('password')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
  <div class="mb-4">
    <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
    <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
    @error('password_confirmation')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
  <button type="submit" class="btn w-100 py-8 fs-4 mb-4 rounded-2" style="background-color: #1a685b; color: #ffffff;">{{ __('Register') }}</button>
  <div class="d-flex align-items-center justify-content-center">
    <p class="fs-4 mb-0 fw-bold">Already have an account?</p>
    <a class="fw-bolder ms-2" style="color: #1a685b;" href="{{ route('login') }}">{{ __('Login') }}</a>
  </div>
</form>
@endsection
