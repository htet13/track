<?php

namespace App\Filters;

class DriverTrackFilter extends Filters
{
	/**
	 * Register filter properties
	 */
	protected $filters = [
		'driver_id',
	];

	/**
	 * Filter by driver id.
	 */
	public function driver_id($value)
	{
		return $this->builder->where('driver_id',$value);
	}
}