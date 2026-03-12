<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Slider;
use App\Models\Project;
use App\Models\Product;
use App\Models\Gallery;
use App\Models\TeamMember;
use App\Models\Statistic;
use App\Models\SiteSetting;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user — updateOrCreate prevents duplicate error
        User::updateOrCreate(
            ['username' => 'adminPro'],
            [
                'name'       => 'Administrator',
                'email'      => 'mendelemproject@gmail.com',
                'password'   => Hash::make('mendelemPro2026'),
                'role'       => 'superadmin',
                'is_active'  => 1,
            ]
        );

        // Site settings
        $settings = [
            ['key' => 'site_name',    'value' => 'Mendelem Project'],
            ['key' => 'site_tagline', 'value' => 'Pemalang, Jawa Tengah'],
            ['key' => 'site_email',   'value' => 'mendelemproject@gmail.com'],
            ['key' => 'site_address', 'value' => 'Jl. Belik - Mendelem KM 3, Pemalang'],
            ['key' => 'facebook_url', 'value' => ''],
            ['key' => 'instagram_url','value' => ''],
            ['key' => 'youtube_url',  'value' => ''],
            ['key' => 'whatsapp_url', 'value' => ''],
        ];
        foreach ($settings as $s) {
            SiteSetting::updateOrCreate(['key' => $s['key']], ['value' => $s['value']]);
        }

        // Sliders — only seed if empty
        if (Slider::count() === 0) {
            Slider::create([
                'title_id'            => 'Mendelem Project',
                'title_en'            => 'Mendelem Project',
                'subtitle_id'         => 'Pengembangan agribisnis berbasis komunitas di Desa Mendelem, Pemalang.',
                'subtitle_en'         => 'Community-based agribusiness development in Mendelem Village, Pemalang.',
                'tag_id'              => 'Selamat Datang',
                'tag_en'              => 'Welcome',
                'btn_primary_label_id'=> 'Jelajahi Proyek',
                'btn_primary_label_en'=> 'Explore Projects',
                'btn_primary_url'     => '#projects',
                'media_type'          => 'image',
                'is_active'           => 1,
                'order'               => 1,
            ]);
        }

        // Projects — only seed if empty
        if (Project::count() === 0) {
            $projects = [
                ['name_id'=>'SAGUM','name_en'=>'SAGUM','tag_id'=>'Agribisnis','tag_en'=>'Agribusiness','short_desc_id'=>'Unit agribisnis komunitas Mendelem.','short_desc_en'=>'Mendelem community agribusiness unit.','icon'=>'fas fa-seedling','color'=>'#2d9b4e','status'=>'active','is_featured'=>1,'order'=>1],
                ['name_id'=>'Ternak Salam','name_en'=>'Ternak Salam','tag_id'=>'Peternakan','tag_en'=>'Livestock','short_desc_id'=>'Program peternakan kambing dan domba.','short_desc_en'=>'Goat and sheep livestock program.','icon'=>'fas fa-horse','color'=>'#8b6914','status'=>'active','is_featured'=>1,'order'=>2],
                ['name_id'=>'Warung Sate','name_en'=>'Warung Sate','tag_id'=>'Kuliner','tag_en'=>'Culinary','short_desc_id'=>'Warung sate berbasis ternak lokal.','short_desc_en'=>'Satay stall using local livestock.','icon'=>'fas fa-utensils','color'=>'#e25c00','status'=>'active','is_featured'=>1,'order'=>3],
                ['name_id'=>'Budidaya Melon','name_en'=>'Melon Cultivation','tag_id'=>'Pertanian','tag_en'=>'Agriculture','short_desc_id'=>'Budidaya melon premium dalam greenhouse.','short_desc_en'=>'Premium melon cultivation in greenhouse.','icon'=>'fas fa-leaf','color'=>'#5ba52a','status'=>'active','is_featured'=>1,'order'=>4],
                ['name_id'=>'CIS Digitex','name_en'=>'CIS Digitex','tag_id'=>'Digital','tag_en'=>'Digital','short_desc_id'=>'Platform digital manajemen komunitas.','short_desc_en'=>'Digital community management platform.','icon'=>'fas fa-laptop-code','color'=>'#0f75bd','status'=>'active','is_featured'=>0,'order'=>5],
            ];
            foreach ($projects as $p) Project::create($p);
        }

        // Products — only seed if empty
        if (Product::count() === 0) {
            $products = [
                ['name_id'=>'Melon Premium','name_en'=>'Premium Melon','category_id'=>'Buah','category_en'=>'Fruit','description_id'=>'Melon segar berkualitas premium dari greenhouse Mendelem.','description_en'=>'Fresh premium quality melon from Mendelem greenhouse.','icon'=>'fas fa-apple-alt','availability'=>'seasonal','is_active'=>1,'is_featured'=>1,'order'=>1],
                ['name_id'=>'Kambing Lokal','name_en'=>'Local Goat','category_id'=>'Ternak','category_en'=>'Livestock','description_id'=>'Kambing lokal sehat dari program Ternak Salam.','description_en'=>'Healthy local goat from Ternak Salam program.','icon'=>'fas fa-horse','availability'=>'available','is_active'=>1,'is_featured'=>1,'order'=>2],
                ['name_id'=>'Sate Kambing','name_en'=>'Goat Satay','category_id'=>'Kuliner','category_en'=>'Culinary','description_id'=>'Sate kambing lezat dari Warung Sate Mendelem.','description_en'=>'Delicious goat satay from Warung Sate Mendelem.','icon'=>'fas fa-utensils','availability'=>'available','is_active'=>1,'is_featured'=>1,'order'=>3],
                ['name_id'=>'Pupuk Organik','name_en'=>'Organic Fertilizer','category_id'=>'Pertanian','category_en'=>'Agriculture','description_id'=>'Pupuk organik hasil ternak untuk pertanian.','description_en'=>'Organic fertilizer from livestock for agriculture.','icon'=>'fas fa-seedling','availability'=>'available','is_active'=>1,'is_featured'=>1,'order'=>4],
            ];
            foreach ($products as $p) Product::create($p);
        }

        // Team — only seed if empty
        if (TeamMember::count() === 0) {
            $team = [
                ['name'=>'Ketua Mendelem Project','role_id'=>'Ketua Umum','role_en'=>'General Chairman','is_active'=>1,'order'=>1],
                ['name'=>'Koordinator Agribisnis','role_id'=>'Koordinator Agribisnis','role_en'=>'Agribusiness Coordinator','is_active'=>1,'order'=>2],
                ['name'=>'Koordinator Keuangan','role_id'=>'Bendahara','role_en'=>'Treasurer','is_active'=>1,'order'=>3],
            ];
            foreach ($team as $t) TeamMember::create($t);
        }

        // Statistics — only seed if empty
        if (Statistic::count() === 0) {
            $stats = [
                // general bar stats
                ['group'=>'general','label_id'=>'Proyek Aktif','label_en'=>'Active Projects','value'=>'5','unit'=>'+','order'=>1],
                ['group'=>'general','label_id'=>'Anggota Komunitas','label_en'=>'Community Members','value'=>'120','unit'=>'+','order'=>2],
                ['group'=>'general','label_id'=>'Berdiri Sejak','label_en'=>'Founded Since','value'=>'2019','unit'=>'','order'=>3],
                ['group'=>'general','label_id'=>'Desa Terlayani','label_en'=>'Villages Served','value'=>'3','unit'=>'+','order'=>4],
                // financing chart
                ['group'=>'financing','label_id'=>'SAGUM','label_en'=>'SAGUM','value'=>'35','unit'=>'%','color'=>'#0f75bd','order'=>1],
                ['group'=>'financing','label_id'=>'Ternak Salam','label_en'=>'Ternak Salam','value'=>'25','unit'=>'%','color'=>'#2d9b4e','order'=>2],
                ['group'=>'financing','label_id'=>'Budidaya Melon','label_en'=>'Melon Cultivation','value'=>'20','unit'=>'%','color'=>'#5ba52a','order'=>3],
                ['group'=>'financing','label_id'=>'Warung Sate','label_en'=>'Warung Sate','value'=>'12','unit'=>'%','color'=>'#e25c00','order'=>4],
                ['group'=>'financing','label_id'=>'CIS Digitex','label_en'=>'CIS Digitex','value'=>'8','unit'=>'%','color'=>'#8b6914','order'=>5],
                // funding source donut
                ['group'=>'funding_source','label_id'=>'Iuran Anggota','label_en'=>'Member Dues','value'=>'45','unit'=>'%','color'=>'#0f75bd','order'=>1],
                ['group'=>'funding_source','label_id'=>'Hasil Usaha','label_en'=>'Business Revenue','value'=>'35','unit'=>'%','color'=>'#2d9b4e','order'=>2],
                ['group'=>'funding_source','label_id'=>'Donasi Eksternal','label_en'=>'External Donation','value'=>'20','unit'=>'%','color'=>'#e25c00','order'=>3],
            ];
            foreach ($stats as $s) Statistic::create($s);
        }
    }
}
