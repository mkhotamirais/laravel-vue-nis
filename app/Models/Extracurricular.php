<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Extracurricular extends Model
{
    protected $fillable = ['name', 'mentor', 'banner', 'description', 'schedule'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query, array $filters)
    {

        if ($filters['category'] ?? false) {
            $slugCategory = str_replace('-', ' ', $filters['category']);
            if ($slugCategory == 'MA') {
                $slugCategory = 'editor_ma';
            } else if ($slugCategory == 'MTs') {
                $slugCategory = 'editor_mts';
            } else if ($slugCategory == 'Ponpes') {
                $slugCategory = 'editor_ponpes';
            }
            $query->whereHas('user', function ($q) use ($slugCategory) {
                $q->whereRaw('LOWER(role) = ?', [strtolower($slugCategory)]);
            });
        }
    }
}
