<?php

namespace App\Filters;
use Carbon\Carbon;

class BonusFilter extends Filters
{
	/**
	 * Register filter properties
	 */
	protected $filters = [
		'date', 'employee_id', 'type', 'amount'
	];

	/**
	 * Filter by Form type.
	 */
	public function employee_id($value)
	{
		return $this->builder->whereEmployeeId($value);
	}

	public function type($value)
	{
		return $this->builder->whereType($value);
	}

	public function date($value)
	{
		return $this->builder->whereDate('date','=',Carbon::parse($value));
	}
}