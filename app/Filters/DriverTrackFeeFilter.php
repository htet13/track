<?php

namespace App\Filters;
use Carbon\Carbon;

class DriverTrackFeeFilter extends Filters
{
	/**
	 * Register filter properties
	 */
	protected $filters = [
		'date', 'car_no_id', 'from_city', 'to_city', 'issuer_id', 'driver_id', 'spare_id', 'other_cost'
	];

	/**
	 * Filter by Form type.
	 */
	public function date($value)
	{
		return $this->builder->whereHas('track', function($query) use ($value) {
            $query->where('date',$value);
        });
	}

	public function car_no_id($value)
	{
		return $this->builder->whereHas('track', function($query) use ($value) {
            $query->whereCarNoId($value);
        });
	}

	public function from_city($value)
	{
		return $this->builder->whereHas('track', function($query) use ($value) {
            $query->whereHas('fromcities', function($query) use ($value) {
                $query->whereCityId($value);
            });
        });
	}

	public function to_city($value)
	{
		return $this->builder->whereHas('track', function($query) use ($value) {
            $query->whereHas('tocities', function($query) use ($value) {
                $query->whereCityId($value);
            });
        });
	}

	public function issuer_id($value)
	{
        return $this->builder->whereHas('track', function($query) use ($value) {
            $query->whereIssuerId($value);
        });
	}

	public function driver_id($value)
	{
        return $this->builder->whereHas('track', function($query) use ($value) {
            $query->whereHas('driverTracks', function($query) use ($value) {
			    $query->whereDriverId($value);
            });
		});
	}

	public function spare_id($value)
	{
        return $this->builder->whereHas('track', function($query) use ($value) {
            $query->whereHas('spareTracks', function($query) use ($value) {
			    $query->whereSpareId($value);
            });
		});
	}

	public function other_cost($value)
	{
        return $this->builder->whereHas('track', function($query) use ($value) {
            $query->whereHas('otherCosts', function($query) use ($value) {
			    $query->where('category', 'LIKE', '%' . $value . '%');
            });
		});
	}
}