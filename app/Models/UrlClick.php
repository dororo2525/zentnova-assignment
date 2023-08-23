<?php

namespace App\Models;

use GuzzleHttp\Psr7\Query;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrlClick extends Model
{
    use HasFactory;

    protected $table = 'url_clicks';
    protected $fillable = [
        'url_id',
        'device',
        'browser',
        'platform',
        'created_at',
        'updated_at',
    ];
}
