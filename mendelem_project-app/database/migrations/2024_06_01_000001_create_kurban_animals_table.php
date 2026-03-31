<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kurban_animals', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();                                    // Nama/kode: "Kambing A01"
            $table->enum('jenis_hewan', ['kambing', 'domba'])->default('kambing');// Kategori
            $table->enum('kelamin', ['jantan', 'betina'])->default('jantan');
            $table->string('jenis_ras')->nullable();                               // Ras: Jawa, PE, Boer, Garut
            $table->decimal('berat_kg', 6, 2)->nullable();                         // Berat kg
            $table->string('umur')->nullable();                                    // "1.5 tahun"
            $table->decimal('harga', 12, 2);                                       // Harga (Rp)
            $table->enum('status', ['tersedia', 'terjual', 'dipesan'])->default('tersedia');
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->string('thumbnail')->nullable();                               // Foto utama
            $table->json('media')->nullable();                                     // [{path, type}]
            $table->string('whatsapp_number')->nullable();                         // No WA untuk kontak
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kurban_animals');
    }
};
