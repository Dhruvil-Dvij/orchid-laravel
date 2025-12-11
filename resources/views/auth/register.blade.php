@extends('platform::auth')
@section('title',__('Sign up to create account'))

@section('content')
<a class="login-logo" href="{{route('platform.index')}}">
                    <img src="{{asset('images/logo.svg')}}" alt="Vcoins">
                    <span>Vcoins</span>
                </a>
    <h1 class="h4 text-body-emphasis mb-4 signIN-title">{{__('Sign up to create account')}}</h1>

    <form class="m-t-md"
          role="form"
          method="POST"
          data-controller="form"
          data-form-need-prevents-form-abandonment-value="false"
          data-action="form#submit"
          action="{{ route('platform.register.auth') }}">
        @csrf

        @include('auth.signup')
    </form>
@endsection
