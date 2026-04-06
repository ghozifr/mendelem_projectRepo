<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    protected $table = 'social_media';

    protected $fillable = [
        'name','platform','url','icon','color',
        'thumbnail','previews','description','is_active','order',
    ];

    protected $casts = [
        'previews'  => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order')->orderBy('id');
    }

    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->thumbnail ? asset('storage/' . $this->thumbnail) : null;
    }

    // Warna background pastel dari warna utama
    public function getBgLightAttribute(): string
    {
        return $this->color . '15';
    }

    // Platform icon default
    public function getPlatformIconAttribute(): string
    {
        return match($this->platform) {
            'instagram' => 'fab fa-instagram',
            'youtube'   => 'fab fa-youtube',
            'facebook'  => 'fab fa-facebook-f',
            'tiktok'    => 'fab fa-tiktok',
            'twitter'   => 'fab fa-twitter',
            'whatsapp'  => 'fab fa-whatsapp',
            'telegram'  => 'fab fa-telegram',
            'linkedin'  => 'fab fa-linkedin-in',
            default     => $this->icon ?? 'fas fa-globe',
        };
    }

    // Warna default per platform
    public function getPlatformColorAttribute(): string
    {
        if ($this->color && $this->color !== '#0f75bd') return $this->color;
        return match($this->platform) {
            'instagram' => '#e1306c',
            'youtube'   => '#ff0000',
            'facebook'  => '#1877f2',
            'tiktok'    => '#010101',
            'twitter'   => '#1da1f2',
            'whatsapp'  => '#25d366',
            'telegram'  => '#0088cc',
            'linkedin'  => '#0077b5',
            default     => '#0f75bd',
        };
    }
}
