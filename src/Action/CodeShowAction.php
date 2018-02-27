<?php
/**
 * Created by PhpStorm.
 * User: ycy
 * Date: 2/27/18
 * Time: 4:50 PM
 */

namespace Action;


use Contract\Container;
use Doctrine\ODM\MongoDB\DocumentManager;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer;

class CodeShowAction implements ActionInterface
{
    /**
     * @var DocumentManager
     */
    private $dm;
    /**
     * @var PhpRenderer
     */
    private $view;
    /**
     * @var Logger
     */
    private $logger;

    public function __construct(ContainerInterface $container)
    {
        $this->dm = $container[Container::NAME_DATA_MANAGER];
        $this->view = $container[Container::NAME_VIEW];
        $this->logger = $container[Container::NAME_LOGGER];
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        return $this->view->render($response,'index.phtml');
    }

}