<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class ContactMessage extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = ['name','email','purpose','message','status','read_at'];
    protected $casts = ['read_at'=>'datetime'];
}
