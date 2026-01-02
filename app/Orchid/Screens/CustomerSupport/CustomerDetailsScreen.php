<?php

namespace App\Orchid\Screens\CustomerSupport;

use App\Models\Referral;
use App\Models\User;
use App\Orchid\Layouts\CustomerSupport\CustomerListLayout;
use App\Orchid\Layouts\User\InvitedByListLayout;
use App\Orchid\Layouts\User\ReferralsListLayout;
use App\Orchid\Layouts\User\UserFiltersLayout;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;

class CustomerDetailsScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'users' => User::with('roles')
                ->filters(UserFiltersLayout::class)
                ->defaultSort('id', 'desc')
                ->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Customer Details';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            CustomerListLayout::class,

            Layout::modal('referralsListModal', InvitedByListLayout::class)
                ->deferred('loadReferralsOnOpenModal')
                ->withoutApplyButton()
                ->withoutCloseButton(),
        ];
    }

    public function loadReferralsOnOpenModal($id): array
    {
        $referrals = Referral::with([
            'referrer:id,customer_id,name,email',
        ])->where('referred_user_id', $id)->get();

        return [
            'referrals' => $referrals,
        ];
    }

}
