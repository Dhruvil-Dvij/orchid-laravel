<?php

namespace App\Http\Controllers;

use App\Models\CustomerSupport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CustomerSupportController extends Controller
{
    public function addCustomerSupport(Request $request)
    {
        $validatedData = $request->validate([
            'subject'     => 'required|string|max:255',
            'category'    => 'required|string|max:100',
            'description' => 'required|string',
            'attachment'  => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // ===============================
        // Handle file upload (if exists)
        // ===============================
        $attachmentPath = null;

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');

            $datePath = now()->format('Y/m/d'); // YYYY/MM/DD
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

            // storage/app/customer-support/YYYY/MM/DD/filename.ext
            $attachmentPath = $file->storeAs(
                "customer-support/{$datePath}",
                $fileName
            );
        }

        // ===============================
        // Store customer support ticket
        // ===============================
        $customerSupport = new CustomerSupport();
        $customerSupport->user_id = Auth::id(); // nullable if not logged in
        $customerSupport->subject = $validatedData['subject'];
        $customerSupport->category = $validatedData['category'];
        $customerSupport->description = $validatedData['description'];
        $customerSupport->attachment_path = $attachmentPath;
        $customerSupport->status = 'open';      // default
        $customerSupport->save();

        return response()->json([
            'success' => true,
            'message' => 'Support request submitted successfully.',
            'data'    => $customerSupport
        ], 201);
    }

    public function downloadAttachment(CustomerSupport $support)
    {
        if (!$support->attachment_path) {
            abort(404, 'Attachment not found.');
        }

        if (!Storage::exists($support->attachment_path)) {
            abort(404, 'File does not exist.');
        }

        return Storage::download($support->attachment_path);
    }

    public function viewAttachment($id)
    {
        $support = CustomerSupport::findOrFail($id);

        if (!$support->attachment_path) {
            abort(404, 'Attachment not found');
        }

        // Full path inside private disk
        $path = 'customer-support/' . $support->attachment_path;

        if (!Storage::disk('private')->exists($path)) {
            abort(404, 'File not found on server');
        }

        $mime = Storage::disk('private')->mimeType($path);

        return response(
            Storage::disk('private')->get($path),
            200,
            [
                'Content-Type'        => $mime,
                'Content-Disposition' => 'inline', // 🔑 OPEN IN NEW TAB
            ]
        );
    }
}
