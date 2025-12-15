<?php

namespace App\Orchid\Screens\Kyc;

use App\Models\KycSubmission;
use App\Orchid\Layouts\Kyc\KycSubmissionImgLayout;
use App\Orchid\Layouts\Kyc\KycSubmissionViewLayout;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class KycDetailsScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $kycData = KycSubmission::findOrFail(Auth::id());
        return [
            'kyc_data' => $kycData->toArray(),
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
