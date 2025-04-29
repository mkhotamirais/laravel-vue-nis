<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facilityimage extends Model
{
    protected $fillable = ['image'];

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }
}
