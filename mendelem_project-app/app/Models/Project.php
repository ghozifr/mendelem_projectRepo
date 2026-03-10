<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Project extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = [
        'slug','name_id','name_en','short_desc_id','short_desc_en',
        'description_id','description_en','tag_id','tag_en',
        'icon','color','thumbnail','gallery','members_count',
        'year_started','status','order','is_featured'
    ];
    protected $casts = ['gallery'=>'array','is_featured'=>'boolean'];

    public function scopeActive($query) { return $query->where('status','active')->orderBy('order'); }
    public function scopeFeatured($query) { return $query->where('is_featured',true); }

    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->thumbnail ? asset('storage/'.$this->thumbnail) : null;
    }
}
