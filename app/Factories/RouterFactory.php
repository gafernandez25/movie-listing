<?php

namespace App\Factories;

use DI;
use Router\Router;

class RouterFactory
{
    public static function create()
    {
        $builder = new DI\ContainerBuilder();
        $builder->addDefinitions(dirname(__DIR__, 2) . "/config/container.php");

        $container = $builder->build();

        return new Router($container);
    }
}