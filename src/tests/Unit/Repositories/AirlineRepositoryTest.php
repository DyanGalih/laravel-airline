<?php
/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-14
 * Time: 02:28
 */

namespace WebAppId\Airline\Tests\Unit\Repositories;

use Illuminate\Contracts\Container\BindingResolutionException;
use WebAppId\Airline\Models\Airline;
use WebAppId\Airline\Repositories\AirlineRepository;
use WebAppId\Airline\Services\Params\AirlineParam;
use WebAppId\Airline\Tests\TestCase;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com>
 * Date: 02/01/20
 * Time: 22.26
 * Class AirlineRepositoryTest
 * @package WebAppId\Airline\Tests\Unit\Repositories
 */
class AirlineRepositoryTest extends TestCase
{
    /**
     * @var AirlineRepository
     */
    private $airlineRepository;

    /**
     * AirlineRepositoryTest constructor.
     * @param null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->airlineRepository = $this->container->make(AirlineRepository::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function dummyData()
    {
        $airportParam = new AirlineParam();
        $airportParam->id = $this->getFaker()->randomNumber();
        $airportParam->icao_code = $this->getFaker()->text(10);
        $airportParam->iata_code = $this->getFaker()->text(10);
        $airportParam->name = $this->getFaker()->text(100);
        $airportParam->alias = $this->getFaker()->text(5);
        $airportParam->call_sign = $this->getFaker()->text(5);
        $airportParam->active = $this->getFaker()->boolean ? 'Y' : 'N';
        $airportParam->country_id = '1';
        $airportParam->user_id = '1';
        return $airportParam;
    }

    private function createData($dummy)
    {
        return $this->container->call([$this->airlineRepository, 'store'], ['airlineParam' => $dummy]);
    }

    public function testStoreRepository(): ?Airline
    {
        $dummy = $this->dummyData();
        $result = $this->createData($dummy);

        self::assertNotEquals(null, $result);
        return $result;
    }

    public function testGetByNameLike()
    {
        $query = 'aiueo';
        $result = $this->container->call([$this->airlineRepository, 'getByNameLike'], ['q' => $query[$this->getFaker()->numberBetween(0, $this->getSize($query) - 1)]]);
        self::assertNotEquals(null, $result);
    }

    public function getIataCode()
    {
        $codes = [
            "GA",
            "ZI",
            "G8",
            "TL"
        ];

        return $codes[$this->getFaker()->numberBetween(0, count($codes) - 1)];
    }

    public function testByIataCode()
    {
        $code = $this->getIataCode();

        $result = $this->container->call([$this->airlineRepository, 'getByIataCode'], ['code' => $code]);
        self::assertNotEquals(null, $result);
    }

    public function getIcaoCode()
    {
        $codes = [
            "GIA",
            "GMT",
            "HOL"
        ];

        return $codes[$this->getFaker()->numberBetween(0, count($codes) - 1)];
    }

    public function testIcaoCode()
    {
        $code = $this->getIcaoCode();

        $result = $this->container->call([$this->airlineRepository, 'getByIcaoCode'], ['code' => $code]);
        self::assertNotEquals(null, $result);
    }

    public function testUpdate()
    {
        $randomId = $this->getFaker()->numberBetween(0, 100);

        $dummy = $this->dummyData();

        unset($dummy->id);

        $updatedData = $this->container->call([$this->airlineRepository, 'update'], ['id' => $randomId, 'airlineParam' => $dummy]);

        self::assertNotEquals(null, $updatedData);
    }
}