<?php

namespace Jeybin\Packagename\Facades;

use Illuminate\Support\Facades\Facade;

class PackageFacades extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'packagefacade';
    }
}