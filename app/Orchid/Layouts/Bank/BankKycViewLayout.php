<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Bank;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Layouts\Rows;

class BankKycViewLayout extends Rows
{

    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [

            Input::make('bankKyc.bankAccount.bank_account_holder')
                ->type('text')
                ->readonly()
                ->title(__('Bank Account Holder'))
                ->placeholder(__('Enter your bank account holder name'))
                ->class('account-all-input'),

            Input::make('bankKyc.bankAccount.bank_account_number')
                ->type('text')
                ->readonly()
                ->title(__('Bank Account Number'))
                ->placeholder(__('Enter your bank account number'))
                ->class('account-all-input'),

            Input::make('bankKyc.bankAccount.bank_ifsc')
                ->type('text')
                ->readonly()
                ->title(__('Bank IFSC Code'))
                ->placeholder(__('Enter your bank IFSC code'))
                ->class('account-all-input'),

            Input::make('bankKyc.bankAccount.bank_name')
                ->type('text')
                ->readonly()
                ->title(__('Bank Name'))
                ->placeholder(__('Enter your bank name'))
                ->class('account-all-input'),

            Picture::make('bankKyc.passbook_img')
                ->title('Bank Passbook Image')
                ->readonly()
                ->canSee(!empty($this->query['bankKyc']['passbook_img'])),
        ];
    }
}
