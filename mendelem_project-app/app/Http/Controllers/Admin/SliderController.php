<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Article, Product, Project, Gallery, ContactMessage, Slider, TeamMember};
class SliderController extends Controller
{
    public function index()
    {
        $sliders = \App\Models\Slider::orderBy('order')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create() { return view('admin.sliders.form', ['slider'=>null]); }

    public function store(\Illuminate\Http\Request $r)
    {
        $data = $r->validate([
            'title_id'              => 'required|string|max:255',
            'title_en'              => 'nullable|string|max:255',
            'subtitle_id'           => 'nullable|string',
            'subtitle_en'           => 'nullable|string',
            'tag_id'                => 'nullable|string|max:100',
            'tag_en'                => 'nullable|string|max:100',
            'btn_primary_label_id'  => 'nullable|string|max:100',
            'btn_primary_label_en'  => 'nullable|string|max:100',
            'btn_primary_url'       => 'nullable|string|max:255',
            'btn_secondary_label_id'=> 'nullable|string|max:100',
            'btn_secondary_label_en'=> 'nullable|string|max:100',
            'btn_secondary_url'     => 'nullable|string|max:255',
            'media_type'            => 'required|in:image,video',
            'media_file'            => 'nullable|file|mimes:jpg,jpeg,png,webp,gif,mp4,webm|max:51200',
            'order'                 => 'integer|min:0',
            'is_active'             => 'boolean',
        ]);

        if ($r->hasFile('media_file')) {
            $data['media_path'] = $r->file('media_file')->store('sliders', 'public');
        }
        unset($data['media_file']);
        $data['is_active'] = $r->boolean('is_active', true);

        \App\Models\Slider::create($data);
        return redirect()->route('admin.sliders.index')->with('success', 'Slider berhasil ditambahkan!');
    }

    public function edit(\App\Models\Slider $slider) { return view('admin.sliders.form', compact('slider')); }

    public function update(\Illuminate\Http\Request $r, \App\Models\Slider $slider)
    {
        $data = $r->validate([
            'title_id'   => 'required|string|max:255',
            'title_en'   => 'nullable|string|max:255',
            'subtitle_id'=> 'nullable|string',
            'subtitle_en'=> 'nullable|string',
            'tag_id'     => 'nullable|string|max:100',
            'tag_en'     => 'nullable|string|max:100',
            'btn_primary_label_id'  => 'nullable|string|max:100',
            'btn_primary_label_en'  => 'nullable|string|max:100',
            'btn_primary_url'       => 'nullable|string|max:255',
            'btn_secondary_label_id'=> 'nullable|string|max:100',
            'btn_secondary_label_en'=> 'nullable|string|max:100',
            'btn_secondary_url'     => 'nullable|string|max:255',
            'media_type' => 'required|in:image,video',
            'media_file' => 'nullable|file|mimes:jpg,jpeg,png,webp,gif,mp4,webm|max:51200',
            'order'      => 'integer|min:0',
            'is_active'  => 'boolean',
        ]);

        if ($r->hasFile('media_file')) {
            if ($slider->media_path) \Storage::disk('public')->delete($slider->media_path);
            $data['media_path'] = $r->file('media_file')->store('sliders', 'public');
        }
        unset($data['media_file']);
        $data['is_active'] = $r->boolean('is_active', true);

        $slider->update($data);
        return redirect()->route('admin.sliders.index')->with('success', 'Slider berhasil diperbarui!');
    }

    public function destroy(\App\Models\Slider $slider)
    {
        if ($slider->media_path) \Storage::disk('public')->delete($slider->media_path);
        $slider->delete();
        return redirect()->route('admin.sliders.index')->with('success', 'Slider dihapus.');
    }

    public function reorder(\Illuminate\Http\Request $r, \App\Models\Slider $slider)
    {
        $slider->update(['order' => $r->input('order')]);
        return response()->json(['success' => true]);
    }
}
