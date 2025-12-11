<?php

namespace App\Orchid\Screens\Contact;

use App\Models\Contact;
use App\Orchid\Layouts\Contact\ContactListLayout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class ContactListScreen extends Screen
{
    public $contact;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $this->contact = Contact::where('is_read', false)
            ->orderBy('created_at', 'desc')
            ->get();
        

        return [
            'contact' => $this->contact,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Contact Messages';
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
            ContactListLayout::class,
        ];
    }

    public function markAsRead($id)
    {
        $contact = Contact::find($id);
        if (!$contact) {
            // Handle the case where the contact message is not found
            return;
        }
        $contact->is_read = true;
        $contact->save();

        // Optionally, you can add a success message or redirect
        Toast::success(__('Marked as read.'));

    }
}
