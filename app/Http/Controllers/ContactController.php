<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'bodyMessage' => $request->message,
        ];

        Mail::send('emails.contact', $data, function ($message) use ($data) {
            $message->to('trizqi711@gmail.com')
                    ->subject('Contact Form Submission')
                    ->from($data['email'], $data['name']);
        });

        return back()->with('success', 'Terima kasih untuk pesan Anda. Kami akan segera menghubungi Anda kembali.');
    }
}
