@extends('layouts.auth')

@section('content')
<a href="{{ url('/') }}" class="text-nowrap logo-img text-center d-block py-3 w-100">
  <img width="8%" src="{{ asset('charitize/img/logo.png') }}" alt="">
  <h3 style="color: #e68908;font-family: 'josefin Sans' !important; font-weight: bold;">Holy Spirit Bepanda</h3>
</a>
<form method="POST" action="{{ route('login') }}">
  @csrf
  <div class="mb-3">
    <label for="email" class="form-label">{{ __('Email Address') }}</label>
    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    @error('email')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
  <div class="mb-4">
    <label for="password" class="form-label">{{ __('Password') }}</label>
    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    @error('password')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
  <div class="d-flex align-items-center justify-content-between mb-4">
    <div class="form-check">
      <input class="form-check-input primary" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
      <label class="form-check-label text-dark" for="remember">
        {{ __('Remember Me') }}
      </label>
    </div>
    @if (Route::has('password.request'))
    <a class="text-primary fw-bold" href="{{ route('password.request') }}">{{ __('Forgot Password?') }}</a>
    @endif
  </div>
  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">{{ __('Login') }}</button>
  <div class="d-flex align-items-center justify-content-center">
    <p class="fs-4 mb-0 fw-bold">Do you not have an account?</p>
    <a class="text-primary fw-bold ms-2" href="{{ route('register') }}">{{ __('Create an account') }}</a>
  </div>
</form>
@endsection
