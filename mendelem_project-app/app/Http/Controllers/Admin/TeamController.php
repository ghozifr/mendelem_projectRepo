<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Article, Product, Project, Gallery, ContactMessage, Slider, TeamMember};
class TeamController extends Controller
{
    public function index()
    {
        $members = \App\Models\TeamMember::orderBy('order')->get();
        return view('admin.team.index', compact('members'));
    }
    public function create() { return view('admin.team.form', ['member'=>null]); }
    public function store(\Illuminate\Http\Request $r)
    {
        $data = $r->validate([
            'name'    => 'required|string|max:255',
            'role_id' => 'required|string|max:255',
            'role_en' => 'nullable|string|max:255',
            'bio_id'  => 'nullable|string',
            'bio_en'  => 'nullable|string',
            'photo'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'email'   => 'nullable|email',
            'phone'   => 'nullable|string|max:20',
            'order'   => 'integer|min:0',
            'is_active'=> 'boolean',
        ]);
        $data['is_active'] = $r->boolean('is_active', true);
        if ($r->hasFile('photo')) $data['photo'] = $r->file('photo')->store('team','public');
        \App\Models\TeamMember::create($data);
        return redirect()->route('admin.team.index')->with('success', 'Anggota tim ditambahkan!');
    }
    public function edit(\App\Models\TeamMember $team) { return view('admin.team.form', ['member'=>$team]); }
    public function update(\Illuminate\Http\Request $r, \App\Models\TeamMember $team)
    {
        $data = $r->validate([
            'name'    => 'required|string|max:255',
            'role_id' => 'required|string|max:255',
            'role_en' => 'nullable|string|max:255',
            'bio_id'  => 'nullable|string',
            'bio_en'  => 'nullable|string',
            'photo'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'email'   => 'nullable|email',
            'phone'   => 'nullable|string|max:20',
            'order'   => 'integer|min:0',
            'is_active'=> 'boolean',
        ]);
        if ($r->hasFile('photo')) {
            if ($team->photo) \Storage::disk('public')->delete($team->photo);
            $data['photo'] = $r->file('photo')->store('team','public');
        }
        $data['is_active'] = $r->boolean('is_active', true);
        $team->update($data);
        return redirect()->route('admin.team.index')->with('success', 'Anggota tim diperbarui!');
    }
    public function destroy(\App\Models\TeamMember $team)
    {
        if ($team->photo) \Storage::disk('public')->delete($team->photo);
        $team->delete();
        return redirect()->route('admin.team.index')->with('success', 'Anggota tim dihapus.');
    }
    public function reorder(\Illuminate\Http\Request $r)
    {
        foreach ($r->input('order',[]) as $id => $ord) \App\Models\TeamMember::where('id',$id)->update(['order'=>$ord]);
        return response()->json(['success'=>true]);
    }
}
