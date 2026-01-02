<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\CustomerSupport;

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

class CustomerListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'users';

    protected function textNotFound(): string
    {
        return __('Users not found');
    }

    protected function subNotFound(): string
    {
        return __('All the users of application will appear here.');
    }

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [

            TD::make('name', __('Name'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(fn(User $user) => new Persona($user->presenter())),

            TD::make('customer_id', __('Customer ID'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(fn(User $user) => $user->customer_id),

            TD::make('email', __('Email'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(fn(User $user) => $user->email),

            TD::make('created_at', __('Created'))
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->defaultHidden()
                ->sort(),

            TD::make('updated_at', __('Last edit'))
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->sort(),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn(User $user) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([

                        Link::make(__('Bank accounts'))
                            ->route('platform.customer.banks', $user->id)
                            ->icon('bs.bank2'),

                        Link::make(__('KYC Details'))
                            ->route('platform.customer.kyc', ['id' => $user->id])
                            ->icon('bs.file-earmark-check'),

                        ModalToggle::make('Invited By')
                            ->modal('referralsListModal')
                            ->modalTitle('Invited By')
                            ->icon('bs.people')
                            ->asyncParameters([
                                'id' => $user->id,
                            ])
                            ->method('loadUserOnOpenModal')
                            ->canSee(Auth::user()->inRole('admin') && $user->referred_by !== null),

                        // Link::make(__('Activity History'))
                        //     ->route('platform.user.activity_history', ['activity' => $user->id])
                        //     ->icon('bs.clock-history')
                        //     ->canSee(Auth::user()->inRole('admin')),

                        // ModalToggle::make('Add Funds')
                        //     ->modal('addFundsModal')
                        //     ->modalTitle('Add Funds')
                        //     ->icon('bs.wallet2')
                        //     ->asyncParameters([
                        //         'user' => $user->id,
                        //     ])
                        //     ->method('addFunds')
                        //     ->canSee(Auth::user()->inRole('admin') && Auth::user()->hasAccess('platform.funds.direct.add')),


                        // Button::make(__('Delete'))
                        //     ->icon('bs.trash3')
                        //     ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                        //     ->method('remove', [
                        //         'id' => $user->id,
                        //     ]),
                    ])),
        ];
    }
}
