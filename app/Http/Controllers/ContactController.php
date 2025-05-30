<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    public function index()
    {
        $contacts = Contact::all();
        return view('admin.contact', compact('contacts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sender_name' => 'required',
            'sender_email' => 'required',
            'sender_phone' => 'required',
            'sender_project' => 'required',
            'sender_subject' => 'required',
            'sender_message' => 'required'
        ]);

        $record = Contact::create([
            'sender_name' => $request->sender_name,
            'sender_email' => $request->sender_email,
            'sender_phone' => $request->sender_phone,
            'sender_project' => $request->sender_project,
            'sender_subject' => $request->sender_subject,
            'sender_message' => $request->sender_message
        ]);

        if ($record) {
            $data = [
                'sender_name' => $request->sender_name,
                'sender_email' => $request->sender_email,
                'sender_phone' => $request->sender_phone,
                'sender_project' => $request->sender_project,
                'sender_subject' => $request->sender_subject,
                'sender_message' => $request->sender_message
            ];

            // Send email notification
            $email = $request->sender_email;
            Mail::to('webappofficial@gmail.com')->send(new ContactFormMail($data));
        }

            return redirect()->back()->with('Success', 'Message Sent Successfully !');
       
    }

    public function destroy($id)
    {
        $delete = Contact::find($id);
        $delete->delete();

        return redirect()->back()->with('Success', 'Contact deleted Successfully !');
    }
}
