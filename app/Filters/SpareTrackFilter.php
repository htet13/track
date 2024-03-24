<?php

namespace App\Filters;

class SpareTrackFilter extends Filters
{
	/**
	 * Register filter properties
	 */
	protected $filters = [
		'spare_id',
	];

	/**
	 * Filter by driver id.
	 */
	public function spare_id($value)
	{
		return $this->builder->where('employee_id',$value);
	}
}