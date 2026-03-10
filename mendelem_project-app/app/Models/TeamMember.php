<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class TeamMember extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = ['name','role_id','role_en','bio_id','bio_en','photo','email','phone','social_links','order','is_active'];
    protected $casts = ['social_links'=>'array','is_active'=>'boolean'];

    public function getPhotoUrlAttribute(): string
    {
        return $this->photo ? asset('storage/'.$this->photo) : null;
    }
}
