<?php

namespace Delta5\NWSApi\objects;

class NWSZone
{
    public $ID;
    public $URL;
    public $type;
    public $name;
    public $state;

    public function convertArray($zone)
    {
        $this->ID = $zone['id'];
        $this->URL = $zone['@id'];
        $this->type = $zone['type'];
        $this->name = $zone['name'];
        $this->state = $zone['state'];
    }
}
