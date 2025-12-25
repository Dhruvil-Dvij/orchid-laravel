<?php

namespace App\Orchid\Screens\Bank;

use App\Models\BankAccount;
use App\Models\KycSubmission;
use App\Orchid\Layouts\Bank\UserBankListLayout;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class UsersBankListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        // All bank accounts id role admin else only own bank accounts

        $BankDetails = BankAccount::with('user')
            ->when(
                Auth::user()->inRole('admin'),
                fn($q) => $q,
                fn($q) => $q->where('user_id', Auth::id())
            )->latest()->get();

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
        return 'Users Bank Details';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Add Bank Account')
                ->icon('bs.plus-circle')
                ->route('platform.user.bank.add')
                ->class('btn btn-info rounded px-4 py-2 fw-bold')
                ->style('gap: 8px; transition: transform 0.2s ease;')
                ->canSee(auth()->user() && auth()->user()->hasAccess('platform.user.bank.list')),
        ];
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

    public function setPrimaryBankAccount($bank_account_id)
    {
        // Unset previous primary bank account
        $bankAccount = BankAccount::findOrFail($bank_account_id);

        // Unset previous primary account
        BankAccount::where('user_id', $bankAccount->user_id)
            ->where('is_primary', true)
            ->update(['is_primary' => false]);

        // Set new primary
        $bankAccount->update(['is_primary' => true]);        

        Toast::success('Account set to primary successfully.');
        return redirect()->route('platform.user.bank.list');
    }
}
