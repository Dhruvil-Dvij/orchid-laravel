<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Contact;

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

class ContactListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'contact';

    protected function textNotFound(): string
    {
        return __('There is no contact requests found');
    }

    protected function subNotFound(): string
    {
        return __('Once users submit contact requests, they will appear here.');
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
                ->render(fn($contact) => $contact->name),

            TD::make('email', __('Email'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(fn($contact) =>$contact->email),

            TD::make('subject', __('Subject'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(fn($contact) => $contact->subject),

            TD::make('message', __('Message'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(fn($contact) => $contact->message),

            // TD::make('created_at', __('Created'))
            //     ->usingComponent(DateTimeSplit::class)
            //     ->align(TD::ALIGN_RIGHT)
            //     ->defaultHidden()
            //     ->sort(),

            // TD::make('updated_at', __('Last edit'))
            //     ->usingComponent(DateTimeSplit::class)
            //     ->align(TD::ALIGN_RIGHT)
            //     ->sort(),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn($contact) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([
                        Button::make(__('Mark as Read'))
                            ->icon('bs.check2-circle')
                            ->method('markAsRead', [
                                'id' => $contact->id,
                            ]),
                    ])),
                    
        ];

    }
}
