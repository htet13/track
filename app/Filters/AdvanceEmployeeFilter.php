<?php

namespace App\Filters;
use Carbon\Carbon;

class AdvanceEmployeeFilter extends Filters
{
	/**
	 * Register filter properties
	 */
	protected $filters = [
		'date', 'employee_id', 'amount'
	];

	/**
	 * Filter by Form type.
	 */
	public function employee_id($value)
	{
		return $this->builder->whereEmployeeId($value);
	}

	public function date($value)
	{
		return $this->builder->whereDate('date','=',Carbon::parse($value));
	}
}