<?php

namespace Delta5\NWSApi;

use Delta5\NWSApi\Objects\NWSAlert;
use GuzzleHttp\Client;
use Delta5\NSWApi\Objects;

class NWSApi
{
    private static $userAgent = 'LARAVEL-NWS-API, dev@evantaylor.name';
    private static $apiDataFormat = 'application/ld+json';

    public function __construct()
    {

    }

    private static function queryAPI($url, $method)
    {
        $headers  = [ 'headers' => [
            'User-Agent' => self::$userAgent,
            'Accept' => self::$apiDataFormat,
        ]];

        $client = new Client($headers);

        return $client->request($method, $url);
    }

    public static function getAllActiveAlerts()
    {
        $res = self::queryAPI(config('nwsapi.endpoint').'/alerts/active', 'GET');

        if($res->getStatusCode() == 200)
        {
            $data = $res->getBody();

            $json = json_decode($data, true);

            $alerts = $json['@graph'];

            $alertList = new \ArrayObject();

            foreach($alerts as $alert)
            {
                $newAlert = new NWSAlert();
                $newAlert->alertID = $alert['id'];
                $newAlert->areaDesc = $alert['areaDesc'];
                $newAlert->alertURL = $alert['@id'];
                $newAlert->sent = $alert['sent'];
                $newAlert->effective = $alert['effective'];
                $newAlert->onset = $alert['onset'];
                $newAlert->expires = $alert['expires'];
                $newAlert->ends = $alert['ends'];
                $newAlert->status = $alert['status'];
                $newAlert->messageType = $alert['messageType'];
                $newAlert->category = $alert['category'];
                $newAlert->severity = $alert['severity'];
                $newAlert->certainty = $alert['certainty'];
                $newAlert->urgency = $alert['urgency'];
                $newAlert->event = $alert['event'];
                $newAlert->sender = $alert['sender'];
                $newAlert->senderName = $alert['senderName'];
                $newAlert->headline = $alert['headline'];
                $newAlert->description = $alert['description'];
                $newAlert->instruction = $alert['instruction'];
                $newAlert->response = $alert['response'];
                $newAlert->geocode = $alert['geocode'];

                $alertList->append($newAlert);
            }

            return $alertList;
        }
        else
        {
            return null;
        }
    }

    public static function getAllActiveAlertsLimit($limit)
    {
        $client = new Client();

        $res = self::queryAPI(config('nwsapi.endpoint').'/alerts/active?limit='.$limit, 'GET');

        if($res->getStatusCode() == 200)
        {
            $data = $res->getBody();

            $json = json_decode($data, true);

            $alerts = $json['@graph'];

            $alertList = new \ArrayObject();

            foreach($alerts as $alert)
            {
                $newAlert = new NWSAlert();
                $newAlert->alertID = $alert['id'];
                $newAlert->areaDesc = $alert['areaDesc'];
                $newAlert->alertURL = $alert['@id'];
                $newAlert->sent = $alert['sent'];
                $newAlert->effective = $alert['effective'];
                $newAlert->onset = $alert['onset'];
                $newAlert->expires = $alert['expires'];
                $newAlert->ends = $alert['ends'];
                $newAlert->status = $alert['status'];
                $newAlert->messageType = $alert['messageType'];
                $newAlert->category = $alert['category'];
                $newAlert->severity = $alert['severity'];
                $newAlert->certainty = $alert['certainty'];
                $newAlert->urgency = $alert['urgency'];
                $newAlert->event = $alert['event'];
                $newAlert->sender = $alert['sender'];
                $newAlert->senderName = $alert['senderName'];
                $newAlert->headline = $alert['headline'];
                $newAlert->description = $alert['description'];
                $newAlert->instruction = $alert['instruction'];
                $newAlert->response = $alert['response'];
                $newAlert->geocode = $alert['geocode'];

                $alertList->append($newAlert);
            }

            return $alertList;
        }
        else
        {
            return null;
        }
    }
}
