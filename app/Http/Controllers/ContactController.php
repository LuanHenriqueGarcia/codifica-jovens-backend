<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:15',
            'email_subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($validatedData);

        return response()->json(['message' => 'Contato enviado com sucesso!'], 201);
    }
}
