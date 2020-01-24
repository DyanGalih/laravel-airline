<?php
/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-14
 * Time: 15:32
 */

namespace WebAppId\Airline\Services;


use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Airline\Repositories\AirlineRepository;
use WebAppId\Airline\Responses\AirlineListResponse;
use WebAppId\Airline\Responses\AirlineResponse;
use WebAppId\Airline\Services\Contracts\AirlineServiceContract;
use WebAppId\Airline\Services\Params\AirlineParam;
use WebAppId\DDD\Services\BaseService;


/**
 * Class AirlineService
 * @package WebAppId\Airline\Tests\Feature\Services
 */
class AirlineService extends BaseService implements AirlineServiceContract
{
    /**
     * @param string $q
     * @param AirlineRepository $airlineRepository
     * @param AirlineListResponse $airlineListResponse
     * @return AirlineListResponse
     */
    public function getByNameLike(string $q, int $limit, AirlineRepository $airlineRepository, AirlineListResponse $airlineListResponse): AirlineListResponse
    {
        $result = $this->getContainer()->call([$airlineRepository, 'getByNameLike'], ['q' => $q, 'limit' => $limit]);
        if (count($result) > 0) {
            $airlineListResponse->setStatus(true);
            $airlineListResponse->setMessage('Data Found');
            $airlineListResponse->airlines = $result;
        } else {
            $airlineListResponse->setStatus(false);
            $airlineListResponse->setMessage('Data Not Found');
        }
        return $airlineListResponse;
    }

    /**
     * @param AirlineParam $airlineParam
     * @param AirlineRepository $airlineRepository
     * @param AirlineResponse $airlineResponse
     * @return AirlineResponse
     */
    public function store(AirlineParam $airlineParam, AirlineRepository $airlineRepository, AirlineResponse $airlineResponse): AirlineResponse
    {
        $result = $this->getContainer()->call([$airlineRepository, 'store'], ['airlineParam' => $airlineParam]);
        if ($result != null) {
            $airlineResponse->setStatus(true);
            $airlineResponse->setMessage('Save Data Success');
            $airlineResponse->airline = $result;
        } else {
            $airlineResponse->setStatus(false);
            $airlineResponse->setMessage('Save Data Failed');
        }

        return $airlineResponse;
    }

    /**
     * @param string $code
     * @param AirlineRepository $airlineRepository
     * @param AirlineResponse $airlineResponse
     * @return AirlineResponse
     */
    public function getByIataCode(string $code, AirlineRepository $airlineRepository, AirlineResponse $airlineResponse): AirlineResponse
    {
        $result = $this->getContainer()->call([$airlineRepository, 'getByIataCode'], ['code' => $code]);
        if ($result != null) {
            $airlineResponse->setStatus(true);
            $airlineResponse->setMessage('Data Found');
            $airlineResponse->airline = $result;
        } else {
            $airlineResponse->setStatus(false);
            $airlineResponse->setMessage('Data Not Found');
        }
        return $airlineResponse;
    }

    /**
     * @param string $code
     * @param AirlineRepository $airlineRepository
     * @param AirlineResponse $airlineResponse
     * @return AirlineResponse
     */
    public function getByIcaoCode(string $code, AirlineRepository $airlineRepository, AirlineResponse $airlineResponse): AirlineResponse
    {
        $result = $this->getContainer()->call([$airlineRepository, 'getByIcaoCode'], ['code' => $code]);
        if ($result != null) {
            $airlineResponse->setStatus(true);
            $airlineResponse->setMessage('Data Found');
            $airlineResponse->airline = $result;
        } else {
            $airlineResponse->setStatus(false);
            $airlineResponse->setMessage('Data Not Found');
        }
        return $airlineResponse;
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id, AirlineRepository $airlineRepository, AirlineResponse $airlineResponse): AirlineResponse
    {
        $result = $this->getContainer()->call([$airlineRepository, 'getById'], ['id' => $id]);
        if ($result != null) {
            $airlineResponse->setStatus(true);
            $airlineResponse->setMessage('Data Found');
            $airlineResponse->airline = $result;
        } else {
            $airlineResponse->setStatus(false);
            $airlineResponse->setMessage('Data Not Found');
        }
        return $airlineResponse;
    }
}
