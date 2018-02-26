<?php
/**
 * Created by PhpStorm.
 * User: ycy
 * Date: 2/26/18
 * Time: 3:43 PM
 */

namespace Service;

use GuzzleHttp\Client;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Service\Request\AddRequest;

class SendPackageService
{
    /**
     * @var Client
     */
    private $client;
    /**
     * @var string
     */
    private $code;
    /**
     * @var Logger
     */
    private $logger;

    /**
     * sendPackageService constructor.
     * @param String $code
     */
    public function __construct(String $code)
    {
        $this->client = new Client();
        $this->code = trim($code);
        $this->logger = $this->initLogger($this->code);
    }

    protected function initLogger($name){
        $logger = new Logger($name);
        $logger->pushHandler(new StreamHandler(__DIR__.'/../../logs/'.$name.'.log',Logger::INFO));

        return $logger;
    }

    public function send(){
        $this->logger->info("start send package ");
        $response1 = $this->sendIdPackage();
        $response2 = $this->sendAddPackage();
        $this->logger->info("end send package");
    }

    protected function sendIdPackage()
    {
        $json = [
            'Id' => base64_encode($this->code)
        ];
        $this->logger->info("send iden request",$json);
        $response = $this->client->post('st.mybcdn.com:8395/iden', [
            "json" => $json
        ]);

        $this->logger->info($response->getBody(),(array)$response);
        return $response;
    }

    protected function sendAddPackage()
    {

        $request = new AddRequest();
        $request->Id = base64_encode($this->code);
        $request->Freecipan = base64_encode($request->Freecipan);
        $request->Tvar_free = base64_encode($this->generateNonStr());

        $this->logger->info("send add request",(array)$request);

        $response = $this->client->post("st.mybcdn.com:8395/add",[
            "json"=>(array)$request
        ]);

        $this->logger->info($response->getBody(),(array)$response);

        return $response;
    }

    protected function generateNonStr()
    {
        $x = rand()%4+6;
        $y = substr(system("date +%s%N"),2,17);

        return $x.'.'.$y."E-01";
    }
}
