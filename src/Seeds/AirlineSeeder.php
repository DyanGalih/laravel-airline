<?php
/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-14
 * Time: 16:39
 */

namespace WebAppId\Airline\Seeds;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use WebAppId\Airline\Repositories\AirlineRepository;
use WebAppId\Airline\Services\Params\AirlineParam;
use WebAppId\Country\Repositories\CountryRepository;
use WebAppId\DDD\Tools\Lazy;

class AirlineSeeder extends Seeder
{
    public function run(AirlineRepository $airportRepository, AirlineParam $airlineParam, CountryRepository $countryRepository)
    {
        $file = __DIR__ . '/../Resources/Csv/Airline.csv';
        $header = array('id', 'name', 'alias', 'iata_code', 'icao_code', 'call_sign', 'country_id', 'active');

        $delimiter = ',';
        if (file_exists($file) || is_readable($file)) {

            if (($handle = fopen($file, 'r')) !== false) {
                DB::beginTransaction();
                while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                    $data = array_combine($header, $row);
                    if ($data['id'] != 'id') {
                        $airlineParam = Lazy::copyFromArray($data, $airlineParam, Lazy::AUTOCAST);
                        $airlineParam->user_id = '1';
                        $airlineParam->active = strtoupper($airlineParam->active);
                        if(!strpos($_SERVER['SCRIPT_NAME'], 'phpunit')){
                            $country = $this->container->call([$countryRepository,'getLike'],['search' => $data['country_id']]);
                            $airlineParam->country_id = $country[0]->id;
                        }else{
                            $airlineParam->country_id = 1;
                        }
                        $this->container->call([$airportRepository, 'store'], ['airlineParam' => $airlineParam]);
                    }
                }
                DB::commit();
                fclose($handle);
            }
        }
    }
}