<?php

namespace App\Orchid\Screens\Bank;

use App\Models\BankAccount;
use App\Models\BankKyc;
use App\Orchid\Layouts\Bank\AdminUpiLayout;
use App\Orchid\Layouts\Bank\UserAddBankLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Color;
use Orchid\Support\Facades\Toast;

class UserAddBankScreen extends Screen
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
        return 'Add Bank Account';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Save')
                ->icon('bs.save-fill')
                ->method('save')
                ->class('btn btn-info rounded px-4 py-2 fw-bold')
                ->style('gap: 8px; transition: transform 0.2s ease;'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        $layouts = [];

        // Normal Bank Details (Everyone)
        $layouts[] =
            Layout::block(UserAddBankLayout::class)
            ->title(__('Bank Details'))
            ->description(__('Update your bank details below.'));

        // Admin-only UPI Section

        // if (Auth::user()?->roles()->where('slug', 'admin')->exists()) {
            $layouts[] =
                Layout::block(AdminUpiLayout::class)
                ->title(__('UPI Details'))
                ->description(__('Add UPI ID and QR code.'));
        // }

        return $layouts;
    }

    public function save(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'bank.bank_account_holder'  => 'required|string|max:255',
            'bank.bank_account_number'  => 'required|string|max:50',
            'bank.bank_ifsc'            => 'required|string|max:20',
            'bank.bank_name'            => 'required|string|max:255',
            'bank.passbook_img'         => 'nullable|array|max:2048',

            // Optional (Admin-only fields)
            'bank.upi_id'               => 'nullable|string|max:255',
            'bank.new_qr_code_img'       => 'nullable|array|max:2048',

        ]);

        $userId = Auth::id();
        $getPath = function ($attachmentId) {
            if (!$attachmentId) {
                return null;
            }

            $attachment = Attachment::find($attachmentId);
            if (!$attachment) {
                \Log::warning("Attachment ID {$attachmentId} not found.");
                return null;
            }

            return $attachment->path . $attachment->name . '.' . $attachment->extension;
        };

        // Create Bank Account
        $bankAccount = BankAccount::create([
            'user_id'               => $userId,
            'bank_account_holder'   => $validated['bank']['bank_account_holder'],
            'bank_account_number'   => $validated['bank']['bank_account_number'],
            'bank_ifsc'             => $validated['bank']['bank_ifsc'],
            'bank_name'             => $validated['bank']['bank_name'],
            'upi_id'                => $validated['bank']['upi_id'] ?? null,
            'qr_code_img'           => $getPath($request->input('bank.new_qr_code_img')[0] ?? null),

            // If user has no primary account yet → make this primary
            'is_primary' => !BankAccount::where('user_id', $userId)->exists(),
            'created_by' => 'user',
        ]);

        // Create Bank KYC record (optional but future-safe)
        BankKyc::create([
            'bank_account_id' => $bankAccount->id,
            'passbook_img'    => $getPath($request->input('bank.passbook_img')[0] ?? null),
            'status'          => 'pending',
        ]);

        // Success message
        Toast::success('Bank details saved successfully.');

        // Redirect
        return redirect()->route('platform.user.bank.list');
    }
}
