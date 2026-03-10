<?php
class ContactController extends Controller
{
    public function send(Request $r)
    {
        $data = $r->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'purpose' => 'nullable|string|max:100',
            'message' => 'required|string|max:5000',
        ]);

        \App\Models\ContactMessage::create($data);

        // Optional: send email notification
        // Mail::to('mendelemproject@gmail.com')->send(new ContactMail($data));

        return back()->with('contact_success', true);
    }
}
