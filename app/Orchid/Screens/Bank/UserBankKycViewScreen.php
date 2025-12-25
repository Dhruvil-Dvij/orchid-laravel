<?php

namespace App\Orchid\Screens\Bank;

use App\Models\BankKyc;
use App\Orchid\Layouts\Bank\BankKycStatusLayout;
use App\Orchid\Layouts\Bank\BankKycViewLayout;
use App\Orchid\Layouts\Bank\BankUPIViewLayout;
use App\Orchid\Layouts\Kyc\KycStatusLayout;
use App\Orchid\Layouts\Kyc\KycSubmissionViewLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Color;
use Orchid\Support\Facades\Toast;

class UserBankKycViewScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Request $request, $id): iterable
    {
        $bankKyc = BankKyc::with([
            'bankAccount',
            'user'
        ])->where('id', $id)
            ->firstOrFail();

        $fields = [
            'qr_code_img',
            'passbook_img',
        ];
        foreach ($fields as $field) {

            if ($field === 'qr_code_img' && !empty($bankKyc->bankAccount->$field)) {
                $bankKyc->bankAccount->$field = !str_starts_with($bankKyc->bankAccount->$field, 'http') ? asset(ltrim($bankKyc->bankAccount->$field, '/')) : $bankKyc->bankAccount->$field;
            }

            if ($field === 'passbook_img' && !empty($bankKyc->$field)) {
                $bankKyc->$field = asset(ltrim($bankKyc->$field, '/'));
            }
        }

        // dd($bankKyc);
        return [
            'bankKyc' => $bankKyc,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Bank KYC Details';
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
            Layout::block(BankKycViewLayout::class)
                ->title(__('Bank Information'))
                ->description(__("You can view bank information.")),

            Layout::block(BankUPIViewLayout::class)
                ->title(__('UPI Information'))
                ->description(__("You can view UPI information.")),

            Layout::block(BankKycStatusLayout::class)
                ->title(__('Status Update'))
                ->description(__("Update bank KYC status."))
                ->commands(
                    Button::make(__('Save'))
                        ->type(Color::BASIC())
                        ->icon('bs.check-circle')
                        ->method('updateBankKycStatus')
                        ->class('btn btn-info rounded px-4 py-2 fw-bold')
                        ->style('gap: 8px; transition: transform 0.2s ease;')
                ),
        ];
    }

    public function updateBankKycStatus(Request $request, $id)
    {
        $request->validate([
            'bankKyc.status' => 'required|in:pending,approved,rejected',
        ]);
        $status = $request->input('bankKyc.status');
        
        $bankKyc = BankKyc::findOrFail($id);
        $bankKyc->status = $status;
        $bankKyc->save();

        // Flash a success message
        Toast::info("{$bankKyc->user->name} Bank Kyc status updated to {$status}.");
        return redirect()->route('platform.user.bank.kyc.requests.view', ['id' => $id]);
    }
}
