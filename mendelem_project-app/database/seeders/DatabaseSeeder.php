<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\SiteSetting;
use App\Models\Slider;
use App\Models\Project;
use App\Models\Product;
use App\Models\Article;
use App\Models\TeamMember;
use App\Models\Statistic;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── ADMIN USER ──────────────────────────────────────────
        User::create([
            'name'     => 'Administrator',
            'username' => 'adminPro',
            'email'    => 'mendelemproject@gmail.com',
            'password' => Hash::make('mendelemPro2026'),
            'role'     => 'superadmin',
            'is_active'=> true,
        ]);

        // ── SITE SETTINGS ────────────────────────────────────────
        $settings = [
            // General
            ['key'=>'site_name',       'value'=>'Mendelem Project',  'type'=>'text',  'group'=>'general', 'label'=>'Nama Situs'],
            ['key'=>'site_tagline_id', 'value'=>'Membangun Ekonomi Pedesaan yang Berkelanjutan','type'=>'text','group'=>'general','label'=>'Tagline (ID)'],
            ['key'=>'site_tagline_en', 'value'=>'Building a Sustainable Rural Economy','type'=>'text','group'=>'general','label'=>'Tagline (EN)'],
            ['key'=>'site_description_id','value'=>'Pengembangan agribisnis berbasis komunitas di Desa Mendelem, Pemalang, Jawa Tengah.','type'=>'text','group'=>'general','label'=>'Deskripsi (ID)'],
            ['key'=>'site_description_en','value'=>'Community-based agribusiness development in Mendelem Village, Pemalang, Central Java.','type'=>'text','group'=>'general','label'=>'Deskripsi (EN)'],
            ['key'=>'site_logo',       'value'=>null,                'type'=>'image', 'group'=>'general', 'label'=>'Logo Situs'],
            ['key'=>'site_favicon',    'value'=>null,                'type'=>'image', 'group'=>'general', 'label'=>'Favicon'],
            // Contact
            ['key'=>'contact_email',   'value'=>'mendelemproject@gmail.com','type'=>'text','group'=>'contact','label'=>'Email'],
            ['key'=>'contact_phone',   'value'=>'',                  'type'=>'text',  'group'=>'contact', 'label'=>'Telepon'],
            ['key'=>'contact_address_id','value'=>'Jl. Belik - Mendelem No. KM 3, Mendelem, Belik, Pemalang, Jawa Tengah 52356','type'=>'text','group'=>'contact','label'=>'Alamat (ID)'],
            ['key'=>'contact_address_en','value'=>'Jl. Belik - Mendelem No. KM 3, Mendelem, Belik, Pemalang, Central Java 52356','type'=>'text','group'=>'contact','label'=>'Alamat (EN)'],
            ['key'=>'operating_hours_id','value'=>'Senin – Sabtu: 08.00 – 17.00 WIB','type'=>'text','group'=>'contact','label'=>'Jam Operasional (ID)'],
            ['key'=>'operating_hours_en','value'=>'Monday – Saturday: 08:00 – 17:00 WIB','type'=>'text','group'=>'contact','label'=>'Jam Operasional (EN)'],
            // Social
            ['key'=>'social_facebook', 'value'=>'',                  'type'=>'text',  'group'=>'social',  'label'=>'Facebook URL'],
            ['key'=>'social_instagram','value'=>'',                  'type'=>'text',  'group'=>'social',  'label'=>'Instagram URL'],
            ['key'=>'social_youtube',  'value'=>'',                  'type'=>'text',  'group'=>'social',  'label'=>'YouTube URL'],
            ['key'=>'social_whatsapp', 'value'=>'',                  'type'=>'text',  'group'=>'social',  'label'=>'WhatsApp Number'],
            // Bank
            ['key'=>'bank_bri_number', 'value'=>'1234-5678-9012-345','type'=>'text',  'group'=>'donation','label'=>'No. Rekening BRI'],
            ['key'=>'bank_bri_name',   'value'=>'Mendelem Project',  'type'=>'text',  'group'=>'donation','label'=>'Nama Rekening BRI'],
            ['key'=>'bank_bsi_number', 'value'=>'7890-1234-567',     'type'=>'text',  'group'=>'donation','label'=>'No. Rekening BSI'],
            ['key'=>'bank_bsi_name',   'value'=>'Mendelem Project',  'type'=>'text',  'group'=>'donation','label'=>'Nama Rekening BSI'],
        ];
        foreach ($settings as $s) SiteSetting::create($s);

        // ── SLIDERS ──────────────────────────────────────────────
        $sliders = [
            ['title_id'=>'Membangun Ekonomi Pedesaan yang Berkelanjutan','title_en'=>'Building a Sustainable Rural Economy','subtitle_id'=>'Pengembangan agribisnis berbasis komunitas di Desa Mendelem, Pemalang, Jawa Tengah.','subtitle_en'=>'Community-based agribusiness development in Mendelem village, Pemalang, Central Java.','tag_id'=>'Selamat Datang','tag_en'=>'Welcome','btn_primary_label_id'=>'Jelajahi Proyek','btn_primary_label_en'=>'Explore Projects','btn_primary_url'=>'/projects','btn_secondary_label_id'=>'Tentang Kami','btn_secondary_label_en'=>'About Us','btn_secondary_url'=>'/about','media_type'=>'image','order'=>1,'is_active'=>true],
            ['title_id'=>'Dari Ladang Menuju Usaha yang Berkembang','title_en'=>'From Farming to Thriving Enterprises','subtitle_id'=>'SAGUM, Ternak Salam, Warung Sate, Budidaya Melon — semua didukung semangat komunitas.','subtitle_en'=>'SAGUM, Ternak Salam, Warung Sate, Melon Cultivation — all powered by community spirit.','tag_id'=>'Proyek Unggulan','tag_en'=>'Featured Projects','btn_primary_label_id'=>'Lihat Semua Proyek','btn_primary_label_en'=>'See All Projects','btn_primary_url'=>'/projects','btn_secondary_label_id'=>null,'btn_secondary_label_en'=>null,'btn_secondary_url'=>null,'media_type'=>'image','order'=>2,'is_active'=>true],
            ['title_id'=>'Produk Berkualitas, Langsung dari Desa','title_en'=>'Quality Products, Direct from the Village','subtitle_id'=>'Melon, Kambing, Sate, Gula Aren, Kulit Melinjo — produk lokal segar yang dapat dipercaya.','subtitle_en'=>'Melon, Goat, Satay, Aren Sugar, Melinjo Skin — fresh local produce you can trust.','tag_id'=>'Produk Kami','tag_en'=>'Our Products','btn_primary_label_id'=>'Lihat Produk Kami','btn_primary_label_en'=>'See Our Products','btn_primary_url'=>'/products','btn_secondary_label_id'=>'Dukung Kami','btn_secondary_label_en'=>'Support Us','btn_secondary_url'=>'/support','media_type'=>'image','order'=>3,'is_active'=>true],
        ];
        foreach ($sliders as $s) Slider::create($s);

        // ── PROJECTS ─────────────────────────────────────────────
        $projects = [
            ['slug'=>'sagum','name_id'=>'SAGUM','name_en'=>'SAGUM','short_desc_id'=>'Unit pasar agribisnis untuk distribusi dan penjualan produk lokal.','short_desc_en'=>'Agribusiness market unit for local produce distribution and sales.','description_id'=>'Sarana Agribisnis Guna Umat (SAGUM) adalah unit pasar agribisnis Mendelem Project yang berfungsi sebagai pusat distribusi dan penjualan produk-produk pertanian dan peternakan lokal. SAGUM menghubungkan petani dan peternak lokal langsung dengan konsumen, menghilangkan rantai distribusi yang panjang dan memastikan harga yang adil untuk semua pihak.','description_en'=>'Sarana Agribisnis Guna Umat (SAGUM) is the Mendelem Project agribusiness market unit functioning as a distribution and sales center for local agricultural and livestock products.','tag_id'=>'Agribisnis','tag_en'=>'Agribusiness','icon'=>'fas fa-store','color'=>'#0f75bd','members_count'=>30,'year_started'=>2020,'status'=>'active','order'=>1,'is_featured'=>true],
            ['slug'=>'ternak-salam','name_id'=>'Ternak Salam','name_en'=>'Ternak Salam','short_desc_id'=>'Program peternakan kambing dan domba untuk ketahanan pangan komunitas.','short_desc_en'=>'Community goat and sheep livestock program supporting food security.','description_id'=>'Ternak Salam adalah program peternakan berbasis komunitas yang berfokus pada pemeliharaan kambing dan domba. Program ini tidak hanya menyediakan sumber protein hewani bagi komunitas, tetapi juga menjadi sumber pendapatan yang signifikan melalui penjualan ternak hidup, daging, dan produk turunannya.','description_en'=>'Ternak Salam is a community-based livestock program focused on goat and sheep rearing, providing both animal protein and significant income for the community.','tag_id'=>'Peternakan','tag_en'=>'Livestock','icon'=>'fas fa-horse','color'=>'#8cc63e','members_count'=>25,'year_started'=>2020,'status'=>'active','order'=>2,'is_featured'=>true],
            ['slug'=>'warung-sate','name_id'=>'Warung Sate','name_en'=>'Warung Sate','short_desc_id'=>'Warung sate komunitas dengan daging kambing lokal dan resep tradisional.','short_desc_en'=>'Community satay stall using locally-raised goat meat with traditional recipes.','description_id'=>'Warung Sate Mendelem adalah unit bisnis kuliner komunitas yang menyajikan sate kambing premium menggunakan daging kambing segar dari proyek Ternak Salam. Warung ini menggunakan resep tradisional yang diwariskan turun-temurun.','description_en'=>'Warung Sate Mendelem is a community culinary business unit serving premium goat satay using fresh goat meat from the Ternak Salam project.','tag_id'=>'Kuliner','tag_en'=>'Culinary','icon'=>'fas fa-utensils','color'=>'#e67e22','members_count'=>15,'year_started'=>2021,'status'=>'active','order'=>3,'is_featured'=>true],
            ['slug'=>'budidaya-melon','name_id'=>'Budidaya Melon','name_en'=>'Melon Cultivation','short_desc_id'=>'Budidaya melon premium di greenhouse komunitas dengan teknologi modern.','short_desc_en'=>'Premium melon cultivation using modern agro-technology in community greenhouses.','description_id'=>'Proyek Budidaya Melon Mendelem menggunakan teknologi greenhouse modern yang dikombinasikan dengan metode pertanian organik. Melon yang dihasilkan adalah melon premium berkualitas tinggi yang bebas pestisida berbahaya, menggunakan sistem irigasi tetes yang efisien.','description_en'=>'The Mendelem Melon Cultivation project uses modern greenhouse technology combined with organic farming methods, producing high-quality premium melons free from harmful pesticides.','tag_id'=>'Hortikultura','tag_en'=>'Horticulture','icon'=>'fas fa-apple-alt','color'=>'#27ae60','members_count'=>20,'year_started'=>2022,'status'=>'active','order'=>4,'is_featured'=>true],
            ['slug'=>'cis-digitex','name_id'=>'CIS Digitex','name_en'=>'CIS Digitex','short_desc_id'=>'Platform digital untuk manajemen agribisnis pedesaan Mendelem Project.','short_desc_en'=>'Digital platform for Mendelem Project rural agribusiness management.','description_id'=>'Community Information System Digitex (CIS Digitex) adalah platform digital yang menjadi tulang punggung teknologi informasi Mendelem Project. Sistem ini mengintegrasikan manajemen anggota, pencatatan transaksi keuangan, monitoring proyek, dan komunikasi komunitas dalam satu platform terpadu.','description_en'=>'Community Information System Digitex (CIS Digitex) is the digital platform serving as the IT backbone of Mendelem Project, integrating member management, financial recording, and project monitoring.','tag_id'=>'Digital','tag_en'=>'Digital','icon'=>'fas fa-laptop-code','color'=>'#8e44ad','members_count'=>10,'year_started'=>2023,'status'=>'active','order'=>5,'is_featured'=>true],
        ];
        foreach ($projects as $p) Project::create($p);

        // ── PRODUCTS ─────────────────────────────────────────────
        $products = [
            ['name_id'=>'Kulit Melinjo','name_en'=>'Melinjo Skin','category_id'=>'Camilan Lokal','category_en'=>'Local Snack','description_id'=>'Kulit melinjo segar berkualitas tinggi dari pohon melinjo lokal, bisa diolah menjadi emping atau dikonsumsi langsung.','icon'=>'fas fa-leaf','availability'=>'available','order'=>1,'is_featured'=>true],
            ['name_id'=>'Melon','name_en'=>'Melon','category_id'=>'Buah Segar','category_en'=>'Fresh Fruit','description_id'=>'Melon premium hasil budidaya greenhouse Mendelem, manis segar dan bebas pestisida berbahaya.','icon'=>'fas fa-apple-alt','availability'=>'available','order'=>2,'is_featured'=>true],
            ['name_id'=>'Gula Aren','name_en'=>'Palm Sugar','category_id'=>'Pemanis Alami','category_en'=>'Natural Sweetener','description_id'=>'Gula aren murni dari pohon aren lokal, diolah secara tradisional tanpa campuran bahan kimia.','icon'=>'fas fa-cookie-bite','availability'=>'available','order'=>3,'is_featured'=>false],
            ['name_id'=>'Sate Kambing','name_en'=>'Goat Satay','category_id'=>'Kuliner','category_en'=>'Culinary','description_id'=>'Sate kambing premium dari Warung Sate Mendelem, menggunakan kambing segar dari Ternak Salam dengan bumbu rahasia turun-temurun.','icon'=>'fas fa-drumstick-bite','availability'=>'available','order'=>4,'is_featured'=>true],
            ['name_id'=>'Daging Kambing/Domba','name_en'=>'Goat/Sheep Meat','category_id'=>'Daging Segar','category_en'=>'Fresh Meat','description_id'=>'Daging kambing dan domba segar berkualitas tinggi dari peternakan Ternak Salam, halal dan bebas hormon buatan.','icon'=>'fas fa-bone','availability'=>'available','order'=>5,'is_featured'=>false],
            ['name_id'=>'Kambing/Domba Hidup','name_en'=>'Live Goat/Sheep','category_id'=>'Ternak Hidup','category_en'=>'Live Livestock','description_id'=>'Kambing dan domba hidup sehat dan bersertifikat, cocok untuk kebutuhan aqiqah, qurban, maupun pengembangan peternakan.','icon'=>'fas fa-horse','availability'=>'seasonal','order'=>6,'is_featured'=>false],
            ['name_id'=>'Kohe (Kotoran Hewan)','name_en'=>'Organic Fertilizer','category_id'=>'Pupuk Organik','category_en'=>'Organic Fertilizer','description_id'=>'Pupuk organik dari kotoran kambing/domba, telah difermentasi dan siap pakai untuk lahan pertanian dan perkebunan.','icon'=>'fas fa-seedling','availability'=>'available','order'=>7,'is_featured'=>false],
        ];
        foreach ($products as $p) Product::create($p);

        // ── TEAM MEMBERS ─────────────────────────────────────────
        $team = [
            ['name'=>'Ahmad Fauzi','role_id'=>'Pendiri & Direktur','role_en'=>'Founder & Director','order'=>1,'is_active'=>true],
            ['name'=>'Siti Aminah','role_id'=>'Manajer Operasi','role_en'=>'Operations Manager','order'=>2,'is_active'=>true],
            ['name'=>'Rizky Pratama','role_id'=>'Pemimpin Agribisnis','role_en'=>'Agribusiness Lead','order'=>3,'is_active'=>true],
            ['name'=>'Nurul Hidayah','role_id'=>'Keuangan & Admin','role_en'=>'Finance & Admin','order'=>4,'is_active'=>true],
            ['name'=>'Hendra Kusuma','role_id'=>'Teknologi & Digital','role_en'=>'Tech & Digital','order'=>5,'is_active'=>true],
            ['name'=>'Dwi Rahayu','role_id'=>'Koordinator Komunitas','role_en'=>'Community Coordinator','order'=>6,'is_active'=>true],
            ['name'=>'Budi Santoso','role_id'=>'Manajer Peternakan','role_en'=>'Livestock Manager','order'=>7,'is_active'=>true],
            ['name'=>'Yuni Astuti','role_id'=>'Pemasaran & Penjualan','role_en'=>'Marketing & Sales','order'=>8,'is_active'=>true],
        ];
        foreach ($team as $t) TeamMember::create($t);

        // ── STATISTICS ───────────────────────────────────────────
        $stats = [
            ['key'=>'total_projects','label_id'=>'Proyek Aktif','label_en'=>'Active Projects','value'=>'5','unit'=>'+','group'=>'general','icon'=>'fas fa-folder','color'=>'#0f75bd','order'=>1],
            ['key'=>'total_members','label_id'=>'Anggota Komunitas','label_en'=>'Community Members','value'=>'120','unit'=>'+','group'=>'general','icon'=>'fas fa-users','color'=>'#8cc63e','order'=>2],
            ['key'=>'total_funding','label_id'=>'Total Pembiayaan','label_en'=>'Total Financing','value'=>'Rp 500jt','unit'=>'','group'=>'general','icon'=>'fas fa-chart-line','color'=>'#0f75bd','order'=>3],
            ['key'=>'year_founded','label_id'=>'Berdiri Sejak','label_en'=>'Founded','value'=>'2019','unit'=>'','group'=>'general','icon'=>'fas fa-calendar','color'=>'#8cc63e','order'=>4],
            // Financing allocation
            ['key'=>'finance_sagum','label_id'=>'SAGUM','label_en'=>'SAGUM','value'=>'35','unit'=>'%','group'=>'financing','color'=>'#0f75bd','order'=>1],
            ['key'=>'finance_ternak','label_id'=>'Ternak Salam','label_en'=>'Ternak Salam','value'=>'25','unit'=>'%','group'=>'financing','color'=>'#8cc63e','order'=>2],
            ['key'=>'finance_sate','label_id'=>'Warung Sate','label_en'=>'Warung Sate','value'=>'15','unit'=>'%','group'=>'financing','color'=>'#e67e22','order'=>3],
            ['key'=>'finance_melon','label_id'=>'Budidaya Melon','label_en'=>'Melon Farm','value'=>'18','unit'=>'%','group'=>'financing','color'=>'#27ae60','order'=>4],
            ['key'=>'finance_cis','label_id'=>'CIS Digitex','label_en'=>'CIS Digitex','value'=>'7','unit'=>'%','group'=>'financing','color'=>'#8e44ad','order'=>5],
            // Funding sources
            ['key'=>'fund_community','label_id'=>'Anggota Komunitas','label_en'=>'Community Members','value'=>'60','unit'=>'%','group'=>'funding_source','color'=>'#0f75bd','order'=>1],
            ['key'=>'fund_ngo','label_id'=>'LSM & Mitra','label_en'=>'NGO & Partners','value'=>'30','unit'=>'%','group'=>'funding_source','color'=>'#8cc63e','order'=>2],
            ['key'=>'fund_gov','label_id'=>'Pemerintah','label_en'=>'Government','value'=>'10','unit'=>'%','group'=>'funding_source','color'=>'#e67e22','order'=>3],
        ];
        foreach ($stats as $s) Statistic::create($s);

        // ── SAMPLE ARTICLES ──────────────────────────────────────
        $articles = [
            ['slug'=>'sagum-capai-tonggak-baru','title_id'=>'SAGUM Capai Tonggak Baru dalam Penjualan Produk Lokal','title_en'=>'SAGUM Reaches New Milestone in Local Produce Sales','excerpt_id'=>'Unit agribisnis SAGUM mencatatkan omset bulanan tertinggi pada Februari 2025, bukti dukungan komunitas yang terus tumbuh.','excerpt_en'=>'The SAGUM agribusiness unit recorded its highest monthly turnover in February 2025.','content_id'=>'<p>Unit agribisnis SAGUM mencatatkan omset bulanan tertinggi pada Februari 2025, bukti dukungan komunitas yang terus tumbuh dan meningkatnya kepercayaan konsumen lokal.</p><p>Pencapaian ini tidak lepas dari kerja keras seluruh anggota komunitas yang terlibat dalam rantai distribusi produk dari ladang hingga ke tangan konsumen.</p>','content_en'=>'<p>The SAGUM agribusiness unit recorded its highest monthly turnover in February 2025, a testament to growing community support and rising local consumer trust.</p>','category_id'=>'Agribisnis','category_en'=>'Agribusiness','status'=>'published','author_id'=>1,'published_at'=>'2025-02-20 08:00:00','views'=>120],
            ['slug'=>'ekspansi-greenhouse-melon','title_id'=>'Ekspansi Greenhouse Baru untuk Proyek Budidaya Melon','title_en'=>'New Greenhouse Expansion for Melon Cultivation Project','excerpt_id'=>'Proyek budidaya melon berkembang dengan dua unit greenhouse tambahan, meningkatkan kapasitas produksi secara signifikan.','excerpt_en'=>'The melon cultivation project has expanded with two additional greenhouse units.','content_id'=>'<p>Proyek budidaya melon Mendelem terus berkembang. Dua unit greenhouse baru berhasil dibangun berkat kerjasama seluruh anggota komunitas dan dukungan dari mitra strategis.</p><p>Dengan tambahan greenhouse ini, kapasitas produksi melon meningkat hingga 40% dan membuka peluang kerja baru bagi warga sekitar.</p>','content_en'=>'<p>The Mendelem melon cultivation project continues to grow. Two new greenhouse units were successfully built thanks to community cooperation and strategic partner support.</p>','category_id'=>'Hortikultura','category_en'=>'Horticulture','status'=>'published','author_id'=>1,'published_at'=>'2025-02-15 09:00:00','views'=>95],
            ['slug'=>'pelatihan-literasi-keuangan-digital','title_id'=>'Pelatihan Komunitas tentang Literasi Keuangan Digital','title_en'=>'Community Training on Digital Financial Literacy','excerpt_id'=>'CIS Digitex mengadakan pelatihan literasi keuangan digital untuk 45 anggota komunitas.','excerpt_en'=>'CIS Digitex held a digital financial literacy training session for 45 community members.','content_id'=>'<p>CIS Digitex mengadakan pelatihan literasi keuangan digital untuk 45 anggota komunitas, membekali mereka dengan alat dan pengetahuan untuk pengelolaan keuangan modern.</p>','content_en'=>'<p>CIS Digitex held a digital financial literacy training session for 45 community members, equipping them with modern financial management tools.</p>','category_id'=>'Komunitas','category_en'=>'Community','status'=>'published','author_id'=>1,'published_at'=>'2025-02-05 10:00:00','views'=>88],
            ['slug'=>'ternak-salam-raih-penghargaan','title_id'=>'Ternak Salam Raih Penghargaan Peternakan Terbaik Kabupaten','title_en'=>'Ternak Salam Wins Best Livestock Award in Regency','excerpt_id'=>'Program peternakan Ternak Salam mendapatkan penghargaan peternakan terbaik tingkat kabupaten Pemalang.','excerpt_en'=>'Ternak Salam received the best livestock award at Pemalang regency level.','content_id'=>'<p>Program peternakan Ternak Salam mendapatkan penghargaan peternakan terbaik tingkat kabupaten Pemalang atas inovasi manajemen dan kualitas ternak yang unggul.</p>','content_en'=>'<p>The Ternak Salam livestock program received the best livestock award at Pemalang regency level for innovative management and superior livestock quality.</p>','category_id'=>'Peternakan','category_en'=>'Livestock','status'=>'published','author_id'=>1,'published_at'=>'2025-01-28 08:00:00','views'=>76],
            ['slug'=>'kemitraan-unsoed','title_id'=>'Mendelem Project Bermitra dengan Universitas Jenderal Soedirman','title_en'=>'Mendelem Project Partners with Jenderal Soedirman University','excerpt_id'=>'Mendelem Project resmi bermitra dengan Universitas Jenderal Soedirman untuk penelitian pertanian berkelanjutan.','excerpt_en'=>'Mendelem Project officially partnered with Jenderal Soedirman University for sustainable agricultural research.','content_id'=>'<p>Mendelem Project resmi bermitra dengan Universitas Jenderal Soedirman (UNSOED) untuk penelitian dan pengembangan teknologi pertanian berkelanjutan di wilayah Pemalang.</p>','content_en'=>'<p>Mendelem Project officially partnered with Jenderal Soedirman University (UNSOED) for sustainable agricultural technology research and development in the Pemalang region.</p>','category_id'=>'Kemitraan','category_en'=>'Partnership','status'=>'published','author_id'=>1,'published_at'=>'2025-01-15 09:00:00','views'=>64],
        ];
        foreach ($articles as $a) Article::create($a);
    }
}

