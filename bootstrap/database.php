<?php
declare(strict_types=1);

\Cake\Datasource\ConnectionManager::setConfig(
    'default',
    require DIR_CONFIG . 'database.php'
);
