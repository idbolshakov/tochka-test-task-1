<?php

namespace Tochka\ExchangeRates\model;

/**
 * ExchangeRates  
 *
 * основной класс модели 
 * сервиса ExchangeRates
 *
 * @author idbolshakov@gmail.com
 * @version 1.0.0
 */
class ExchangeRates {

    const CACHE_DIR = 'cache/';

    private $date;
    private $filename;
    private $jsonData;

    /**
     * run
     *
     * получаем текущую дату. 
     * Проверяем есть ли данные 
     * для этой даты в кэше.
     *
     * Если нету, то делаем запрос
     * на веб сервис Центробанка, 
     * парсим нужные валюты в кэш
     *
     * сохраняем json из кэша
     * в свойство $this->jsonData
     *
     * @return {string} - json с информацией о курсах валют
     */
    public function run() {

        $this->date     = new \DateTime('now');
        $this->filename = self::CACHE_DIR . '/' . $this->date->format('Ymd');

        if ( !$this->isCacheExists() ) {

           $this->writeToCache();
        }

        $this->jsonData = \file_get_contents($this->filename);
    }

    private function isCacheExists() {

        return \file_exists(self::CACHE_DIR) && \file_exists($this->filename);
    }

    private function writeToCache() {

        $cbr    = new CBRWebService();
        $xml    = $cbr->getCursOnDateXML( new \DateTime('now') );
        $parser = new Parser($xml);

        if (!\file_exists(self::CACHE_DIR)) {

            \mkdir(self::CACHE_DIR);
            \chmod(self::CACHE_DIR, 0777);
        }

        \file_put_contents($this->filename, $parser->parse());
        \chmod($this->filename, 0777);
    }

    /**
     * getJsonData
     *
     * @return {string} - json с информацией о курсах валют
     */
    public function getJsonData() {

        return $this->jsonData;
    }
}

?>
