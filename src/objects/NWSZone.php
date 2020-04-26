<?php

namespace Delta5\NWSApi\objects;

class NWSZone implements NWSObject
{
    public $zoneID;
    public $zoneURL;
    public $type;
    public $name;
    public $state;

    public function convertArray($zone)
    {
        $this->zoneID = $zone['id'];
        $this->zoneURL = $zone['@id'];
        $this->type = $zone['type'];
        $this->name = $zone['name'];
        $this->state = $zone['state'];
    }
}
