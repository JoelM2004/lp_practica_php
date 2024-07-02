<?php

namespace app\core\middleware\base;
use app\libs\request\Request;
use app\libs\response\Response;

interface MiddlewareInterface{

    public function handler(Request $request, Response $response): void;

    public function setNext(MiddlewareInterface $next): void;

    public function next(Request $request, Response $response): void;

}