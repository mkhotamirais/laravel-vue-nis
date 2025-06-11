<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Infoimage extends Model
{
    protected $fillable = ['image'];

    public function info()
    {
        return $this->belongsTo(Info::class);
    }
}
