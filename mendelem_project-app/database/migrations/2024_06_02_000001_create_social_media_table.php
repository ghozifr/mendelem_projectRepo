<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('social_media', function (Blueprint $table) {
            $table->id();
            $table->string('name');                          // "Instagram", "YouTube SAGUM"
            $table->string('platform')->default('website'); // instagram,youtube,facebook,tiktok,website,twitter
            $table->string('url');                           // URL tujuan klik
            $table->string('icon')->default('fas fa-globe');
            $table->string('color')->default('#0f75bd');
            $table->string('thumbnail')->nullable();         // Foto cover/banner
            $table->json('previews')->nullable();            // [{image, link, caption}]
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('social_media'); }
};
