<?php


namespace Juanparati\BrevoSuite\Facades;

use Illuminate\Support\Facades\Facade;


class Template extends Facade
{

    protected static function getFacadeAccessor()
    {
        return \Juanparati\BrevoSuite\Template::class;
    }
}
