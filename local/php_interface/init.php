<?php

    use Bitrix\Main\Loader;

    Loader::registerAutoLoadClasses(null, [
        'Bitrix\ClientTable' => '/local/php_interface/classes/clienttable.php',
        'Bitrix\StatusTable' => '/local/php_interface/classes/statustable.php',
        'Bitrix\TaskTable' => '/local/php_interface/classes/tasktable.php'
    ]);