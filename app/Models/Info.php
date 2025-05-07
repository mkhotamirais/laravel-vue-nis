<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    /** @use HasFactory<\Database\Factories\InfoFactory> */
    use HasFactory;

    protected $fillable = ['title', 'slug', 'infocat_id', 'user_id', 'tags', 'content', 'banner'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function infocat()
    {
        return $this->belongsTo(Infocat::class);
    }

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where(function ($q) {
                $search = str_replace('-', ' ', request('search'));
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('tags', 'like', '%' . $search . '%');
            });
        }

        if ($filters['category'] ?? false) {
            $slugCategory = str_replace('-', ' ', $filters['category']);
            $query->whereHas('infocat', function ($q) use ($slugCategory) {
                $q->whereRaw('LOWER(name) = ?', [strtolower($slugCategory)]);
            });
        }

        if ($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }
    }
}
