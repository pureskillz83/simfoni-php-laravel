<?php

namespace MBLSolutions\InspiredDeckLaravel\Pagination;

use Illuminate\Pagination\LengthAwarePaginator;
use MBLSolutions\Simfoni\Api\ApiResource;

class SimfoniPagination
{
    /** @var ApiResource $resource */
    public $resource;

    /** @var int $currentPage */
    public $currentPage;

    /**
     * Create a new Paginated API Result
     *
     * @param ApiResource $resource
     */
    public function __construct(ApiResource $resource)
    {
        $this->resource = $resource;

        $this->currentPage = LengthAwarePaginator::resolveCurrentPage();
    }

    /**
     * Paginate Results
     *
     * @param array $options
     * @return LengthAwarePaginator
     */
    public function paginate(array $options = []): LengthAwarePaginator
    {
        $result = $this->resource->all($this->currentPage);
        return new LengthAwarePaginator($result['data'], $result['meta']['total'], $result['meta']['per_page'], $this->currentPage, $options);
    }

}