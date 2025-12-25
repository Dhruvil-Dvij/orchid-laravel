<?php

namespace App\Orchid\Screens\Kyc;

use App\Models\KycSubmission;
use App\Models\User;
use App\Models\UserKyc;
use App\Orchid\Layouts\Kyc\KycSubmissionListLayout;
use Orchid\Screen\Screen;

class KycSubmissionListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        // Fetch all KYC submissions with their associated users, ordered by the latest submission
        // $KycSubmission = KycSubmission::with('user')->whereIn('status', ['pending'])->latest()->paginate();
        // get KYC details along with bank details and images
        $kycSubmissions = User::query()
            ->whereHas('userKyc', function ($q) {
                $q->where('status', 'pending');
            })
            ->with([
                'userKyc',                              // identity KYC + images
                'bankAccounts.bankKyc',                // all banks + passbook images
                'primaryBankAccount.bankKyc',          // primary bank + its KYC
            ])
            ->latest()
            ->paginate(10);
        // dd($kycSubmissions);
        return [
            'kyc_submissions' => $kycSubmissions,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'KYC Requests';
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
            KycSubmissionListLayout::class
        ];
    }
}
