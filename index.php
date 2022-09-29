<?php

session_start();
require_once __DIR__ . '/vendor/autoload.php';

use Router\Routes;

(new Routes())->set();


