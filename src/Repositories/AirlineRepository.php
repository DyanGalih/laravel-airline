<?php
/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-14
 * Time: 02:30
 */

namespace WebAppId\Airline\Repositories;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Airline\Models\Airline;
use WebAppId\Airline\Services\Params\AirlineParam;
use WebAppId\DDD\Tools\Lazy;

/**
 * Class AirlineRepository
 * @package WebAppId\Airline\Repositories
 */
class AirlineRepository
{
    /**
     * @param AirlineParam $airlineParam
     * @param Airline $airline
     * @return Airline|null
     */
    public function store(AirlineParam $airlineParam, Airline $airline): ?Airline
    {
        try {
            $airline = Lazy::copy($airlineParam, $airline);
            $airline->save();
            return $airline;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @param int $id
     * @param Airline $airline
     * @return Airline|null
     */
    public function getById(int $id, Airline $airline): ?Airline
    {
        return $airline->find($id);
    }

    /**
     * @param int $id
     * @param AirlineParam $airlineParam
     * @param Airline $airline
     * @return Airline|null
     */
    public function update(int $id, AirlineParam $airlineParam, Airline $airline): ?Airline
    {
        $airline = $this->getById($id, $airline);
        if ($airline != null) {
            try {
                $airline = Lazy::copy($airlineParam, $airline);
                $airline->save();
            } catch (QueryException $queryException) {
                report($queryException);
            }
        }

        return $airline;
    }

    /**
     * @param string $q
     * @param Airline $airline
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function getByNameLike(string $q, Airline $airline, $limit = 12): LengthAwarePaginator
    {
        return $airline
            ->where('name', 'LIKE', '%' . $q . '%')
            ->orWhere('iata_code', $q)
            ->paginate($limit);
    }

    /**
     * @param string $code
     * @param Airline $airline
     * @return Airline
     */
    public function getByIataCode(string $code, Airline $airline): ?Airline
    {
        return $airline->where('iata_code', $code)->first();
    }

    /**
     * @param string $code
     * @param Airline $airline
     * @return Airline
     */
    public function getByIcaoCode(string $code, Airline $airline): ?Airline
    {
        return $airline->where('icao_code', $code)->first();
    }

}
