<?php

namespace Komerci;

/**
 * KomerciSoapClient
 *
 * @author ccima
 */
class KomerciSoapClient extends \SoapClient
{
    protected $request;

    public function __getLastRequest()
    {
        return $this->request;
    }

    /**
     * Change default SoapClient XML to conform with Komerci expected format
     * 
     * @param string $request
     * @param string $location
     * @param string $action
     * @param int $version
     * 
     * @return string
     */
    function __doRequest($request, $location, $action, $version)
    {
        $actionName = substr($action, strrpos($action, '/') + 1);

        $request = preg_replace('/<SOAP\-ENV:Envelope.+">/',
            '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">',
            $request);
        $request = preg_replace('/SOAP\-ENV/', 'soap', $request);
        $request = preg_replace('/<ns1:(\w+)/', '<$1', $request);
        $request = preg_replace('/<\/ns1:(\w+)/', '</$1', $request);
        $request = preg_replace('/<' . $actionName . '/', '<' . $actionName . ' xmlns="http://ecommerce.redecard.com.br"', $request);

        $this->request = $request;
        return parent::__doRequest($request, $location, $action, $version);
    }

}
