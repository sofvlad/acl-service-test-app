<?php
declare(strict_types=1);

require dirname(__DIR__, 1) . DS . 'vendor' . DS . 'autoload.php';

define('CAKE_CORE_PATH', dirname(__DIR__, 1) . DS . 'vendor' . DS . 'cakephp' . DS . 'core' . DS);

require CAKE_CORE_PATH . 'functions_global.php';

(new josegonzalez\Dotenv\Loader(dirname(__DIR__, 1) . DS . '.env'))
    ->parse()
    ->toEnv();
