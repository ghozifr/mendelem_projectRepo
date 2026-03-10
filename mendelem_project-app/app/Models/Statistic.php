<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Statistic extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = ['key','label_id','label_en','value','unit','group','icon','color','order'];

    public static function getByGroup(string $group)
    {
        return static::where('group', $group)->orderBy('order')->get();
    }
}
