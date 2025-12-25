<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Bank;

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

class UserBankKycListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'bankKycs';

    protected function textNotFound(): string
    {
        return __('There is no Bank KYC requests found');
    }

    protected function subNotFound(): string
    {
        return __('Once users add Bank, they will appear here.');
    }

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('user.name', 'User')
                ->render(fn($bankKycs) => $bankKycs->user?->name ?? '-')
                ->sort(),

            TD::make('bankAccount.bank_account_holder', 'Account Holder')
                ->sort(),

            TD::make('bankAccount.bank_account_number', 'Account Number'),

            TD::make('bankAccount.bank_ifsc', 'IFSC Code'),

            TD::make('bankAccount.bank_name', 'Bank Name'),

            TD::make('status', __('KYC Status'))
                ->sort()
                ->cantHide()
                ->render(function ($bankKycs) {
                    $status = ucfirst($bankKycs->status); // Assuming status is: 'approved', 'pending', 'rejected'

                    $colorClass = match ($bankKycs->status) {
                        'approved' => 'badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2',
                        'pending'  => 'badge bg-warning bg-opacity-10 text-warning rounded-pill px-3 py-2',
                        'rejected' => 'badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2',
                        default    => 'badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 py-2',
                    };

                    return "<span class=\"px-3 py-1 rounded-full text-xs font-semibold {$colorClass}\">{$status}</span>";
                })->align(TD::ALIGN_CENTER),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->render(fn($bankKycs) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([
                        Link::make(__('View'))
                            ->route('platform.user.bank.kyc.requests.view', $bankKycs->id)
                            ->icon('bs.pencil'),
                    ])),
        ];
    }
}
