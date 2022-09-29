<?php

return [
    'App\Interfaces\*RepositoryInterface' => DI\autowire('App\Repositories\*JsonRepository'),
    'App\Interfaces\*DTOInterface' => DI\autowire('App\DTOs\*JsonDTO'),
//    'App\Interfaces\DBPdoInterface' => DI\autowire("App\DBPdo"),
];