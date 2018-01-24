<?php

namespace App\Message;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Psr\Http\Message\ServerRequestInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Zend\Diactoros\Response\JsonResponse;

class Get implements MiddlewareInterface
{
    private $tableGateway;

    public function __construct($tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $id = $request->getAttribute('id_message');
        $content = $this->tableGateway->select(['id' => $id])->toArray();
        if (count($content) == 0) {
            return new JsonResponse($content, 404);
        }

        return new JsonResponse($content);
    }
}
