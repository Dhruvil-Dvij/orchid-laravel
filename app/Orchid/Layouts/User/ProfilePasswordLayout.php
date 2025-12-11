<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Password;
use Orchid\Screen\Layouts\Rows;

class ProfilePasswordLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Password::make('old_password')
                ->placeholder(__('Enter the current password'))
                ->title(__('Current password'))
                ->help('This is your password set at the moment.')
                ->class('account-all-input'),

            Password::make('password')
                ->placeholder(__('Enter the password to be set'))
                ->title(__('New password'))
                ->class('account-all-input'),

            Password::make('password_confirmation')
                ->placeholder(__('Enter the password to be set'))
                ->title(__('Confirm new password'))
                ->help('A good password is at least 15 characters or at least 8 characters long, including a number and a lowercase letter.')
                ->class('account-all-input'),
        ];
    }
}
