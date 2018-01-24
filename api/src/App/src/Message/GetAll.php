<?php

namespace App\Message;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Psr\Http\Message\ServerRequestInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Zend\Diactoros\Response\JsonResponse;

class GetAll implements MiddlewareInterface
{
    private $tableGateway;

    public function __construct($tableGateway) 
    {
        $this->tableGateway = $tableGateway;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $content = $this->tableGateway->select()->toArray();

        return new JsonResponse($content);
    }
}
