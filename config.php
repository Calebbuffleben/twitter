<?php

require 'environment.php';

define("BASE_URL","http://localhost/twitter");

global $config;
$config = array();
if (ENVIRONMENT == "development") {
    $config['dbname'] = 'twitter';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['pass'] = '';
} else {
    $config['dbname'] = 'twitter';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['pass'] = '';
}

