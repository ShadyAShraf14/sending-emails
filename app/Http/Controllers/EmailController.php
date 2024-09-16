<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function index()
    {
        $emails = DB::table('emails')->get();
        return view('emails', compact('emails'));
    }

    public function sendEmails(Request $request)
{
    // Validate that message is provided
    $request->validate([
        'message' => 'required|string',
    ]);

    $emails = DB::table('emails')->pluck('email');
    $message = $request->input('message');

    // Check if emails are available
    if ($emails->isEmpty()) {
        session()->flash('error', 'No emails found.');
        return redirect()->back();
    }

    foreach ($emails as $email) {
        Mail::raw($message, function ($msg) use ($email) {
            $msg->to($email)->subject('Test Email');
        });
    }

    // Flash message to session
    session()->flash('success', 'Emails sent successfully!');

    return redirect()->back();
}

}
