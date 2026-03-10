<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Slider extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = [
        'title_id','title_en','subtitle_id','subtitle_en',
        'tag_id','tag_en','btn_primary_label_id','btn_primary_label_en',
        'btn_primary_url','btn_secondary_label_id','btn_secondary_label_en',
        'btn_secondary_url','media_type','media_path','order','is_active'
    ];
    protected $casts = ['is_active'=>'boolean'];

    public function scopeActive($query) { return $query->where('is_active', true)->orderBy('order'); }

    public function getMediaUrlAttribute(): ?string
    {
        return $this->media_path ? asset('storage/' . $this->media_path) : null;
    }
}
