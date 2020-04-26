<?php

namespace Delta5\NWSApi\objects;

class NWSAlert
{
    public $alertID;
    public $alertURL;
    public $areaDesc;
    public $sent;
    public $effective;
    public $onset;
    public $expires;
    public $ends;
    public $status;
    public $messageType;
    public $category;
    public $severity;
    public $certainty;
    public $urgency;
    public $event;
    public $sender;
    public $senderName;
    public $headline;
    public $description;
    public $instruction;
    public $response;
    public $geocode;

    public function convertArray($alert)
    {
        $this->alertID = $alert['id'];
        $this->areaDesc = $alert['areaDesc'];
        $this->alertURL = $alert['@id'];
        $this->sent = $alert['sent'];
        $this->effective = $alert['effective'];
        $this->onset = $alert['onset'];
        $this->expires = $alert['expires'];
        $this->ends = $alert['ends'];
        $this->status = $alert['status'];
        $this->messageType = $alert['messageType'];
        $this->category = $alert['category'];
        $this->severity = $alert['severity'];
        $this->certainty = $alert['certainty'];
        $this->urgency = $alert['urgency'];
        $this->event = $alert['event'];
        $this->sender = $alert['sender'];
        $this->senderName = $alert['senderName'];
        $this->headline = $alert['headline'];
        $this->description = $alert['description'];
        $this->instruction = $alert['instruction'];
        $this->response = $alert['response'];
        $this->geocode = $alert['geocode'];
    }
}
