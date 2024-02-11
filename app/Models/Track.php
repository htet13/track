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
        'date','type','car_no_id','expense','issuer_id','driver_id','spare_id','drive_fee','check_cost','gate_cost','food_cost','total','remark'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'string',
    ];

    protected $dates = ['date'];

    public function scopeFilter($query,$filter)
    {
        $filter->apply($query);
    }

    public function fromcities()
    {
        return $this->belongsToMany(City::class,'fromcities_tracks')->withTrashed();
    }

    public function tocities()
    {
        return $this->belongsToMany(City::class,'tocities_tracks')->withTrashed();
    }

    public function oilCosts()
    {
        return $this->hasMany(OilCost::class);
    }

    public function otherCosts()
    {
        return $this->hasMany(OtherCost::class);
    }

    public function carNo()
    {
        return $this->belongsTo(CarNo::class)->withTrashed();
    }

    public function issuer()
    {
        return $this->belongsTo(Issuer::class)->withTrashed();
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class)->withTrashed();
    }

    public function spare()
    {
        return $this->belongsTo(Spare::class)->withTrashed();
    }
}
