<?php

namespace App\Filters;
use Carbon\Carbon;

class SpareFilter extends Filters
{
	/**
	 * Register filter properties
	 */
	protected $filters = [
		'name', 'from_date', 'to_date'
	];

	/**
	 * Filter by Form type.
	 */
	public function name($value)
	{
		return $this->builder->where('name','LIKE',"%$value%");
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