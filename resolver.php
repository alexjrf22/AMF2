<?php 

$resolver = new ALEX\Resolver;

$resolver['PDO'] = function($r)
{
    return new PDO('mysql:host=localhost; dbname=AMF2', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
};

return $resolver;