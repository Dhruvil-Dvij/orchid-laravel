<?php

namespace App\Orchid\Screens\CustomerSupport;

use App\Models\CustomerSupport;
use App\Orchid\Layouts\CustomerSupport\SupportListLayout;
use Orchid\Screen\Screen;

class SupportListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
             'supports' => CustomerSupport::with('user')
            ->where('status', 'open')
            ->latest()
            ->paginate(5),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Support Request';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {

        return [
            SupportListLayout::class
        ];
    }
}
