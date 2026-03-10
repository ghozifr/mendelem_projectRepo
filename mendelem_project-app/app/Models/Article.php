<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Article extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = [
        'slug','title_id','title_en','excerpt_id','excerpt_en',
        'content_id','content_en','category_id','category_en',
        'thumbnail','tags','status','author_id','published_at','views'
    ];
    protected $casts = ['tags'=>'array','published_at'=>'datetime'];

    public function author() { return $this->belongsTo(User::class,'author_id'); }
    public function scopePublished($query) { return $query->where('status','published')->orderByDesc('published_at'); }

    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->thumbnail ? asset('storage/'.$this->thumbnail) : null;
    }
}
