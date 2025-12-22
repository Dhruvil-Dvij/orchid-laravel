<?php

namespace App\Orchid\Layouts\User;

use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Upload;

class AdminUpiLayout extends Rows
{
    protected function fields(): array
    {
        return [
            Input::make('kyc.upi_id')
                ->title('UPI ID')
                ->placeholder('example@upi')
                ->help('This UPI ID will be used for admin transactions.')
                ->class('account-all-input'),

            input::make('kyc.qr_code_img')
                ->type('file')
                ->title('UPI QR Code')
                ->maxFiles(1)
                ->class('account-all-input'),
        ];
    }
}
