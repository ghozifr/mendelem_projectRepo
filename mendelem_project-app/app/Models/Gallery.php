<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Gallery extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = ['title_id','title_en','file_path','file_type','category','is_featured','order','is_active'];
    protected $casts = ['is_featured'=>'boolean','is_active'=>'boolean'];

    public function getFileUrlAttribute(): string
    {
        return asset('storage/'.$this->file_path);
    }
}
