<?php

namespace App\Orchid\Screens\CustomerSupport;

use App\Models\BankAccount;
use App\Orchid\Layouts\Bank\UserBankListLayout;
use App\Orchid\Layouts\CustomerSupport\CustomerBankListLayout;
use Orchid\Screen\Screen;

class CustomerBankListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query($id): iterable
    {
        $BankDetails = BankAccount::with('bankKyc')
            ->where('user_id', $id)
            ->whereHas('bankKyc', function ($q) {
                $q->where('status', 'approved');
            })
            ->get();
        
        // dd($BankDetails);
        return [
            'bank_details' => $BankDetails,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Bank Accounts';
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
            CustomerBankListLayout::class
        ];
    }
}
