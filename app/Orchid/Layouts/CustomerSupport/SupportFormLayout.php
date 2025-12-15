<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\CustomerSupport;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Rows;

class SupportFormLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('subject')
                ->type('string')
                ->required()
                ->title(__('Subject'))
                ->placeholder(__('Enter your subject'))
                ->class('account-all-input'),

            Select::make('category')
                ->title('Category')
                ->options([
                    'inquiry'  => 'General Inquiry',
                    'account'   => 'Account Issue',
                    'payment_fund'  => 'Payment / Fund',
                    'technical'  => 'Technical Problem',
                    'bug'  => 'Bug Report',
                    'feature_request'  => 'Feature Request',
                ])
                ->required()
                ->id('status-select')
                ->class('account-all-input'),

            TextArea::make('description')
                ->title('Description')
                ->placeholder('Enter description here...')
                ->rows(4)
                ->id('admin-comment') // We will toggle this field using JS
                ->class('rejection-textarea'),

            Upload::make('attachment')
                ->title('Attachment')
                ->path('customer-support/' . now()->format('Y/m/d'))
                ->maxFiles(1)
                ->acceptedFiles('.jpg,.jpeg,.png,.pdf'),
        ];
    }
}
