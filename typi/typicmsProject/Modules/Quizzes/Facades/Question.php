<?php

namespace TypiCMS\Modules\Quizzes\Facades;

use Illuminate\Support\Facades\Facade;

class Question extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Question';
    }
}
