<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contactSubmit(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
        // Store the contact message in the database
        Contact::create($validatedData);

        return response()->json(['success' => true, 'message' => 'Your message has been sent successfully!']);
    }
}
