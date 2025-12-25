<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Bank;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Layouts\Rows;

class BankUPIViewLayout extends Rows
{

    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [

            Input::make('bankKyc.bankAccount.upi_id')
                ->type('text')
                ->readonly()
                ->title(__('UPI ID'))
                ->placeholder(__('Enter your UPI ID'))
                ->class('account-all-input'),

            Picture::make('bankKyc.bankAccount.qr_code_img')
                ->title('UPI QR Code Image')
                ->readonly(),
        ];
    }
}
