<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $fillable = ['title', 'description', 'start_time', 'end_time', 'location'];

    protected $dates = ['start_time', 'end_time'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusAttribute()
    {
        $now = Carbon::now();

        if ($this->start_time > $now) {
            return 'belum dimulai';
        }

        if ($this->end_time && $now > $this->end_time) {
            return 'selesai';
        }

        return 'berlangsung';
    }
}
