<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public function scopeCountClicks($query){
        return $query->withCount('clicks');
    }

    public function scopeClickCurrentDay($query){
        return $query->withCount(['clicks' => function($q){
            $q->whereDate('created_at', Carbon::today());
        }]);
    }

    public function scopeClickCurrentMonth($query){
        return $query->withCount(['clicks' => function($q){
            $q->whereMonth('created_at', Carbon::now()->month);
        }]);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function urlclicks(){
        return $this->hasMany(UrlClick::class , 'url_id' , 'id');
    }
}
