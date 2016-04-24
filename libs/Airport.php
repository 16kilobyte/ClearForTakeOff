<?php

/**
 *
 */
class Airport extends Model
{

    private $airport;

    public function __construct()
    {
        parent::__construct();
    }

    public function name2Data($airport)
    {
        $data = $this->FetchRow("SELECT * FROM airports WHERE name = ?", array($airport));
        return $data;
    }

    /* function to get weather conditions of airports */
    public function conditions($airport_code)
    {
        //$date = new DateTime($datetime);
        //$period = $date->format("ddmmHi");
        $api_url = "http://api.wunderground.com/api/" . wuAPI_KEY . "/geolookup/conditions/q/{$airport_code}.json";

        $json_string = file_get_contents($api_url);
        $parsed_json = json_decode($json_string);
        $this->location = $parsed_json->{'location'}->{'city'};
        $this->temp_f = $parsed_json->{'current_observation'}->{'temp_f'};
        $this->temp_c = $parsed_json->{'current_observation'}->{'temp_c'};
        $this->temp = $parsed_json->{'current_observation'}->{'temperature_string'};
        $this->r_humidity = $parsed_json->{'current_observation'}->{'relative_humidity'};
        $this->wind_string = $parsed_json->{'current_observation'}->{'wind_string'};
        $this->wind_dir = $parsed_json->{'current_observation'}->{'wind_dir'};
        $this->wind_gust_kph = $parsed_json->{'current_observation'}->{'wind_gust_kph'};
        $this->visibility_km = $parsed_json->{'current_observation'}->{'visibility_km'};
        $this->icon = $parsed_json->{'current_observation'}->{'icon'};
        $this->icon_url = $parsed_json->{'current_observation'}->{'icon_url'};
        $this->precip_1hr_string = $parsed_json->{'current_observation'}->{'precip_1hr_string'};
        //$ = $parsed_json->{'current_observation'}->{''};
    }

    public function goodToGo()
    {
        $this->visibility_check = ( (int) $this->visibility_km > 0.5);
        $this->blizzard_check = ( (int) $this->wind_gust_kph < 56 );
        $this->icing_check = ( (int) $this->temp_c > -8 );
        if($this->visibility_check && $this->blizzard_check && $this->icing_check)
        {
            return true;
        } else {
            return false;
        }
    }

}
