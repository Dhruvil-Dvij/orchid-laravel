@extends('platform::app')

@section('styles')
    <link href="{{ asset('css/orchid-custom.css') }}" rel="stylesheet">
@endsection

@section('body')

    <div class="container-md main-container">
        <div class="form-signin h-full min-vh-100 d-flex flex-column justify-content-center">

            {{-- <a class="d-flex justify-content-center mb-4 p-0 px-sm-5" href="{{Dashboard::prefix()}}">                                   

                @includeFirst([config('platform.template.header'), 'platform::header'])
            </a> --}}

            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xxl-5 px-md-5">

                    <div class="bg-white p-4 p-sm-5 rounded shadow-sm login-entire-container">
                        @yield('content')
                    </div>
                </div>
            </div>


            {{-- @includeFirst([config('platform.template.footer'), 'platform::footer']) --}}
        </div>
    </div>

@endsection
