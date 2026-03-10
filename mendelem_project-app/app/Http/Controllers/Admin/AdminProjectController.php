<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Article, Product, Project, Gallery, ContactMessage, Slider, TeamMember};
class AdminProjectController extends Controller
{
    public function index()
    {
        $projects = \App\Models\Project::orderBy('order')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create() { return view('admin.projects.form', ['project'=>null]); }

    public function store(\Illuminate\Http\Request $r)
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
            'members_count'  => 'integer|min:0',
            'year_started'   => 'nullable|integer|min:2000',
            'status'         => 'required|in:active,inactive,planned',
            'order'          => 'integer|min:0',
            'is_featured'    => 'boolean',
        ]);

        $data['slug'] = \Illuminate\Support\Str::slug($r->name_id) . '-' . time();
        $data['is_featured'] = $r->boolean('is_featured');
        if ($r->hasFile('thumbnail')) {
            $data['thumbnail'] = $r->file('thumbnail')->store('projects', 'public');
        }

        \App\Models\Project::create($data);
        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil ditambahkan!');
    }

    public function edit(\App\Models\Project $project) { return view('admin.projects.form', compact('project')); }

    public function update(\Illuminate\Http\Request $r, \App\Models\Project $project)
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
            'members_count'  => 'integer|min:0',
            'year_started'   => 'nullable|integer|min:2000',
            'status'         => 'required|in:active,inactive,planned',
            'order'          => 'integer|min:0',
            'is_featured'    => 'boolean',
        ]);

        if ($r->hasFile('thumbnail')) {
            if ($project->thumbnail) \Storage::disk('public')->delete($project->thumbnail);
            $data['thumbnail'] = $r->file('thumbnail')->store('projects', 'public');
        }
        $data['is_featured'] = $r->boolean('is_featured');

        $project->update($data);
        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil diperbarui!');
    }

    public function destroy(\App\Models\Project $project)
    {
        if ($project->thumbnail) \Storage::disk('public')->delete($project->thumbnail);
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Proyek dihapus.');
    }

    public function uploadGallery(\Illuminate\Http\Request $r, \App\Models\Project $project)
    {
        $r->validate(['image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120']);
        $path    = $r->file('image')->store('projects/gallery', 'public');
        $gallery = $project->gallery ?? [];
        $gallery[] = $path;
        $project->update(['gallery' => $gallery]);
        return response()->json(['success'=>true,'path'=>asset('storage/'.$path),'index'=>count($gallery)-1]);
    }

    public function deleteGallery(\Illuminate\Http\Request $r, \App\Models\Project $project, int $index)
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
