<?php

namespace App\Orchid\Screens\CustomerSupport;

use App\Models\BankAccount;
use App\Orchid\Layouts\Bank\AdminUpiLayout;
use App\Orchid\Layouts\Bank\UserBankEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Screen;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Color;

class CustomerBankEditScreen extends Screen
{
    public $bank;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(BankAccount $bank): iterable
    {

        $bank->load('bankKyc');
        $fields = [
            'qr_code_img',
            'passbook_img',
        ];

        foreach ($fields as $field) {

            if ($field === 'qr_code_img' && !empty($bank->$field)) {
                $bank->$field = !str_starts_with($bank->$field, 'http') ? asset(ltrim($bank->$field, '/')) : $bank->$field;
            }

            if ($field === 'passbook_img' && !empty($bank->bankKyc->$field)) {
                $bank->bankKyc->$field = asset(ltrim($bank->bankKyc->$field, '/'));
            }
        }
        // dd($bank);
        return [
            'bank' => $bank,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Customer Bank Update';
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

        return redirect()->route('platform.customer.banks', $bank->user_id);
    }

    public function updateAdminUpi(BankAccount $bank, Request $request)
    {
        // abort_unless(
        //     auth()->user()->roles()->where('slug', 'admin')->exists(),
        //     403
        // );


        $validated = $request->validate([
            'bank.upi_id' => 'string|max:255',
            'bank.new_qr_code_img'       => 'nullable|array|max:2048',
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

        $qrCodeImgPath = $getPath($request->input('bank.new_qr_code_img')[0] ?? null);

        $bank->upi_id = $validated['bank']['upi_id'];
        $bank->qr_code_img = $qrCodeImgPath;
        $bank->save();
        Toast::success('Admin UPI details updated successfully.');
    }
}
