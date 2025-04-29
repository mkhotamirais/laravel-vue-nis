<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $fillable = ['name', 'slug', 'caption', 'banner', 'facilitycat_id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function facilitycat()
    {
        return $this->belongsTo(Facilitycat::class);
    }

    public function facilityimages()
    {
        return $this->hasMany(Facilityimage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('caption', 'like', '%' . $search . '%');
            });
        });
    }
}
