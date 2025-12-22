<?php

namespace App\Orchid\Screens\User;

use App\Models\KycSubmission;
use App\Orchid\Layouts\User\AdminUpiLayout;
use App\Orchid\Layouts\User\UserBankEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Color;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserBankEditScreen extends Screen
{
    public $kyc;

    public function query(KycSubmission $kyc): iterable
    {
        return [
            'kyc' => $kyc,
        ];
    }

    public function name(): ?string
    {
        return 'Bank Details';
    }

    public function commandBar(): iterable
    {
        return [];
    }

    public function layout(): iterable
    {
        $layouts = [];

        // -------------------------------
        // Normal Bank Details (Everyone)
        // -------------------------------
        $layouts[] =
            Layout::block(UserBankEditLayout::class)
            ->title(__('Bank Details'))
            ->description(__('Update your bank details below.'))
            ->commands(
                Button::make(__('Save'))
                    ->type(Color::BASIC())
                    ->icon('bs.check-circle')
                    ->method('update')
            );

        // -------------------------------
        // Admin-only UPI Section
        // -------------------------------
        if (Auth::user()?->roles()->where('slug', 'admin')->exists()) {
            $layouts[] =
                Layout::block(AdminUpiLayout::class)
                ->title(__('Admin UPI Details'))
                ->description(__('Only admins can update UPI ID and QR code.'))
                ->commands(
                    Button::make(__('Save UPI'))
                        ->type(Color::PRIMARY())
                        ->icon('bs.shield-check')
                        ->method('updateAdminUpi')
                );
        }

        return $layouts;
    }

    public function update(KycSubmission $kyc, Request $request)
    {
        $kyc->update($request->get('kyc'));

        Toast::success('Bank details updated successfully.');

        return redirect()->route('platform.user.bank.list');
    }

    public function updateAdminUpi(KycSubmission $kyc, Request $request)
    {
        abort_unless(
            auth()->user()->roles()->where('slug', 'admin')->exists(),
            403
        );

        // dd($kyc->upi_id);

        $validated = $request->validate([
            'kyc.upi_id' => 'required|string|max:255',
            'kyc.qr_code_img'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('kyc.qr_code_img')) {

            $file = $request->file('kyc.qr_code_img');

            // Folder: public/kyc/upi
            $destination = public_path('kyc/upi');

            // Create directory if not exists
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            // Delete old file if exists
            if ($kyc->qr_code_img && file_exists(public_path($kyc->qr_code_img))) {
                unlink(public_path($kyc->qr_code_img));
            }

            // Generate unique filename
            $filename = 'qr_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();

            // Move file
            $file->move($destination, $filename);

            // Save RELATIVE path in DB
            $kyc->qr_code_img = 'kyc/upi/' . $filename;
        }

        $kyc->upi_id = $validated['kyc']['upi_id'];
        $kyc->save();

        Toast::success('Admin UPI details updated successfully.');
    }
}
