<?php

namespace App\Orchid\Layouts\Bank;

use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Fields\Picture;

class AdminUpiLayout extends Rows
{
    /**
     * @var string
     */
    public $target = 'bank';
    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Field[]
     */
    protected function fields(): array
    {        
        return [
            Input::make('bank.upi_id')
                ->title('UPI ID')
                ->placeholder('example@upi')
                ->help('This UPI ID will be used for admin transactions.')
                ->class('account-all-input'),

            // input::make('bank.qr_code_img')
            //     ->type('file')
            //     ->title('UPI QR Code')
            //     ->maxFiles(1)
            //     ->class('account-all-input'),

            Upload::make('bank.new_qr_code_img')
                ->required()
                ->title(__('UPI QR Code'))
                ->acceptedFiles('image/*')
                ->storage('orchid_public')
                ->path('kyc/upi/' . now()->format('Y/m/d'))
                ->maxFiles(1),

            Picture::make('bank.qr_code_img')
                ->title('Current UPI QR Code')
                ->readonly()
                ->canSee(!empty($this->query['bank']['qr_code_img'])),
        ];
    }
}
