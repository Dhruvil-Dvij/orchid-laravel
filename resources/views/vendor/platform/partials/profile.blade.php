<div class="profile-container d-flex align-items-stretch p-3 rounded lh-sm position-relative overflow-hidden">

    <a href="{{ route(config('platform.profile', 'platform.profile')) }}" class="col-10 d-flex align-items-center gap-3">
        @if($image = Auth::user()->presenter()->image())
            <img src="{{$image}}"  alt="{{ Auth::user()->presenter()->title()}}" class="thumb-sm avatar b" type="image/*">
        @endif

        <small class="d-flex flex-column lh-1 col-9">
            <span class="text-ellipsis text-white">{{Auth::user()->presenter()->title()}}</span>
            <span class="text-ellipsis text-muted">{{Auth::user()->presenter()->subTitle()}}</span>
        </small>
    </a>

    {{-- Three-dot Menu Dropdown --}}
    <div class="col-2 d-flex align-items-center justify-content-end">
        <div class="dropup">
            <button class="btn btn-link p-0 text-white three-dot-menu-btn" type="button" id="profileDropdownMenu" data-bs-toggle="dropdown" aria-expanded="false" style="border: none; background: none; cursor: pointer; padding: 0.5rem !important;">
                <x-orchid-icon path="bs.three-dots-vertical" style="font-size: 1.2rem; color: #fff;" />
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdownMenu" style="background-color: #131420; border: 1px solid rgba(255, 255, 255, 0.1); min-width: 150px; margin-bottom: 0.5rem;">
                @if (!isKycApproved(Auth::user()->id))
                <li>
                    <a class="dropdown-item text-white" href="{{ route('platform.user.kyc') }}" style="padding: 0.75rem 1rem;">
                        <x-orchid-icon path="bs.exclamation-triangle" class="me-2" style="color: #ff0000;" />
                        KYC
                    </a>
                </li>
                @endif
                <li><hr class="dropdown-divider" style="border-color: rgba(255, 255, 255, 0.1); margin: 0.5rem 0;"></li>
                <li>
                    <form method="POST" action="{{ route('platform.logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="dropdown-item text-white" style="border: none; background: none; width: 100%; text-align: left; padding: 0.75rem 1rem; cursor: pointer;">
                            <x-orchid-icon path="bs.box-arrow-right" class="me-2" />
                            Sign Out
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
    
    {{-- <x-orchid-notification/> --}}
    {{-- @if (!isKycApproved(Auth::user()->id))
        <x-alert />
    @endif --}}

</div>
