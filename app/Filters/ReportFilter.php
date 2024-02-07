<?php

namespace App\Filters;
use Carbon\Carbon;

class ReportFilter extends Filters
{
	/**
	 * Register filter properties
	 */
	protected $filters = [
		'from_date', 'to_date'
	];

	public function from_date($value)
	{
		return $this->builder->whereDate('date','>=',Carbon::parse($value));
	}

	public function to_date($value)
	{
		return $this->builder->whereDate('date','<=',Carbon::parse($value));
	}
}