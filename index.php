<?php
require 'config/constants.php';
require 'config/site_config.php';
require 'Router.php';
require __dir__ . '/vendor/autoload.php';
require 'components/LogHelper.php';

$request = $_SERVER['REQUEST_URI'];

// LogHelper::log('Routing to \'' . $request . '\'', __FILE__ . '::' . __LINE__);
Router::route($request);