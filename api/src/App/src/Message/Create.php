<?php

namespace App\Message;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Psr\Http\Message\ServerRequestInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Zend\Diactoros\Response\JsonResponse;

class Create implements MiddlewareInterface
{
    private $tableGateway;

    public function __construct($tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $data = $request->getParsedBody();
        
        $this->tableGateway->insert($data);
        $content = [
            'id' => $this->tableGateway->getLastInsertValue(),
        ];

        return new JsonResponse($content, 201);
    }
}
