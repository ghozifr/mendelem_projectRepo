<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id')->nullable(); // NULLABLE - required for SET NULL
            $table->string('title_id');
            $table->string('title_en')->nullable();
            $table->string('slug')->unique();
            $table->string('category_id')->nullable();
            $table->string('category_en')->nullable();
            $table->text('excerpt_id')->nullable();
            $table->text('excerpt_en')->nullable();
            $table->longText('body_id')->nullable();
            $table->longText('body_en')->nullable();
            $table->string('thumbnail')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->integer('views')->default(0);
            $table->timestamps();

            $table->foreign('author_id')
                  ->references('id')->on('users')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
