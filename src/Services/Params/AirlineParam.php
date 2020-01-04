<?php
/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-14
 * Time: 02:33
 */

namespace WebAppId\Airline\Services\Params;

/**
 * Class AirlineParam
 * @package WebAppId\Airline\Serivces\Params
 */
class AirlineParam
{
    /**
     * @var integer
     */
    public $id;
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $alias;
    /**
     * @var string
     */
    public $iata_code;
    /**
     * @var string
     */
    public $icao_code;
    /**
     * @var string
     */
    public $call_sign;
    /**
     * @var int
     */
    public $country_id;
    /**
     * @var int
     */
    public $user_id;
    /**
     * @var string
     */
    public $active;

}