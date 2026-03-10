<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name','username','email','password','role','is_active'];
    protected $hidden   = ['password','remember_token'];
    protected $casts    = ['is_active'=>'boolean','email_verified_at'=>'datetime'];

    public function articles() { return $this->hasMany(Article::class,'author_id'); }
    public function isSuperAdmin(): bool { return $this->role === 'superadmin'; }
    public function isAdmin(): bool { return in_array($this->role,['superadmin','admin']); }
}
