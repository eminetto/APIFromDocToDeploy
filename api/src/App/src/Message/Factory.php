<?php

namespace App\Message;

use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\TableGateway;

class Factory
{
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $config = $container->get('config');
        $adapter = new Adapter($config['db']);
        $tableGateway = new TableGateway('message', $adapter);

        return new $requestedName($tableGateway);
    }
}