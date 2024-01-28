<?php

namespace App\Filters;
use Carbon\Carbon;

class UserFilter extends Filters
{
	/**
	 * Register filter properties
	 */
	protected $filters = [
		'name', 
	];

	/**
	 * Filter by Form type.
	 */
	public function name($value)
	{
		return $this->builder->where('name', 'LIKE', '%' . $value . '%')
        ->orWhere('email', 'LIKE', '%' . $value . '%')
        ->orWhereRelation('roles', 'name', 'LIKE', '%' . $value . '%');
	}
}