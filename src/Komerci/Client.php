<?php

namespace Komerci;

/**
 * Client
 *
 * @author Carlos Cima
 */
class Client
{
    const WSDL_URL = 'https://ecommerce.redecard.com.br/pos_virtual/wskomerci/cap.asmx?WSDL';
    
    public static function SoapRequest($methodName, array $parameters, $debug = false, $wsdlUrl = self::WSDL_URL) {
        $soapParams = array();
        if ($debug) {
            $soapParams['trace'] = 1;
        }
        $soapClient = new \SoapClient($wsdlUrl, $soapParams);
        $soapResult = $soapClient->__soapCall($methodName, $parameters);
        if ($debug) {
            var_dump($soapClient->__getLastRequest());
        }
        $resultNodeName = $methodName . 'Result';
        $xmlResult = $soapResult->$resultNodeName->any;
        
        return $xmlResult;
    }
}
