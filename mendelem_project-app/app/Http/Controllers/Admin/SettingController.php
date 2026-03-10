<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Article, Product, Project, Gallery, ContactMessage, Slider, TeamMember};
class SettingController extends Controller
{
    public function index()
    {
        $settings = \App\Models\SiteSetting::orderBy('group')->orderBy('id')->get()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(\Illuminate\Http\Request $r)
    {
        foreach ($r->except(['_token', '_method']) as $key => $value) {
            \App\Models\SiteSetting::set($key, $value);
        }
        return back()->with('success', 'Pengaturan berhasil disimpan!');
    }

    public function uploadLogo(\Illuminate\Http\Request $r)
    {
        $r->validate(['logo' => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:2048']);
        $old = \App\Models\SiteSetting::get('site_logo');
        if ($old) \Storage::disk('public')->delete($old);
        $path = $r->file('logo')->store('settings', 'public');
        \App\Models\SiteSetting::set('site_logo', $path);
        return back()->with('success', 'Logo berhasil diperbarui!');
    }
}
