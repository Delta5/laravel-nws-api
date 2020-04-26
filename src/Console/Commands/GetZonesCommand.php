<?php

namespace Delta5\NWSApi\Console\Commands;

use Delta5\NWSApi\NWSApi;
use Illuminate\Console\Command;

class GetZonesCommand extends Command
{
    protected $signature = 'nwsapi:getzones';

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
        $zones = NWSApi::getAllZones();

        if($zones != null)
        {
            foreach ($zones as $zone)
            {
                print_r($zone);
            }
        }
    }
}
