<?php

namespace App\Filters;
use Carbon\Carbon;

class EmployeeFilter extends Filters
{
	/**
	 * Register filter properties
	 */
	protected $filters = [
		'name', 'from_date', 'to_date','position'
	];

	/**
	 * Filter by Form type.
	 */
	public function name($value)
	{
		return $this->builder->where('name','LIKE',"%$value%");
	}

	public function position($value)
	{
		return $this->builder->where('position','LIKE',"%$value%");
	}

	public function from_date($value)
	{
		return $this->builder->whereDate('created_at','>=',Carbon::parse($value));
	}

	public function to_date($value)
	{
		return $this->builder->whereDate('created_at','<=',Carbon::parse($value));
	}
}