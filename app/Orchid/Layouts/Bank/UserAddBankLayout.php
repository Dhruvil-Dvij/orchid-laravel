<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Bank;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Rows;

class UserAddBankLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('bank.bank_account_holder')
                ->title('Account Holder Name')
                ->required()
                ->class('account-all-input'),

            Input::make('bank.bank_account_number')
                ->title('Account Number')
                ->required()
                ->class('account-all-input'),

            Input::make('bank.bank_ifsc')
                ->title('IFSC Code')
                ->required()
                ->class('account-all-input'),

            Input::make('bank.bank_name')
                ->title('Bank Name')
                ->required()
                ->class('account-all-input'),

            Upload::make('bank.passbook_img')
                ->title('Bank Passbook Image')
                ->acceptedFiles('image/*')
                ->storage('orchid_public')
                ->path('kyc/document/' . now()->format('Y/m/d'))
                ->maxFiles(1),

        ];
    }
}
