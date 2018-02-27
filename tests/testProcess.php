<?php
/**
 * Created by PhpStorm.
 * User: ycy
 * Date: 2/26/18
 * Time: 1:06 PM
 */

require __DIR__ . '/../vendor/autoload.php';

$code = isset($argv[1]) ? $argv[1] : "WCb1bnAVp3lZQdDCU";
$service = new \Service\SendPackageService($code);
while (true){

    $service->send();
    sleep(60);
}
