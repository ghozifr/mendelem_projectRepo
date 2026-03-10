<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Article, Product, Project, Gallery, ContactMessage, Slider, TeamMember};
class MessageController extends Controller
{
    public function index()
    {
        $messages = \App\Models\ContactMessage::latest()->paginate(20);
        return view('admin.messages.index', compact('messages'));
    }
    public function show(\App\Models\ContactMessage $message)
    {
        if ($message->status === 'unread') $message->update(['status'=>'read','read_at'=>now()]);
        return view('admin.messages.show', compact('message'));
    }
    public function destroy(\App\Models\ContactMessage $message)
    {
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Pesan dihapus.');
    }
    public function markRead(\App\Models\ContactMessage $message)
    {
        $message->update(['status'=>'read','read_at'=>now()]);
        return back()->with('success', 'Ditandai sudah dibaca.');
    }
}
