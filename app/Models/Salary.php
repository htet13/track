<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class Salary extends Model
{
    use HasFactory, HasUuid;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'payment_date', 'employee_id', 'is_paid', 'remark', 'month', 'year'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'string',
    ];

    protected $dates = ['payment_date'];

    public function scopeFilter($query,$filter)
    {
        $filter->apply($query);
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
