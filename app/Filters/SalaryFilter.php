<?php

namespace App\Filters;
use Carbon\Carbon;

class SalaryFilter extends Filters
{
	/**
	 * Register filter properties
	 */
	protected $filters = [
		'payment_date', 'employee_id', 'status', 'month', 'year'
	];

	/**
	 * Filter by Form type.
	 */
	public function employee_id($value)
	{
		return $this->builder->whereEmployeeId($value);
	}

	public function status($value)
	{
		return $this->builder->whereStatus($value);
	}
	
	public function month($value)
	{
		return $this->builder->where('month',$value);
	}

	public function year($value)
	{
		return $this->builder->where('year',$value);
	}

	public function payment_date($value)
	{
		return $this->builder->wherePaymentDate('payment_date','=',Carbon::parse($value));
	}
}