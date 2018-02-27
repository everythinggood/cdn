<?php
/**
 * Created by PhpStorm.
 * User: ycy
 * Date: 2/26/18
 * Time: 8:43 PM
 */

require __DIR__.'/../vendor/autoload.php';

require __DIR__ . '/../src/Command/CreateSupervisorConfigFile.php';

//while(true){
//    var_export(\Service\ProcessService::$workNumbers);
//    sleep(10);
//}

new \Command\CreateSupervisorConfigFile();