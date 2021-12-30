<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $fillable = [
        'url',
        'cropName',
        'sickNameKor',
        'confidence'
    ];
    public $timestamps = True;
}
