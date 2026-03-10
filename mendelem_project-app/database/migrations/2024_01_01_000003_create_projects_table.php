<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name_id');
            $table->string('name_en')->nullable();
            $table->text('short_desc_id')->nullable();
            $table->text('short_desc_en')->nullable();
            $table->longText('description_id')->nullable();
            $table->longText('description_en')->nullable();
            $table->string('tag_id')->nullable();
            $table->string('tag_en')->nullable();
            $table->string('icon')->default('fas fa-folder'); // font awesome class
            $table->string('color')->default('#0f75bd');
            $table->string('thumbnail')->nullable();
            $table->json('gallery')->nullable(); // array of image paths
            $table->integer('members_count')->default(0);
            $table->year('year_started')->nullable();
            $table->enum('status', ['active', 'inactive', 'planned'])->default('active');
            $table->integer('order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
