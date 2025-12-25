<?php

namespace App\Orchid\Screens\Bank;

use App\Models\BankAccount;
use App\Models\BankKyc;
use App\Orchid\Layouts\Bank\UserBankKycListLayout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;
use Illuminate\Support\Facades\Auth;

class UserBankKycRequestScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $bankKycs = BankKyc::with([
            'bankAccount',
            'user'
        ])
            ->where('status', 'pending')
            ->latest()
            ->get();

        // dd($bankKycs);

        return [
            'bankKycs' => $bankKycs,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Bank KYC Requests';
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
            UserBankKycListLayout::class,
        ];
    }
}
