<?php

namespace Delta5\NWSApi\Console\Commands;

use Delta5\NWSApi\NWSApi;
use Illuminate\Console\Command;

class GetZonesCommand extends Command
{
    protected $signature = 'nwsapi:getzones
                            {--area=* : States to be included in API call.}
                            {--region=* : Region code. Available values - AR, CR, ER, PR, SR, WR, AL, AT, GL, GM, PA, PI}
                            {--type=* : Zone type. Available values - land, marine, forecast, public, coastal, offshore, fire, county}
                            {--point= : Latitude and Longitude point in this format (latitude,longitude)}
                            {--include-geometry= : Whether to include geometry data. True/False}';

    protected $description = 'Returns all zones that are defined by NWS.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $area = $this->option('area');
        $region = $this->option('region');
        $type = $this->option('type');
        $point = $this->option('point');
        $geometry = $this->option('include-geometry');

        $this->info('Querying NWS Zones API');

        $zones = NWSApi::getZones($region, $area, $type, $point, $geometry);

        if($zones != null)
        {
            $results = array();
            $arrayCounter = 0;

            foreach ($zones as $zone)
            {
                $results[$arrayCounter]['id'] = $zone->ID;
                $results[$arrayCounter]['name'] = $zone->name;
                $results[$arrayCounter]['state'] = $zone->state;
                $results[$arrayCounter]['type'] = $zone->type;
                $results[$arrayCounter]['url'] = $zone->URL;

                $arrayCounter++;
            }

            $headers = ['ID', 'Name', 'State', 'Type', 'URL'];

            $this->table($headers, $results);
        }
        else
        {
            $this->error('Error retrieving data from NWS Zones API!');
        }
    }
}
