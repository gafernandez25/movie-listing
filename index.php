<?php

session_start();
require_once __DIR__ . '/vendor/autoload.php';

use Router\Routes;

define('VIEW_PATH', __DIR__ . "/views");

(new Routes())->set();


