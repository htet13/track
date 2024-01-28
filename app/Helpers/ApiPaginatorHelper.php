<?php
namespace App\Helpers;

use Illuminate\Pagination\LengthAwarePaginator;

class ApiPaginatorHelper
{
    public static function format(LengthAwarePaginator $paginator, $data)
    {
        return [
            'data' => $data,
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
                'last_page' => $paginator->lastPage(),
            ],
            'links' => [
                'self' => $paginator->url($paginator->currentPage()),
                'first' => $paginator->url(1),
                'prev' => $paginator->previousPageUrl(),
                'next' => $paginator->nextPageUrl(),
                'last' => $paginator->url($paginator->lastPage()),
            ],
        ];
    }
}
