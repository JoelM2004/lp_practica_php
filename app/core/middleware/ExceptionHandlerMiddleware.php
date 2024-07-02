<?php

namespace app\core\middleware;

use app\core\middleware\base\Middleware;
use app\core\middleware\base\MiddlewareInterface;
use app\libs\request\Request;
use app\libs\response\Response;

final class ExceptionHandlerMiddleware extends Middleware implements MiddlewareInterface{

    public function handler(Request $request, Response $response): void{
        try{
            $this->next($request, $response);
        }
        catch(\Exception $ex){
            $response->setError($ex->getMessage());
            $response->send();
        }
    }

}