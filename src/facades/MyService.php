<?php
namespace Nikolag\Myservice\Facades;

use Illuminate\Support\Facades\Facade;

class MyService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'my-service';
    }
}
