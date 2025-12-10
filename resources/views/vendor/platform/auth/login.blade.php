@extends('platform::auth')
@section('title',__('Sign in to your account'))

@section('content')
   <a class="login-logo" href="index.html">
                    <img src="images/logo.svg" alt="Vcoins">
                    <span>Vcoins</span>
                </a>
    <h1 class="h4 text-body-emphasis mb-4 signIN-title">{{__('Sign in to your account')}}</h1>

    <form class="m-t-md"
          role="form"
          method="POST"
          data-controller="form"
          data-form-need-prevents-form-abandonment-value="false"
          data-action="form#submit"
          action="{{ route('platform.login.auth') }}">
        @csrf

        @includeWhen($isLockUser,'platform::auth.lockme')
        @includeWhen(!$isLockUser,'platform::auth.signin')
    </form>
@endsection
