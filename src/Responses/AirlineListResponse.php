<?php


namespace WebAppId\Airline\Responses;


use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\DDD\Responses\AbstractResponse;

class AirlineListResponse extends AbstractResponse
{
    /**
     * @var LengthAwarePaginator
     */
    public $airlines;
}