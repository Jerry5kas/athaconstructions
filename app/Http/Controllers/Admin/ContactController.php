<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of contact submissions.
     */
    public function index()
    {
        $contacts = Contact::latest()->paginate(20);

        return view('admin.contact-messages.index', [
            'contacts' => $contacts,
        ]);
    }

    /**
     * Display a single contact submission.
     */
    public function show(Contact $contact_message)
    {
        return view('admin.contact-messages.show', [
            'contact' => $contact_message,
        ]);
    }

    /**
     * Remove the specified contact submission from storage.
     */
    public function destroy(Contact $contact_message)
    {
        $contact_message->delete();

        return redirect()
            ->route('admin.contact-messages.index')
            ->with('status', 'Contact message deleted successfully.');
    }
}


