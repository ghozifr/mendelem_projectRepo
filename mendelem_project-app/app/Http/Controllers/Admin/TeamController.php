<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeamMember;

class TeamController extends Controller
{
    public function index()
    {
        $members = TeamMember::orderBy('order')->get();
        return view('admin.team.index', compact('members'));
    }

    public function create() { return view('admin.team.form', ['member' => null]); }

    public function store(Request $r)
    {
        $data = $r->validate([
            'name'     => 'required|string|max:255',
            'role_id'  => 'required|string|max:255',
            'role_en'  => 'nullable|string|max:255',
            'bio_id'   => 'nullable|string',
            'bio_en'   => 'nullable|string',
            'photo'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'email'    => 'nullable|email',
            'phone'    => 'nullable|string|max:20',
            'order'    => 'nullable|integer|min:0',
        ]);

        $data['is_active'] = $r->has('is_active') ? 1 : 0;
        $data['order']     = $data['order'] ?? 0;

        if ($r->hasFile('photo')) {
            $data['photo'] = $r->file('photo')->store('team', 'public');
        }

        TeamMember::create($data);
        return redirect()->route('admin.team.index')->with('success', 'Anggota tim ditambahkan!');
    }

    public function edit(TeamMember $team) { return view('admin.team.form', ['member' => $team]); }

    public function update(Request $r, TeamMember $team)
    {
        $data = $r->validate([
            'name'     => 'required|string|max:255',
            'role_id'  => 'required|string|max:255',
            'role_en'  => 'nullable|string|max:255',
            'bio_id'   => 'nullable|string',
            'bio_en'   => 'nullable|string',
            'photo'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'email'    => 'nullable|email',
            'phone'    => 'nullable|string|max:20',
            'order'    => 'nullable|integer|min:0',
        ]);

        $data['is_active'] = $r->has('is_active') ? 1 : 0;
        $data['order']     = $data['order'] ?? 0;

        if ($r->hasFile('photo')) {
            if ($team->photo) \Storage::disk('public')->delete($team->photo);
            $data['photo'] = $r->file('photo')->store('team', 'public');
        }

        $team->update($data);
        return redirect()->route('admin.team.index')->with('success', 'Anggota tim diperbarui!');
    }

    public function destroy(TeamMember $team)
    {
        if ($team->photo) \Storage::disk('public')->delete($team->photo);
        $team->delete();
        return redirect()->route('admin.team.index')->with('success', 'Anggota tim dihapus.');
    }
}
