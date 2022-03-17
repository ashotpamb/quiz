<?php

namespace TypiCMS\Modules\Cats\Facades;

use Illuminate\Support\Facades\Facade;

class Cats extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Cats';
    }
}
