<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../vendor/autoload.php';
session_start();

$config = require 'core/config.php';

require 'core/database/connection.php';

$pdo = connection::make($config['database']);

require 'core/database/QueryBuilder.php';

require 'Controller/PagesController.php';

new PagesController($pdo);

require 'core/Route.php';








