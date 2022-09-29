<?php

return [
    'App\Interfaces\*RepositoryInterface' => DI\autowire('App\Repositories\*JsonRepository'),
//    'App\Interfaces\DBPdoInterface' => DI\autowire("App\DBPdo"),
];