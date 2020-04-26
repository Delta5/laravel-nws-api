<?php

namespace Delta5\NWSApi\Console\Commands;

use Delta5\NWSApi\NWSApi;
use Illuminate\Console\Command;

class GetStationsCommand extends Command
{
    protected $signature = 'nwsapi:getstations';

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
        $stations = NWSApi::getAllStations();

        if($stations != null)
        {
            foreach ($stations as $station)
            {
                print_r($station);
            }
        }
    }
}
