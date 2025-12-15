<?php

namespace App\Orchid\Screens\User;

use App\Models\KycSubmission;
use App\Orchid\Layouts\User\UserBankEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Color;

class UserBankEditScreen extends Screen
{
    public $kyc;

    public function query(KycSubmission $kyc): iterable
    {
        return [
            'kyc' => $kyc,
        ];
    }

    public function name(): ?string
    {
        return 'Bank Details';
    }

    public function commandBar(): iterable
    {
        return [];
    }

    public function layout(): iterable
    {
        return [
             Layout::block(UserBankEditLayout::class)
                ->title(__('Bank Details'))
                ->description(__("Update your bank details below. Accurate information is required for secure fund transfers and withdrawals."))
                ->commands(
                    Button::make(__('Save'))
                        ->type(Color::BASIC())
                        ->icon('bs.check-circle')
                        ->method('update')
                        ->class('btn btn-info rounded px-4 py-2 fw-bold')
                        ->style('gap: 8px; transition: transform 0.2s ease;')
                ),
        ];
    }

    public function update(KycSubmission $kyc, Request $request)
    {
        $kyc->update($request->get('kyc'));

        Toast::success('Bank details updated successfully.');

        return redirect()->route('platform.user.bank.list');
    }

}
