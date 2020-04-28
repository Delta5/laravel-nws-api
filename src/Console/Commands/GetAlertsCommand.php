<?php

namespace Delta5\NWSApi\Console\Commands;

use Delta5\NWSApi\NWSApi;
use Illuminate\Console\Command;

class GetAlertsCommand extends Command
{
    protected $signature = 'nwsapi:getalerts
                            {--region=*}
                            {--area=*}
                            {--zone=*}
                            {--urgency=*}
                            {--certainty=*}
                            {--severity=*}
                            {--limit=}
                            {--active=}
                            {--status=*}
                            {--region-type=}
                            {--message-type=*}
                            {--start=}
                            {--end=}';

    protected $description = 'Returns all weather alerts from NWS.';

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
        $region = $this->option('region');
        $area = $this->option('area');
        $zone = $this->option('zone');
        $urgency = $this->option('urgency');
        $severity = $this->option('severity');
        $certainty = $this->option('certainty');
        $limit = $this->option('limit');
        $active = $this->option('active');
        $status = $this->option('status');
        $region_type = $this->option('region-type');
        $message_type = $this->option('message-type');
        $start = $this->option('start');
        $end = $this->option('end');

        $this->info('Query NWS Alerts API');

        $alerts = NWSApi::getAlerts($region, $area, $zone, $urgency, $severity, $certainty, $limit, $active, $status, $region_type, $message_type, $start, $end);

        if($alerts != null)
        {
            $results = array();
            $arrayCounter = 0;

            foreach ($alerts as $alert)
            {
                $results[$arrayCounter]['id'] = $alert->alertID;
                $results[$arrayCounter]['headline'] = $alert->headline;
                $results[$arrayCounter]['severity'] = $alert->severity;
                $results[$arrayCounter]['status'] = $alert->status;

                $arrayCounter++;
            }

            $headers = ['ID', 'Headline', 'Severity', 'Status'];

            $this->table($headers, $results);
        }
        else
        {
            $this->error('Error retrieving data from NWS Stations API!');
        }
    }
}
