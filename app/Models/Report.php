<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class Report extends Model
{
    use HasFactory, HasUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'times','expense','total_oil','total_price','check_cost','gate_cost','food_cost','other_cost','total'
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
        return $this->belongsToMany(City::class,'fromcities_reports');
    }

    public function tocities()
    {
        return $this->belongsToMany(City::class,'tocities_reports');
    }

    public function oilCosts()
    {
        return $this->hasMany(OilCost::class);
    }

    public function otherCosts()
    {
        return $this->hasMany(OtherCost::class);
    }

    public function scopeWithNonZeroValues($query)
    {
        return $query->where(function ($query) {
            $query->where('expense', '>', 0)
                  ->orWhere('total_oil', '>', 0)
                  ->orWhere('total_price', '>', 0)
                  ->orWhere('check_cost', '>', 0)
                  ->orWhere('gate_cost', '>', 0)
                  ->orWhere('food_cost', '>', 0)
                  ->orWhere('other_cost', '>', 0)
                  ->orWhere('total', '>', 0);
        });
    }
}
