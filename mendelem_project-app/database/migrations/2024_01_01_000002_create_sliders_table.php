<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title_id');
            $table->string('title_en')->nullable();
            $table->text('subtitle_id')->nullable();
            $table->text('subtitle_en')->nullable();
            $table->string('tag_id')->nullable();
            $table->string('tag_en')->nullable();
            $table->string('btn_primary_label_id')->nullable();
            $table->string('btn_primary_label_en')->nullable();
            $table->string('btn_primary_url')->nullable();
            $table->string('btn_secondary_label_id')->nullable();
            $table->string('btn_secondary_label_en')->nullable();
            $table->string('btn_secondary_url')->nullable();
            $table->string('media_type')->default('image'); // image or video
            $table->string('media_path')->nullable(); // path to uploaded file
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
