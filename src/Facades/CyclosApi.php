<?php

namespace Angstrom\CyclosApi\Facades;

use Illuminate\Support\Facades\Facade;

class CyclosApi extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'cyclos';
    }
}
