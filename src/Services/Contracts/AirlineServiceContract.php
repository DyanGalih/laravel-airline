<?php


namespace WebAppId\Airline\Services\Contracts;


use WebAppId\Airline\Repositories\AirlineRepository;
use WebAppId\Airline\Responses\AirlineListResponse;
use WebAppId\Airline\Responses\AirlineResponse;
use WebAppId\Airline\Services\Params\AirlineParam;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com>
 * Date: 02/01/20
 * Time: 22.28
 * Interface AirlineServiceContract
 * @package WebAppId\Airline\Services\Contracts
 */
interface AirlineServiceContract
{
    /**
     * @param AirlineParam $airlineParam
     * @param AirlineRepository $airlineRepository
     * @param AirlineResponse $airlineResponse
     * @return AirlineResponse
     */
    public function store(AirlineParam $airlineParam, AirlineRepository $airlineRepository, AirlineResponse $airlineResponse): AirlineResponse;

    /**
     * @param string $q
     * @param int $limit
     * @param bool|null $isActive
     * @param int|null $countryId
     * @param AirlineRepository $airlineRepository
     * @param AirlineListResponse $airlineListResponse
     * @return AirlineListResponse
     */
    public function getByNameLike(string $q, int $limit, ?bool $isActive, ?int $countryId,AirlineRepository $airlineRepository, AirlineListResponse $airlineListResponse): AirlineListResponse;

    /**
     * @param string $code
     * @param AirlineRepository $airlineRepository
     * @param AirlineResponse $airlineResponse
     * @return AirlineResponse
     */
    public function getByIataCode(string $code, AirlineRepository $airlineRepository, AirlineResponse $airlineResponse): AirlineResponse;

    /**
     * @param string $code
     * @param AirlineRepository $airlineRepository
     * @param AirlineResponse $airlineResponse
     * @return AirlineResponse
     */
    public function getByIcaoCode(string $code, AirlineRepository $airlineRepository, AirlineResponse $airlineResponse): AirlineResponse;

    /**
     * @param int $id
     * @param AirlineRepository $airlineRepository
     * @param AirlineResponse $airlineResponse
     * @return AirlineResponse
     */
    public function getById(int $id, AirlineRepository $airlineRepository, AirlineResponse $airlineResponse): AirlineResponse;
}