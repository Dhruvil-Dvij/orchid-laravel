<div class="mb-3">

    <label class="form-label login-lables">
        {{__('Email address')}}
    </label>

    {!!  \Orchid\Screen\Fields\Input::make('email')
        ->type('email')
        ->required()
        ->tabindex(1)
        ->autofocus()
        ->autocomplete('email')
        ->inputmode('email')
        ->placeholder(__('Enter your email'))
        ->class("login-input")
    !!}
</div>


<div class="mb-3">
    <label class="form-label w-100 login-lables">
        {{__('Password')}}
    </label>

    {!!  \Orchid\Screen\Fields\Password::make('password')
        ->required()
        ->autocomplete('current-password')
        ->tabindex(2)
        ->placeholder(__('Enter your password'))
         ->class("login-input")
    !!}
</div>

<div class="row align-items-center last-section">
    <div class="col-md-6 col-xs-12">
        <label class="form-check">
            <input type="hidden" name="remember">
            <input type="checkbox" name="remember" value="true"
                   class="form-check-input" {{ !old('remember') || old('remember') === 'true'  ? 'checked' : '' }}>
            <span class="form-check-label"> {{__('Remember Me')}}</span>
        </label>
    </div>
    <div class="col-md-6 col-xs-12 btn-container">
        <button id="button-login" type="submit" class="btn btn-default btn-block login-btn" tabindex="3">
            <x-orchid-icon path="bs.box-arrow-in-right" class="small me-2 login-icon"/>
            {{__('Login')}}
        </button>
    </div>
</div>
