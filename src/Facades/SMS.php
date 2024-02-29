<?php


namespace Juanparati\BrevoSuite\Facades;

use Illuminate\Support\Facades\Facade;


class SMS extends Facade
{

    protected static function getFacadeAccessor()
    {
        return \Juanparati\BrevoSuite\Sms::class;
    }
}
