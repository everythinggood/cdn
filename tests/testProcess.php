<?php
/**
 * Created by PhpStorm.
 * User: ycy
 * Date: 2/26/18
 * Time: 1:06 PM
 */

require  __DIR__.'/../vendor/autoload.php';


//echo base64_encode(70);
//echo base64_decode("MEUrMDA=");
//echo rand()%4+6;
//echo substr(system("date +%s%N"),2,17);
//exit;

$code = "WCb1bnAVp3lZQdDCU";
//$client = new \GuzzleHttp\Client();
//$response = $client->post("st.mybcdn.com:8395/iden",[
//    "json"=>[
//        "Id"=>"V0NiMWJuQVZwM2xaUWREQ1U="
//    ]
//]);
//echo $response->getBody();
//$service = new \Service\SendPackageService($code);
//while (true){
//
//    $service->send();
//    sleep(60);
//}

$service = new \Service\ProcessService();
while (true){
    $service->addWork();
    var_dump(\Service\ProcessService::$workNumbers);
    sleep(20);
}
