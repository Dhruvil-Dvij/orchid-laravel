<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Rows;

class UserBankEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('kyc.bank_account_holder')
                ->title('Account Holder Name')
                ->required()
                ->class('account-all-input'),

            Input::make('kyc.bank_account_number')
                ->title('Account Number')
                ->required()
                ->class('account-all-input'),

            Input::make('kyc.bank_ifsc')
                ->title('IFSC Code')
                ->required()
                ->class('account-all-input'),

            Input::make('kyc.bank_name')
                ->title('Bank Name')
                ->required()
                ->class('account-all-input'),
        ];
    }
}
