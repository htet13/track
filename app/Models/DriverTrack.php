<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class DriverTrack extends Model
{
    use HasFactory, HasUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'employee_id','track_id','fee','is_paid','remark','payment_date'
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

    public function driver(){
        return $this->belongsTo(Employee::class,'employee_id','id');
    }

    public function track()
    {
        return $this->belongsTo(Track::class);
    }
}
