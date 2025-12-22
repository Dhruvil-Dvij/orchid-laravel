<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Kyc;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Group;

class KycSubmissionLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [

            // Bank Details
            Input::make('kyc.bank_account_holder')
                ->type('text')
                ->required()
                ->title(__('Account Holder Name'))
                ->placeholder(__('Account Holder Name'))
                ->horizontal()
                ->class('account-all-input'),

            Input::make('kyc.bank_account_number')
                ->type('text')
                ->required()
                ->title(__('Account Number'))
                ->placeholder(__('Account Number'))
                ->horizontal()
                ->class('account-all-input'),

            Input::make('kyc.bank_ifsc')
                ->type('text')
                ->required()
                ->title(__('IFSC Code'))
                ->placeholder(__('IFSC Code'))
                ->horizontal()
                ->class('account-all-input'),

            Input::make('kyc.bank_name')
                ->type('text')
                ->required()
                ->title(__('Bank Name'))
                ->placeholder(__('Bank Name'))
                ->horizontal()
                ->class('account-all-input'),

            // Bank Book Image
            Group::make([
                Upload::make('kyc.bank_book_img')
                    ->required()
                    ->title(__('Bank Book Image'))
                    ->acceptedFiles('image/*')
                    ->storage('orchid_public') // 👈 MUST MATCH config/filesystems.php
                    ->path('kyc/document/' . now()->format('Y/m/d'))
                    ->maxFiles(1),

                // PAN Card Image
                Upload::make('kyc.pan_card_img')
                    ->required()
                    ->title(__('PAN Card Image'))
                    ->acceptedFiles('image/*')
                    ->storage('orchid_public') // 👈 MUST MATCH config/filesystems.php
                    ->path('kyc/document/' . now()->format('Y/m/d'))
                    ->maxFiles(1),
            ]),

            // Aadhar Card Image
            Group::make([
                Upload::make('kyc.aadhar_card_front_img')
                    ->required()
                    ->title(__('Aadhar Card Image (Front side)'))
                    ->acceptedFiles('image/*')
                    ->storage('orchid_public') // 👈 MUST MATCH config/filesystems.php
                    ->path('kyc/document/' . now()->format('Y/m/d'))
                    ->maxFiles(1),

                Upload::make('kyc.aadhar_card_back_img')
                    ->required()
                    ->title(__('Aadhar Card Image (Back side)'))
                    ->acceptedFiles('image/*')
                    ->storage('orchid_public') // 👈 MUST MATCH config/filesystems.php
                    ->path('kyc/document/' . now()->format('Y/m/d'))
                    ->maxFiles(1),
            ]),

            Group::make([
                // Passport Size Image
                Upload::make('kyc.passport_img')
                    ->required()
                    ->title(__('Passport Size Image'))
                    ->acceptedFiles('image/*')
                    ->storage('orchid_public') // 👈 MUST MATCH config/filesystems.php
                    ->path('kyc/document/' . now()->format('Y/m/d'))
                    ->maxFiles(1),
            ]),
        ];
    }
}
