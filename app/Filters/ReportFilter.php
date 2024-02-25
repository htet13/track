<?php

namespace App\Filters;
use Carbon\Carbon;

class ReportFilter extends Filters
{
	/**
	 * Register filter properties
	 */
	protected $filters = [
		'from_city', 'to_city'
	];

	public function from_city($value)
	{
		return $this->builder->whereHas('fromcities', function($query) use ($value) {
			$query->whereCityId($value);
		});
	}

	public function to_city($value)
	{
		return $this->builder->whereHas('tocities', function($query) use ($value) {
			$query->whereCityId($value);
		});
	}
}