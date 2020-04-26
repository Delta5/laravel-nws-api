<?php

namespace Delta5\NWSApi\Console\Commands;

use Delta5\NWSApi\NWSApi;
use Illuminate\Console\Command;

class TestAPICommand extends Command
{
    protected $signature = 'nwsapi:testapi '.
        ''.
        ''.
        '';

    protected $description = 'Tests the NWS API to ensure it connects correctly';

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
        $alerts = NWSApi::getAllActiveAlertsLimit(1);

        if ($alerts != null) {

            foreach ($alerts as $alert) {
                print_r($alert);
            }
        }
        else
        {
            echo "Error while running command.";
        }
    }
}
