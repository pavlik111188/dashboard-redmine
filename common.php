<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once 'GoogleSheets.php';

$config = require_once('config.php');

session_start();

$g = new GoogleSheets($config['googleAppName'], $config['googleCredentialsFile'], $config['googleClientSecretFile']);