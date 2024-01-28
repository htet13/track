<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class Track extends Model
{
    use HasFactory, HasUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'from','to','amount','action_mode','type','status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'string',
    ];

    public function scopeFilter($query,$filter)
    {
        $filter->apply($query);
    }

    public function fromCity()
    {
        return $this->belongsTo(City::class, 'from');
    }

    // Define the relationship to the cities table for the 'to' city
    public function toCity()
    {
        return $this->belongsTo(City::class, 'to');
    }

    public function cities()
    {
        return $this->belongsToMany(City::class,'cities_tracks');
    }
}
