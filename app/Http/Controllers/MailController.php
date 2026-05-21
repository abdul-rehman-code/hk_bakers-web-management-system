<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class MailController extends Controller
{
    public function submitForm(Request $request)
    {
        // 1. Validation
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // 2. Email Send Karein
        Mail::to('hafizabdulrehman6815@gmail.com')->send(new ContactMail($validatedData));

        // 3. Response: HTML ki bajaye JSON return karein (AJAX ke liye)
        return response()->json([
            'success' => true,
            'message' => 'Thank you! Your message has been sent successfully.'
        ]);
    }
}
