<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class Bonus extends Model
{
    use HasFactory, HasUuid;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date', 'employee_id', 'bonus_type', 'amount'
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

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
