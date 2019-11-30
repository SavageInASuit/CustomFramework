<?php
require 'config/constants.php';
require 'config/site_config.php';
require 'Router.php';
require 'components/Logger.php';

$request = $_SERVER['REQUEST_URI'];

// Logger::log('Routing to \'' . $request . '\'', __FILE__ . '::' . __LINE__);
Router::route($request);