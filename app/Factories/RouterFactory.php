<?php

declare(strict_types=1);

namespace App\Factories;

use DI;
use App\Router;

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