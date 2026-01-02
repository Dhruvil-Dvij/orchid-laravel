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

class InvitedByListLayout extends Table
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
            TD::make('referrals.referrer.name', __('Name'))
                ->cantHide()
                ->render(function ($referrals) {
                    if (!$referrals->referrer) {
                        return '—';
                    }

                    return $referrals->referrer->name;
                }),

            TD::make('referrals.referrer.email', __('Email'))
                ->cantHide()
                ->render(function ($referrals) {
                    return $referrals->referrer?->email ?? '—';
                }),

            TD::make('referrals.referral_code', __('Code'))
                ->cantHide()
                ->render(function ($referrals) {
                    return $referrals->referral_code ?? '—';
                }),

            TD::make('created_at', __('Used At'))
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT),

        ];
    }
}
