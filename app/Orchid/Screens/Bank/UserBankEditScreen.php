<?php

namespace App\Orchid\Screens\Bank;

use App\Models\BankAccount;
use App\Models\KycSubmission;
use App\Orchid\Layouts\Bank\AdminUpiLayout;
use App\Orchid\Layouts\Bank\UserBankEditLayout;
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
use Orchid\Attachment\Models\Attachment;

class UserBankEditScreen extends Screen
{
    public $bank;

    public function query(BankAccount $bank): iterable
    {
        $fields = [
            'qr_code_img',
        ];
        foreach ($fields as $field) {

            if (!empty($bank->$field)) {
                $bank->$field = asset(ltrim($bank->$field, '/'));
            }
        }
        return [
            'bank' => $bank,
        ];
    }

    public function name(): ?string
    {
        return 'Update Bank Details';
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
        // if (Auth::user()?->roles()->where('slug', 'admin')->exists()) {
            $layouts[] =
                Layout::block(AdminUpiLayout::class)
                ->title(__('UPI Details'))
                ->description(__('You can update UPI ID and QR code.'))
                ->commands(
                    Button::make(__('Save UPI'))
                        ->type(Color::PRIMARY())
                        ->icon('bs.shield-check')
                        ->method('updateAdminUpi')
                );
        // }

        return $layouts;
    }

    public function update(BankAccount $bank, Request $request)
    {
        $bank->update($request->get('bank'));

        Toast::success('Bank details updated successfully.');

        return redirect()->route('platform.user.bank.list');
    }

    public function updateAdminUpi(BankAccount $bank, Request $request)
    {
        // abort_unless(
        //     auth()->user()->roles()->where('slug', 'admin')->exists(),
        //     403
        // );

        // dd($kyc->upi_id);

        $validated = $request->validate([
            'bank.upi_id' => 'string|max:255',
            'bank.new_qr_code_img'       => 'nullable|array|max:2048',
            // 'kyc.qr_code_img'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

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

        // if ($request->hasFile('kyc.qr_code_img')) {

        //     $file = $request->file('kyc.qr_code_img');

        //     // Folder: public/kyc/upi
        //     $destination = public_path('kyc/upi');

        //     // Create directory if not exists
        //     if (!file_exists($destination)) {
        //         mkdir($destination, 0755, true);
        //     }

        //     // Delete old file if exists
        //     if ($kyc->qr_code_img && file_exists(public_path($kyc->qr_code_img))) {
        //         unlink(public_path($kyc->qr_code_img));
        //     }

        //     // Generate unique filename
        //     $filename = 'qr_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();

        //     // Move file
        //     $file->move($destination, $filename);

        //     // Save RELATIVE path in DB
        //     $kyc->qr_code_img = 'kyc/upi/' . $filename;
        // }

        $qrCodeImgPath = $getPath($request->input('bank.new_qr_code_img')[0] ?? null);

        $bank->upi_id = $validated['bank']['upi_id'];
        $bank->qr_code_img = $qrCodeImgPath;
        $bank->save();
        Toast::success('Admin UPI details updated successfully.');
    }
}
