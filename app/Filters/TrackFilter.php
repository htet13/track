<?php

namespace App\Filters;
use Carbon\Carbon;

class TrackFilter extends Filters
{
	/**
	 * Register filter properties
	 */
	protected $filters = [
		'from', 'to', 'from_date', 'to_date'
	];

	/**
	 * Filter by Form type.
	 */
	public function from($value)
	{
		return $this->builder->whereFrom($value);
	}

    public function to($value)
	{
		return $this->builder->whereTo($value);
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