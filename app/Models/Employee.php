<?php

namespace App\Models;

use App\Enums\PositionEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class Employee extends Model
{
    use HasFactory, HasUuid, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name','position','status','salary_type','joined_date','resign_date','remark','advance'
    ];

    protected $dates = ['joined_date','resign_date'];

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
}
