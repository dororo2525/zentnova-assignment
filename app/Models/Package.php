<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $table = 'packages';
    protected $fillable = [
        'name',
        'price',
        'description',
        'duration',
        'url',
        'status',
        'created_at',
        'updated_at',
    ];

    public function users(){
        return $this->hasMany(User::class , 'package_id' , 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
