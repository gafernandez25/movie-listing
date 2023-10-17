<?php

session_start();
require_once dirname(__DIR__) . '/vendor/autoload.php';

use Router\Routes;

define('VIEW_PATH', dirname(__DIR__) . "/views");

(new Routes())->set();
