<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KurbanAnimal extends Model
{
    protected $table = 'kurban_animals';

    protected $fillable = [
        'kode', 'grade',
        'name', 'jenis_hewan', 'kelamin', 'jenis_ras',
        'berat_kg', 'umur', 'harga', 'status',
        'is_active', 'order', 'thumbnail', 'media',
        'whatsapp_number', 'catatan',
    ];

     // Data grade lengkap — digunakan di view
    public static function gradeData(): array
    {
        return [
            'A' => ['label'=>'Grade A','berat'=>'45–50 kg','harga'=>5250000,'color'=>'#00ca5b'],
            'B' => ['label'=>'Grade B','berat'=>'41–45 kg','harga'=>4750000,'color'=>'#ff8114'],
            'C' => ['label'=>'Grade C','berat'=>'36–40 kg','harga'=>4250000,'color'=>'#97a800'],
            'D' => ['label'=>'Grade D','berat'=>'31–35 kg','harga'=>3750000,'color'=>'#7459ac'],
            'E' => ['label'=>'Grade E','berat'=>'26–30 kg','harga'=>3250000,'color'=>'#2980b9'],
            'F' => ['label'=>'Grade F','berat'=>'24–25 kg','harga'=>2750000,'color'=>'#ad445e'],
            'G' => ['label'=>'Grade G','berat'=>'20–23 kg','harga'=>2550000,'color'=>'#12aeb9'],
            'H' => ['label'=>'Grade H','berat'=>'18–20 kg','harga'=>2250000,'color'=>'#95a5a6'], // ← TAMBAH
        ];
    }

    // Warna badge grade
    public function getGradeColorAttribute(): string
    {
        return self::gradeData()[$this->grade]['color'] ?? '#718096';
    }

    // Label grade lengkap (untuk display)
    public function getGradeLabelAttribute(): string
    {
        if (!$this->grade) return '—';
        $data = self::gradeData()[$this->grade] ?? null;
        return $data ? "Grade {$this->grade} ({$data['berat']})" : "Grade {$this->grade}";
    }

    protected $casts = [
        'media'     => 'array',
        'is_active' => 'boolean',
        'harga'     => 'decimal:2',
        'berat_kg'  => 'decimal:2',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order')->orderBy('id');
    }

    public function scopeTersedia($query)
    {
        return $query->where('status', 'tersedia');
    }

    // Accessor: harga formatted
    public function getHargaFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    // Accessor: thumbnail URL
    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->thumbnail ? asset('storage/' . $this->thumbnail) : null;
    }

    // Accessor: label jenis_hewan
    public function getJenisLabelAttribute(): string
    {
        return ucfirst($this->jenis_hewan);
    }

    // Accessor: label kelamin
    public function getKelaminLabelAttribute(): string
    {
        return ucfirst($this->kelamin);
    }

    // Accessor: label status dengan warna
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'tersedia' => '#2d9b4e',
            'dipesan'  => '#e28c00',
            'terjual'  => '#e53e3e',
            default    => '#718096',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'tersedia' => '✅ Tersedia',
            'dipesan'  => '⏳ Dipesan',
            'terjual'  => '❌ Terjual',
            default    => $this->status,
        };
    }
}
