<?php

include 'src/includes.php';

use Tochka\EXchangeRates\Controller\GETController;

if ( 'GET' === $_SERVER['REQUEST_METHOD'] ) {

    $controller = new GETController();

    echo $controller->execute();
}

?>
