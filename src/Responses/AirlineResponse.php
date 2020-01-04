<?php


namespace WebAppId\Airline\Responses;


use WebAppId\Airline\Models\Airline;
use WebAppId\DDD\Responses\AbstractResponse;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com>
 * Date: 02/01/20
 * Time: 22.28
 * Class AirlineResponse
 * @package WebAppId\Airline\Responses
 */
class AirlineResponse extends AbstractResponse
{
    /**
     * @var Airline
     */
    public $airline;
}