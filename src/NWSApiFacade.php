<?php

namespace Delta5\NWSApi;

use Illuminate\Support\Facades\Facade;

class NWSApiFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'nwsapi';
    }

}
