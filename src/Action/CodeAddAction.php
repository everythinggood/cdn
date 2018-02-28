<?php
/**
 * Created by PhpStorm.
 * User: ycy
 * Date: 2/27/18
 * Time: 8:31 PM
 */

namespace Action;


use Contract\Container;
use Doctrine\ODM\MongoDB\DocumentManager;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class CodeAddAction implements ActionInterface
{
    /**
     * @var DocumentManager
     */
    private $dm;
    /**
     * @var Logger
     */
    private $logger;

    public function __construct(ContainerInterface $container)
    {
        $this->dm = $container[Container::NAME_DATA_MANAGER];
        $this->logger = $container[Container::NAME_LOGGER];
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return mixed|static
     * @throws \Exception
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {

        /** @var Request $request */
        $code = $request->getParam('code');

        if(!$code){
            throw new \Exception("require [code] params");
        }

        $realDir = realpath(__DIR__.'/../..');

        if(file_exists($realDir."/supervisor/conf.d/{$code}.conf")){
            throw new \Exception("{$code}.conf is exist");
        }

        $result = shell_exec("/usr/bin/php {$realDir}/bin/console.php app:create:supervisor-config -c {$code}");

        if(!file_exists("/etc/supervisor/conf.d/{$code}.conf")){

            $cp = shell_exec("cp {$realDir}/supervisor/conf.d/{$code}.conf /etc/supervisor/conf.d/");

            $worker = shell_exec('sudo /usr/bin/supervisorctl update all ');
        }


        /** @var Response $response */
        return $response->withJson([
            "result"=>$result,
            "cp"=>$cp?:null,
            "worker"=>$worker?:null,
            "code"=>$code
        ]);

    }

}