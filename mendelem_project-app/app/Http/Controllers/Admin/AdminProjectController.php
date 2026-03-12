<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class AdminProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('order')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create() { return view('admin.projects.form', ['project' => null]); }

    public function store(Request $r)
    {
        $data = $r->validate([
            'name_id'        => 'required|string|max:255',
            'name_en'        => 'nullable|string|max:255',
            'short_desc_id'  => 'nullable|string',
            'short_desc_en'  => 'nullable|string',
            'description_id' => 'nullable|string',
            'description_en' => 'nullable|string',
            'tag_id'         => 'nullable|string|max:100',
            'tag_en'         => 'nullable|string|max:100',
            'icon'           => 'nullable|string|max:100',
            'color'          => 'nullable|string|max:20',
            'thumbnail'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'members_count'  => 'nullable|integer|min:0',
            'year_started'   => 'nullable|integer|min:2000',
            'status'         => 'required|in:active,inactive,planned',
            'order'          => 'nullable|integer|min:0',
        ]);

        $data['slug']        = \Illuminate\Support\Str::slug($r->name_id) . '-' . time();
        $data['is_featured'] = $r->has('is_featured') ? 1 : 0;
        $data['members_count'] = $data['members_count'] ?? 0;
        $data['order']       = $data['order'] ?? 0;

        if ($r->hasFile('thumbnail')) {
            $data['thumbnail'] = $r->file('thumbnail')->store('projects', 'public');
        }

        Project::create($data);
        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil ditambahkan!');
    }

    public function edit(Project $project) { return view('admin.projects.form', compact('project')); }

    public function update(Request $r, Project $project)
    {
        $data = $r->validate([
            'name_id'        => 'required|string|max:255',
            'name_en'        => 'nullable|string|max:255',
            'short_desc_id'  => 'nullable|string',
            'short_desc_en'  => 'nullable|string',
            'description_id' => 'nullable|string',
            'description_en' => 'nullable|string',
            'tag_id'         => 'nullable|string|max:100',
            'tag_en'         => 'nullable|string|max:100',
            'icon'           => 'nullable|string|max:100',
            'color'          => 'nullable|string|max:20',
            'thumbnail'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'members_count'  => 'nullable|integer|min:0',
            'year_started'   => 'nullable|integer|min:2000',
            'status'         => 'required|in:active,inactive,planned',
            'order'          => 'nullable|integer|min:0',
        ]);

        $data['is_featured']   = $r->has('is_featured') ? 1 : 0;
        $data['members_count'] = $data['members_count'] ?? 0;
        $data['order']         = $data['order'] ?? 0;

        if ($r->hasFile('thumbnail')) {
            if ($project->thumbnail) \Storage::disk('public')->delete($project->thumbnail);
            $data['thumbnail'] = $r->file('thumbnail')->store('projects', 'public');
        }

        $project->update($data);
        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil diperbarui!');
    }

    public function destroy(Project $project)
    {
        if ($project->thumbnail) \Storage::disk('public')->delete($project->thumbnail);
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Proyek dihapus.');
    }

    public function uploadGallery(Request $r, Project $project)
    {
        $r->validate(['image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120']);
        $path    = $r->file('image')->store('projects/gallery', 'public');
        $gallery = $project->gallery ?? [];
        $gallery[] = $path;
        $project->update(['gallery' => $gallery]);
        return response()->json(['success' => true, 'path' => asset('storage/' . $path), 'index' => count($gallery) - 1]);
    }

    public function deleteGallery(Request $r, Project $project, int $index)
    {
        $gallery = $project->gallery ?? [];
        if (isset($gallery[$index])) {
            \Storage::disk('public')->delete($gallery[$index]);
            array_splice($gallery, $index, 1);
            $project->update(['gallery' => array_values($gallery)]);
        }
        return response()->json(['success' => true]);
    }
}
