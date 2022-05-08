<?php

namespace Unicall;

use League\Csv\CannotInsertRecord;
use League\Csv\Exception;
use Unicall\Helper\Request;
use Unicall\Router\Router;


class Application
{
    public Router $router;
    public Request $request;

    public function __construct() {
        $this->request = new Request();
        $this->router = new Router($this->request);

    }

    public function run() {
        $this->router->resolve();
    }
}