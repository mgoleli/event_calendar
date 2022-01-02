<?php

define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);

if (file_exists(ROOT . 'vendor/autoload.php')) {
    require ROOT . 'vendor/autoload.php';
}

// load application config (error reporting etc.)
require APP . 'config/config.php';

require APP . 'libs/helper.php';

// load application class
require APP . 'core/application.php';
require APP . 'core/controller.php';

// start the applicationf
$app = new Application();
