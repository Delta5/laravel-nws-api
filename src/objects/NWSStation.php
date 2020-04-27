<?php

namespace Delta5\NWSApi\objects;

class NWSStation
{
    public $ID;
    public $name;
    public $URL;
    public $timezone;

    public function convertArray($station)
    {
        $this->name = $station['name'];
        $this->timezone = $station['timeZone'];
        $this->ID = $station['stationIdentifier'];
        $this->URL = $station['@id'];
    }
}
