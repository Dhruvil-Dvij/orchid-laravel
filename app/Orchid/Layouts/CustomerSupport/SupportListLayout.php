<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\CustomerSupport;

use App\Models\CryptoBasket;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Support\Color;

class SupportListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'supports';

    protected function textNotFound(): string
    {
        return __('There is no fund requests found');
    }

    protected function subNotFound(): string
    {
        return __('Once users submit support requests, they will appear here.');
    }

    /**
     * @return TD[]
     */
    public function columns(): array
    {

        return [
            TD::make('user.name', __('User'))
                ->sort()
                ->render(function ($support) {
                    return $support->user
                        ? $support->user->name
                        : 'Guest';
                }),

            TD::make('subject', __('Subject'))
                ->sort()
                ->cantHide()
                ->filter(Input::make()),
            
            TD::make('category', __('Category'))
                ->sort()
                ->cantHide()
                ->filter(Input::make()),

            TD::make('description', __('Description'))
                ->sort()
                ->cantHide()
                ->filter(Input::make()),

            // TD::make('attachment_path', __('Attachment'))
            //     ->render(function ($support) {
            //         if (!$support->attachment_path) {
            //             return '-';
            //         }

            //         return '<a href="'
            //             . route('platform.support.attachment.view', $support->id)
            //             . '" target="_blank" class="link-primary">
            //                     <i class="bi bi-eye"></i> View
            //                 </a>';
            //     })
            //     ->raw(),

            TD::make('created_at', __('Created'))
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->sort(),


            // TD::make(__('Actions'))
            //     ->align(TD::ALIGN_CENTER)
            //     ->width('100px')
            //     ->canSee(auth()->user() && auth()->user()->hasAccess('platform.systems.users'))
            //     ->render(fn(CryptoBasket $cryptoBasket) => DropDown::make()
            //         ->icon('bs.three-dots-vertical')
            //         ->list([

            //             Link::make(__('Edit'))
            //                 ->route('platform.baskets.edit', [$cryptoBasket])
            //                 ->icon('bs.pencil'),

            //             Button::make(__('Delete'))
            //                 ->icon('bs.trash3')
            //                 ->confirm(__('Once the basket is deleted, all of its resources and data will be permanently deleted. Before deleting your basket, please download any data or information that you wish to retain.'))
            //                 ->method('remove', [
            //                     'id' => $cryptoBasket->id,
            //                 ]),
            //         ])),


        ];
    }
}
