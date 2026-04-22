    <?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kurban_animals', function (Blueprint $table) {
            // Kode unik hewan (K001, D001, dll)
            $table->string('kode', 20)->nullable()->after('id');
            // Grade A-G
            $table->enum('grade', ['A','B','C','D','E','F','G'])->nullable()->after('kode');
        });
    }

    public function down(): void
    {
        Schema::table('kurban_animals', function (Blueprint $table) {
            $table->dropColumn(['kode', 'grade']);
        });
    }
};
