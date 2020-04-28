<?php

namespace Delta5\NWSApi;

use Delta5\NWSApi\Objects\NWSAlert;
use Delta5\NWSApi\objects\NWSStation;
use Delta5\NWSApi\objects\NWSZone;
use GuzzleHttp\Client;
use Delta5\NSWApi\objects;

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

        $res = $client->request($method, $url);

        if($res->getStatusCode() == 200)
        {
            $data = $res->getBody();
            $json = json_decode($data, true);
            return $json['@graph'];
        }

        return null;
    }

    private static function buildStringFromArray(array $array)
    {
        $arrayList = '';

        foreach ($array as $item)
        {
            $arrayList = $arrayList . ','.$item;
        }

        return substr($arrayList, 1, strlen($arrayList));
    }

    public static function getAlerts($region = null, $area = null, $zone = null, $urgency = null, $severity = null, $certainty = null, $limit = null, $active = null, $status = null, $region_type = null, $message_type = null, $start = null, $end = null)
    {
        $urlParameters = array();

        if ($region != null) {
            $urlParameters['region'] = self::buildStringFromArray($region);
        }

        if ($area != null) {
            $urlParameters['area'] = self::buildStringFromArray($area);
        }

        if ($zone != null) {
            $urlParameters['zone'] = self::buildStringFromArray($zone);
        }

        if($urgency != null) {
            $urlParameters['urgency'] = self::buildStringFromArray($urgency);
        }

        if($severity != null){
            $urlParameters['severity'] = self::buildStringFromArray($severity);
        }

        if($certainty != null)
        {
            $urlParameters['certainty'] = self::buildStringFromArray($certainty);
        }

        if($limit != null)
        {
            $urlParameters['limit'] = $limit;
        }

        if($active != null)
        {
            $urlParameters['active'] = $active;
        }

        if($status != null)
        {
            $urlParameters['status'] = self::buildStringFromArray($status);
        }

        if($region_type != null)
        {
            $urlParameters['region_type'] = $region_type;
        }

        if($message_type != null)
        {
            $urlParameters['message_type'] = self::buildStringFromArray($message_type);
        }

        if($start != null)
        {
            $urlParameters['start'] = $start;
        }

        if($end != null)
        {
            $urlParameters['end'] = $end;
        }

        if($urlParameters > 0)
        {
            $alerts = self::queryAPI(config('nwsapi.endpoint').'/alerts?'.http_build_query($urlParameters), 'GET');
        }
        else
        {
            $alerts = self::queryAPI(config('nwsapi.endpoint').'/alerts/active', 'GET');
        }

        if($alerts != null)
        {
            $alertList = new \ArrayObject();

            foreach ($alerts as $alert) {
                $newAlert = new NWSAlert();
                $newAlert->convertArray($alert);
                $alertList->append($newAlert);
            }

            return $alertList;
        }

        return null;
    }

    public static function getZones($region = null, $area = null, $type = null, $point = null, $geometry = null)
    {
        $urlParameters = array();

        if($region != null)
        {
            $urlParameters['region'] = self::buildStringFromArray($region);
        }

        if($area != null)
        {
            $urlParameters['area'] = self::buildStringFromArray($area);
        }

        if($type != null)
        {
            $urlParameters['type'] = self::buildStringFromArray($type);
        }

        if($point != null)
        {
            $urlParameters['point'] = $point;
        }

        if($geometry != null)
        {
            $urlParameters['include_geometry'] = $geometry;
        }

        if($urlParameters > 0)
        {
            $zones = self::queryAPI(config('nwsapi.endpoint').'/zones?'.http_build_query($urlParameters), 'GET');
        }
        else
        {
            $zones = self::queryAPI(config('nwsapi.endpoint').'/zones', 'GET');
        }

        if($zones != null)
        {
            $zoneList = new \ArrayObject();

            foreach ($zones as $zone) {
                $newZone = new NWSZone();
                $newZone->convertArray($zone);
                $zoneList->append($newZone);
            }

            return $zoneList;
        }

        return null;
    }

    public static function getStations($limit = null, $states = null)
    {
        $urlParameters = array();

        if($limit != null)
        {
            $urlParameters['limit'] = $limit;
        }

        if($states != null)
        {
            $urlParameters['state'] = self::buildStringFromArray($states);
        }

        if($urlParameters > 0)
        {
            $stations = self::queryAPI(config('nwsapi.endpoint').'/stations?'.http_build_query($urlParameters), 'GET');
        }
        else
        {
            $stations = self::queryAPI(config('nwsapi.endpoint').'/stations', 'GET');
        }

        if($stations != null)
        {
            $stationList = new \ArrayObject();

            foreach ($stations as $station)
            {
                $newStation = new NWSStation();
                $newStation->convertArray($station);
                $stationList->append($newStation);
            }

            return $stationList;
        }

        return null;
    }
}
