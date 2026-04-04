<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $r)
    {
        $r->validate([
            'site_name'     => 'nullable|string|max:100',
            'site_tagline'  => 'nullable|string|max:150',
            'site_email'    => 'nullable|email|max:150',
            'site_address'  => 'nullable|string|max:255',
            'facebook_url'  => 'nullable|string|max:255',
            'instagram_url' => 'nullable|string|max:255',
            'youtube_url'   => 'nullable|string|max:255',
            'whatsapp_url'  => 'nullable|string|max:255',
            'whatsapp_number' => 'nullable|string|max:20',
        ]);

        $keys = [
            'site_name','site_tagline','site_email','site_address',
            'facebook_url','instagram_url','youtube_url','whatsapp_url',
            'whatsapp_number',
        ];

        foreach ($keys as $key) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $r->input($key, '')]
            );
        }

        return back()->with('success', 'Pengaturan berhasil disimpan!');
    }

    // Upload logo gambar
    public function uploadLogo(Request $r)
    {
        $r->validate([
            'logo' => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
        ]);

        // Hapus logo lama jika ada
        $old = SiteSetting::where('key', 'site_logo')->value('value');
        if ($old && $old !== 'default') {
            Storage::disk('public')->delete($old);
        }

        $path = $r->file('logo')->store('settings', 'public');

        SiteSetting::updateOrCreate(
            ['key' => 'site_logo'],
            ['value' => $path]
        );

        return back()->with('success', 'Logo berhasil diperbarui!');
    }

    // Hapus logo (kembali ke inisial "M")
    public function deleteLogo(Request $r)
    {
        $old = SiteSetting::where('key', 'site_logo')->value('value');
        if ($old && $old !== 'default') {
            Storage::disk('public')->delete($old);
        }
        SiteSetting::updateOrCreate(['key' => 'site_logo'], ['value' => null]);

        return back()->with('success', 'Logo dihapus, kembali ke inisial.');
    }
}

// namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
// use App\Models\{Article, Product, Project, Gallery, ContactMessage, Slider, TeamMember};
// class SettingController extends Controller
// {
//     public function index()
//     {
//         $settings = \App\Models\SiteSetting::orderBy('group')->orderBy('id')->get()->groupBy('group');
//         return view('admin.settings.index', compact('settings'));
//     }

//     public function update(\Illuminate\Http\Request $r)
//     {
//         foreach ($r->except(['_token', '_method']) as $key => $value) {
//             \App\Models\SiteSetting::set($key, $value);
//         }
//         return back()->with('success', 'Pengaturan berhasil disimpan!');
//     }

//     public function uploadLogo(\Illuminate\Http\Request $r)
//     {
//         $r->validate(['logo' => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:2048']);
//         $old = \App\Models\SiteSetting::get('site_logo');
//         if ($old) \Storage::disk('public')->delete($old);
//         $path = $r->file('logo')->store('settings', 'public');
//         \App\Models\SiteSetting::set('site_logo', $path);
//         return back()->with('success', 'Logo berhasil diperbarui!');
//     }
// }
