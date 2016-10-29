<?php

namespace Tochka\ExchangeRates\controller;

use Tochka\ExchangeRates\model\ExchangeRates;
use Tochka\ExchangeRates\view\View;

/**
 * GETController
 *
 * контроллер, который 
 * вызывается, когда 
 * к сервису 
 * пришел GET запрос
 *
 */
class GETController {

    public function execute() {

        $model = new ExchangeRates();
        $model->run();

        $body  = $model->getJsonData();

        return View::getHttpResponse($body);
    }
}
?>
