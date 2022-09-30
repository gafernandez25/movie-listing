<?php

/**
 * Dependency Injection Container interface bindings
 * https://php-di.org/
 */
return [
    'App\Interfaces\*RepositoryInterface' => DI\autowire('App\Repositories\*JsonRepository'),
    'App\Interfaces\UserDTOInterface' => DI\autowire('App\DTOs\UserJsonDTO'),
    'App\Interfaces\ApiDTOInterface' => DI\autowire('App\DTOs\ApiOmdbDTO'),
];