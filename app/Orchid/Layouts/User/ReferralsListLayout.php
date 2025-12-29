<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use App\Models\Referral;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Persona;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ReferralsListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'referrals';

    protected function textNotFound(): string
    {
        return __('No referrals found');
    }

    protected function subNotFound(): string
    {
        return __('All the referrals will appear here.');
    }

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('referrals.referred.name', __('Name'))
                ->sort()
                ->cantHide()
                ->render(function ($referrals) {
                    if (!$referrals->referred) {
                        return '—';
                    }

                    return $referrals->referred->name;
                }),

            TD::make('referrals.referred.email', __('Email'))
                ->sort()
                ->cantHide()
                ->render(function ($referrals) {
                    return $referrals->referred?->email ?? '—';
                }),

            TD::make('created_at', __('Used At'))
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->sort(),

        ];
    }
}
