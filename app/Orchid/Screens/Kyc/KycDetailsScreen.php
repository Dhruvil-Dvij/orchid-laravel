<?php

namespace App\Orchid\Screens\Kyc;

use App\Models\KycSubmission;
use App\Models\UserKyc;
use App\Orchid\Layouts\Kyc\KycSubmissionImgLayout;
use App\Orchid\Layouts\Kyc\KycSubmissionViewLayout;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class KycDetailsScreen extends Screen
{
    public function mount($id=null)
    {
        // $kycData = KycSubmission::where('user_id', Auth::id())->first();
        $kycData = UserKyc::with([
            'user',
            'user.bankAccounts.bankKyc',
            'user.primaryBankAccount.bankKyc',
        ])->where('user_id', $id ?? Auth::id())->get()->first();

        if (!$kycData) {
            Toast::info('KYC not complete yet!');
            return redirect()->back();
        }
    }
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query($id = null): iterable
    {
        // $kycData = KycSubmission::where('user_id', Auth::id())->first();
        $kycData = UserKyc::with([
            'user',
            'user.bankAccounts.bankKyc',
            'user.primaryBankAccount.bankKyc',
        ])->where('user_id', $id ?? Auth::id())->get()->first();

        $fields = [
            // 'bank_book_img',
            'passbook_img',
            'pan_card_img',
            'aadhar_card_front_img',
            'aadhar_card_back_img',
            'passport_img',
        ];

        foreach ($fields as $field) {

            if (!empty($kycData->$field)) {
                $kycData->$field = asset(ltrim($kycData->$field, '/'));
            }

            if ($field === 'passbook_img') {
                $primaryBank = $kycData->user->primaryBankAccount;

                if ($primaryBank && $primaryBank->bankKyc) {
                    $kycData->$field = asset(
                        ltrim($primaryBank->bankKyc->passbook_img, '/')
                    );
                }

                continue;
            }
        }
        
        return [
            'kyc_data' => $kycData,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'KYC Details';
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
            Layout::block(KycSubmissionViewLayout::class)
                ->title(__('Bank Information'))
                ->description(__("Update your bank information.")),

            Layout::block(KycSubmissionImgLayout::class)
                ->title(__('KYC Documents'))
                ->description(__("Uploaded KYC documents")),

            // Layout::block(KycStatusLayout::class)
            //     ->title(__('Status Update'))
            //     ->description(__("Update KYC status."))
            //     ->commands(
            //         Button::make(__('Save'))
            //             ->type(Color::BASIC())
            //             ->icon('bs.check-circle')
            //             ->method('updateKycStatus')
            //             ->class('btn btn-info rounded px-4 py-2 fw-bold')
            //             ->style('gap: 8px; transition: transform 0.2s ease;')
            //     ),
        ];
    }
}
