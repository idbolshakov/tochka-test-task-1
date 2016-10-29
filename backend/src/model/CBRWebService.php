<?php

namespace Tochka\ExchangeRates\model;

/**
 * CBRWebService
 *
 * необходим
 * для взаимодействия с веб сервисом
 * Центробанка
 *
 * @author idbolshakov@gmail.com
 * @version 1.0.0
 */
class CBRWebService {
    
    const WSDL = 'http://www.cbr.ru/DailyInfoWebServ/DailyInfo.asmx?WSDL';

    private $soapClient;

    /**
     * конструктор
     *
     * создаем soap клиент для 
     * доступа к веб сервису Центробанка
     * на основе его WSDL
     */
    public function __construct() {

        $this->soapClient = new \SoapClient(self::WSDL);
    }

    /**
     * GetCursOnDateXML
     *
     * отвечает за получение 
     * ежедневных курсов валют
     * от центробанка
     * в формате XML
     *
     * @param $date {DateTime} - дата на которую будем получать курсы валют
     * @return {string} - xml с курсами валют
     */
    public function getCursOnDateXML($date) {
        
        $params['On_date'] = $date->format('Y-m-d');

        $response = $this->soapClient->GetCursOnDateXML($params);

        return $response->GetCursOnDateXMLResult->any;
    }
};
