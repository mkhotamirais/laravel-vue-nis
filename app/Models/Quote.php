<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = ['content', 'author'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
