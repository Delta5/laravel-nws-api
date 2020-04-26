<?php

namespace Delta5\NWSApi\objects;

class NWSStation
{
    public $stationID;
    public $name;
    public $stationURL;
    public $timezone;

    public function convertArray($station)
    {
        $this->name = $station['name'];
        $this->timezone = $station['timeZone'];
        $this->stationID = $station['stationIdentifier'];
        $this->stationURL = $station['@id'];
    }
}
