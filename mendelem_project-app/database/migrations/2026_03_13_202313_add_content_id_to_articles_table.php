<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('articles', function (Blueprint $table) {
        $table->longText('content_id')->nullable()->after('excerpt_en');
        $table->longText('content_en')->nullable()->after('content_id');
    });
}

public function down()
{
    Schema::table('articles', function (Blueprint $table) {
        $table->dropColumn(['content_id', 'content_en']);
    });
}

};
