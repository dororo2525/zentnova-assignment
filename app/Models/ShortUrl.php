<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    use HasFactory;

    protected $table = 'short_urls';
    protected $fillable = [
        'user_id',
        'origin_url',
        'code',
        'clicks',
        'status',
        'created_at',
        'updated_at',
    ];

    public function clicks(){
        return $this->hasMany(UrlClick::class , 'url_id' , 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function urlclicks(){
        return $this->hasMany(UrlClick::class , 'url_id' , 'id');
    }
}
