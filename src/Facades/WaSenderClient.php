<?php

namespace Alareqi\FilamentWhatsapp\Facades;

use Illuminate\Support\Facades\Facade;

class WaSenderClient extends Facade
{


    protected static function getFacadeAccessor()
    {
        return 'WaSenderClient';
    }
}
