<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Persona;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class UserBankListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'kyc';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('user.name', 'User')
                ->render(fn ($kyc) => $kyc->user?->name ?? '-')
                ->sort(),

            TD::make('bank_account_holder', 'Account Holder')
                ->sort(),

            TD::make('bank_account_number', 'Account Number'),

            TD::make('bank_ifsc', 'IFSC Code'),

            TD::make('bank_name', 'Bank Name'),

            // TD::make('status', 'Status')
            //     ->render(fn ($kyc) => ucfirst($kyc->status)),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->render(fn ($kyc) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([
                        Link::make('Edit')
                            ->icon('bs.pencil')
                            ->route('platform.kyc.bank.edit', $kyc->id),
                    ])),
        ];

    }
}
