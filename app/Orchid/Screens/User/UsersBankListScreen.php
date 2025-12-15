<?php

namespace App\Orchid\Screens\User;

use App\Models\KycSubmission;
use App\Orchid\Layouts\User\UserBankListLayout;
use Orchid\Screen\Screen;

class UsersBankListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'kyc' => KycSubmission::with('user')
                ->whereNotNull('bank_account_number')
                ->latest()
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
        return 'Users Bank Details';
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
            UserBankListLayout::class
        ];
    }
}
