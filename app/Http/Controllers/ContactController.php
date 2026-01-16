<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Store a contact form submission.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Here you can add logic to send email, save to database, etc.
        // For now, we'll just return a success message
        
        return redirect()->route('contact')->with('status', 'Thank you for your message! We will get back to you soon.');
    }
}
