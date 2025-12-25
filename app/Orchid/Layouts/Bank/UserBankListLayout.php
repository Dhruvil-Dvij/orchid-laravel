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

class UserBankListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'bank_details';

    protected function textNotFound(): string
    {
        return __('Bank details are not available');
    }

    protected function subNotFound(): string
    {
        return __('Once users submit their bank details, they will appear here.');
    }

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('user.name', 'User')
                ->render(fn($bank_details) => $bank_details->user?->name ?? '-')
                ->sort(),

            TD::make('bank_account_holder', 'Account Holder')
                ->sort(),

            TD::make('bank_account_number', 'Account Number'),

            TD::make('bank_ifsc', 'IFSC Code'),

            TD::make('bank_name', 'Bank Name'),

            TD::make('status', __('KYC Status'))
                ->sort()
                ->cantHide()
                ->render(function ($bank_details) {
                    $status = ucfirst($bank_details->bankKyc?->status); // Assuming status is: 'approved', 'pending', 'rejected'

                    $colorClass = match ($bank_details->bankKyc?->status) {
                        'approved' => 'badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2',
                        'pending'  => 'badge bg-warning bg-opacity-10 text-warning rounded-pill px-3 py-2',
                        'rejected' => 'badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2',
                        default    => 'badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 py-2',
                    };

                    return "<span class=\"px-3 py-1 rounded-full text-xs font-semibold {$colorClass}\">{$status}</span>";
                })->align(TD::ALIGN_CENTER),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->render(fn($bank_details) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([
                        Link::make('Edit')
                            ->icon('bs.pencil')
                            ->route('platform.kyc.bank.edit', $bank_details->id),

                        // add button to set primary bank account
                        Button::make('Set as Primary')
                            ->icon('bs.star')
                            ->method('setPrimaryBankAccount')
                            ->parameters(['bank_account_id' => $bank_details->id])
                            ->canSee(!$bank_details->is_primary && $bank_details->bankKyc?->status === 'approved'),
                    ])),
        ];
    }
}
