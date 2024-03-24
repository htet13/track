<?php

namespace App\Filters;
use Carbon\Carbon;

class DriverTrackFilter extends Filters
{
	/**
	 * Register filter properties
	 */
	protected $filters = [
		'driver_id','from_date','to_date'
	];

	/**
	 * Filter by driver id.
	 */
	public function driver_id($value)
	{
		return $this->builder->where('employee_id',$value);
	}

	public function from_date($value)
	{
		return $this->builder->where('payment_date','>=',$value);
	}

	public function to_date($value)
	{
		return $this->builder->whereDate('payment_date','<=',$value);
	}
}