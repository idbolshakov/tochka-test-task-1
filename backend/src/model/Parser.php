<?php

namespace Tochka\ExchangeRates\model;

/**
 * Parser
 *
 * отвечает за парсинг
 * курса евро и доллара 
 * к рублю из xml с курсами 
 * валют от центробанка
 *
 * @author idbolshakov@gmail.com
 * @version 1.0.0
 */
class Parser {

    const USD_CODE = 840;
    const EUR_CODE = 978;

    private $xmlData;
    private $result = array();

    /**
     * конструктор
     *
     * создаем экземпляр
     * SimpleXMLElement класса
     * из строки с xml, в котором
     * находятся курсы валют от Центробанка
     *
     * @param $xml {string} - курсы валют от Центробанка в xml
     */
    public function __construct($xml) {

        $this->xmlData = new \SimpleXMLElement($xml);
    }

    /**
     * parse
     *
     * парсит курсы доллара и евро из xml
     * и возвращает их в json-формате
     *
     * @return {string} - json с курсом доллара и евро
     *
     * формат json:
     *
     * {
     *   date: YYYYmmdd, - дата на которую актуальны курсы
     *
     *   USD: {float},   - курс доллара по отношению к 1 рублю
     *
     *   EUR: {float}    - курс евро по отношению к 1 рублю
     * }
     */
    public function parse() {


        $this->result['date'] = $this->parseDate();

        $this->result['USD']  = $this->parseExchangeRate(self::USD_CODE);
        $this->result['EUR']  = $this->parseExchangeRate(self::EUR_CODE);

        return \json_encode($this->result);
    }

    private function parseDate() {

        return (string) $this->xmlData->attributes()->{'OnDate'};
    }

    private function parseExchangeRate($code) {

        $xml = $this->xmlData;

        foreach ($xml->ValuteCursOnDate as $valute) {

            if ((int) $valute->Vcode === $code) {

                return (float) $valute->Vcurs / (float) $valute->Vnom;
            }
        }

        return null;
    }
}
?>
