<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';

    protected $fillable = [
        'title',
        'type',
        'genre',
        'description',
        'release_year',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
