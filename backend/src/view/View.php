<?php

namespace Tochka\ExchangeRates\view;

/**
 * View
 *
 * отвечает за формирование http ответа
 * на запросы клиента
 *
 */
class View {

    /**
     * getHttpResponse
     *
     * отвечает за фомирование
     * HTTP ответа сервиса
     *
     * @return {string} - тело http ответа
     */
    public static function getHttpResponse($body) {
 
        $string = \json_decode($body, true)['date'];
        $date   = \DateTime::createFromFormat('Ymd H:i', $string.' 00:00');

        $expiresDate = clone $date;
        $expiresDate->modify('+1 day');

   
        self::setExpiresHeader($expiresDate);
        self::setCacheControlHeader($expiresDate);
        self::setLastModifiedHeader($date);
        self::setETagHeader($string);

        return $body;
    }

    private static function setExpiresHeader($date) {

        $httpDate = $date->format('D, d M Y 00:00:00 \G\M\T');

        \header('Expires: '.$httpDate);
    }

    private static function setCacheControlHeader($expiresDate) {

        $maxAge = $expiresDate->getTimestamp() - \time();

        \header('Cache-Control: max-age='.$maxAge.', must-relavidate');
    }

    private static function setLastModifiedHeader($date) {

        $httpDate = $date->format('D, d M Y 00:00:00 \G\M\T');

        \header('Last-Modified: '.$httpDate);

    }

    private static function setETagHeader($eTag) {

        \header('ETag: '.$eTag);
    }
}
?>
