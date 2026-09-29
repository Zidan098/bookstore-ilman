<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string', 'max:2000'],
        ]);

        Message::create([
            'user_id' => Auth::id(),
            'subject' => $validated['subject'],
            'body' => $validated['body'],
            'is_read' => false,
        ]);

        return back()->with('success', 'Pesan Anda berhasil dikirim ke Administrator WahyuStore!');
    }
}
