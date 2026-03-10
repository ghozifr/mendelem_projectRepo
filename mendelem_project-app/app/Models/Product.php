<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Product extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = [
        'name_id','name_en','category_id','category_en',
        'description_id','description_en','icon','thumbnail',
        'gallery','price_min','price_max','unit',
        'availability','is_featured','is_active','order'
    ];
    protected $casts = ['gallery'=>'array','is_featured'=>'boolean','is_active'=>'boolean'];

    public function scopeActive($query) { return $query->where('is_active',true)->orderBy('order'); }

    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->thumbnail ? asset('storage/'.$this->thumbnail) : null;
    }
}
