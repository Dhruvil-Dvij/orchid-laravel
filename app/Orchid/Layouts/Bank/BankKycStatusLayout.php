<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Bank;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class BankKycStatusLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Select::make('bankKyc.status')
                ->title('Status')
                ->options([
                    'pending'   => 'Pending',
                    'approved'  => 'Approved',
                    'rejected'  => 'Rejected',
                ])
                ->required()
                ->id('status-select')
                ->class('account-all-input'),
        ];
    }
}
