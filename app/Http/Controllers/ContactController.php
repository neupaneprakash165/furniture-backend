<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\contact;

class ContactController extends Controller
{
    function contact(Request $req)
    {
        $contact = new Contact;
        $contact->name = $req->input('name');
        $contact->email = $req->input('email');
        $contact->subject = $req->input('subject');
        $contact->message = $req->input('message');
        $contact->save();

        return $contact;
    }
    // Function to retrieve list of contacts
    function contactlist()
    {
        $contacts = Contact::all(); // Retrieve all contacts from the database
        return response()->json($contacts);
    }
}
