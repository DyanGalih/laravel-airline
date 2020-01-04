<?php
/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-14
 * Time: 15:39
 */

namespace WebAppId\Airport\Tests\Feature\Services;


use Illuminate\Contracts\Container\BindingResolutionException;
use WebAppId\Airline\Services\AirlineService;
use WebAppId\Airline\Tests\TestCase;
use WebAppId\Airline\Tests\Unit\Repositories\AirlineRepositoryTest;

class AirlineServiceTest extends TestCase
{
    /**
     * @var AirlineService
     */
    private $airlineService;

    /**
     * @var AirlineRepositoryTest
     */
    private $airlineRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->airlineService = $this->container->make(AirlineService::class);
            $this->airlineRepositoryTest = $this->container->make(AirlineRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $dummy = $this->container->call([$this->airlineRepositoryTest, 'dummyData']);
        unset($dummy->id);
        $result = $this->container->call([$this->airlineService, 'store'], ['airlineParam' => $dummy]);
        self::assertTrue($result->isStatus());
    }

    public function testGetByIataCode()
    {
        $iataCode = $this->container->call([$this->airlineRepositoryTest, 'getIataCode']);
        $result = $this->container->call([$this->airlineService, 'getByIataCode'], ['code' => $iataCode]);
        self::assertTrue($result->isStatus());
    }

    public function testGetByIcaoCode()
    {
        $icaoCode = $this->container->call([$this->airlineRepositoryTest, 'getIcaoCode']);
        $result = $this->container->call([$this->airlineService, 'getByIcaoCode'], ['code' => $icaoCode]);
        self::assertTrue($result->isStatus());
    }

    public function testGetById()
    {
        $id = $this->getFaker()->numberBetween(0,100);
        $result = $this->container->call([$this->airlineService,'getById'],['id' => $id]);
        self::assertTrue($result->isStatus());
    }


}