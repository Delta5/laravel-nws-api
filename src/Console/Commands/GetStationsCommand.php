<?php

namespace Delta5\NWSApi\Console\Commands;

use Delta5\NWSApi\NWSApi;
use Illuminate\Console\Command;

class GetStationsCommand extends Command
{
    protected $signature = 'nwsapi:getstations {--limit=} {--states=*}';

    protected $description = 'Returns all stations that are defined by NWS.';

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
        $limit = $this->option('limit');
        $states = $this->option('states');

        $this->info('Querying NWS Stations API');

        $stations = NWSApi::getStations($limit, $states);

        if($stations != null)
        {
            $results = array();
            $arrayCounter = 0;

            foreach ($stations as $station)
            {
                $results[$arrayCounter]['id'] = $station->ID;
                $results[$arrayCounter]['name'] = $station->name;
                $results[$arrayCounter]['url'] = $station->URL;
                $results[$arrayCounter]['timezone'] = $station->timezone;

                $arrayCounter++;
            }

            $headers = ['ID', 'Name', 'URL', 'Timezone'];

            $this->table($headers, $results);
        }
        else
        {
            $this->error('Error retrieving data from NWS Stations API!');
        }
    }
}
