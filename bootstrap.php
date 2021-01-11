<?php

require_once __DIR__ . "/vendor/autoload.php";
$router = require_once __DIR__ . "/router.php";
$resolver = require_once __DIR__ . "/resolver.php";
$object = $router->handler();

$resolver->handler($object['class'], $object['action']);