@extends('layouts.auth')

@section('content')
<a href="{{ url('/') }}" class="text-nowrap logo-img text-center d-block py-3 w-100">
  <img src="{{ asset('images/logos/logo.svg') }}" alt="">
</a>
<p class="text-center">Your Social Campaigns</p>
<p class="mb-3">{{ __('Please confirm your password before continuing.') }}</p>
<form method="POST" action="{{ route('password.confirm') }}">
  @csrf
  <div class="mb-4">
    <label for="password" class="form-label">{{ __('Password') }}</label>
    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    @error('password')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">{{ __('Confirm Password') }}</button>
  @if (Route::has('password.request'))
  <div class="d-flex align-items-center justify-content-center">
    <a class="text-primary fw-bold" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
  </div>
  @endif
</form>
@endsection
