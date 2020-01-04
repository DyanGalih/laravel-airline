<?php
/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-14
 * Time: 02:20
 */

namespace WebAppId\Airline\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com>
 * Date: 30/12/19
 * Time: 23.28
 * Class Airline
 * @package WebAppId\Airline\Models
 */
class Airline extends Model
{
    protected $table = 'airlines';
    
    protected $fillable = ['id', 'name', 'alias', 'iata_code', 'icao_code', 'call_sign', 'country_id', 'user_id', 'active'];
}