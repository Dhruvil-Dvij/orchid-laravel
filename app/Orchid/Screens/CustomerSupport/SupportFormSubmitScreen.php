<?php

namespace App\Orchid\Screens\CustomerSupport;

use App\Models\CustomerSupport;
use App\Orchid\Layouts\CustomerSupport\SupportFormLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Orchid\Support\Facades\Toast;
use Orchid\Attachment\Models\Attachment;

class SupportFormSubmitScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Customer Support';
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
            Layout::block(SupportFormLayout::class)
                ->title(__('Support'))
                ->description(__("Provide accurate details and attachments (if any) to help us resolve your request faster."))
                ->commands(
                    Button::make(__('Submit'))
                        ->type(Color::BASIC())
                        ->icon('bs.check-circle')
                        ->method('addSupport')
                        ->class('btn btn-info rounded px-4 py-2 fw-bold')
                        ->style('gap: 8px; transition: transform 0.2s ease;')
                ),
        ];
    }

    public function addSupport(Request $request)
    {
        $validatedData = $request->validate([
            'subject'        => 'required|string|max:255',
            'category'       => 'required|string|max:100',
            'description'    => 'required|string',
            'attachment'     => 'nullable|array',
            'attachment.*'   => 'integer|exists:attachments,id',
        ]);

        // ===============================
        // Handle Orchid attachment
        // ===============================
        $attachmentPath = null;

        if (!empty($validatedData['attachment'])) {
            $attachment = Attachment::find($validatedData['attachment'][0]);

            if ($attachment) {
                // Example: customer-support/2025/12/13/file.pdf
               $attachmentPath = $attachment->path . $attachment->name . '.' . $attachment->extension;
            }
        }

        // ===============================
        // Store customer support ticket
        // ===============================
        $customerSupport = new CustomerSupport();
        $customerSupport->user_id = Auth::id();
        $customerSupport->subject = $validatedData['subject'];
        $customerSupport->category = $validatedData['category'];
        $customerSupport->description = $validatedData['description'];
        $customerSupport->attachment_path = $attachmentPath;
        $customerSupport->status = 'open';
        $customerSupport->save();

        Toast::info(__('Support is on the way.'));
    }
}
