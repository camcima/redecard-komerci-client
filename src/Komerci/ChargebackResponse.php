<?php

namespace Komerci;

/**
 * ChargebackResponse
 *
 * @author Carlos Cima
 */
class ChargebackResponse
{
    /**
     * Código de retorno
     * 
     * O parâmetro “CODRET” retornará o código de erro se houver algum problema no processamento
     * da transação ou se o emissor não autorizá-la por qualquer motivo. Vide tabela “Código de Erro para
     * Autorização”. Este código é devolvido apenas para transações não autorizadas.
     * 
     * 2 bytes
     * 
     * @var string
     */
    protected $codRet;

    /**
     * Descrição do código de retorno
     * 
     * O parâmetro “MSGRET” retornará a mensagem de erro correspondente ao código de erro
     * “CODRET” se houver algum problema no processamento da transação ou se o emissor não autorizá-la
     * por qualquer motivo. Vide tabela “Código de Erro para Autorização”.
     * 
     * 250 bytes
     * 
     * @var string
     */
    protected $msgRet;

    /**
     * Raw XML Response
     * 
     * @var string
     */
    protected $rawResponse;

    /**
     * Get CodRet
     * 
     * Código de retorno
     * 
     * O parâmetro “CODRET” retornará um código referente ao status da solicitação. Caso o estorno
     * tenha sido concretizado com sucesso, o valor retornado neste parâmetro será “0” (zero). Caso contrário,
     * isto é, se o estorno não for concretizado por qualquer motivo, o webservices retornará um código
     * de erro. Vide tópico “Tabela de Erros em Parametrização”.
     * 
     * 2 bytes
     * 
     * @return string Código de retorno
     */
    public function getCodRet()
    {
        return $this->codRet;
    }

    /**
     * Get MsgRet
     * 
     * Descrição do código de retorno
     * 
     * O parâmetro “MSGRET” retornará a mensagem de status da solicitação correspondente ao código
     * retornado no parâmetro “CODRET”.
     * 
     * 250 bytes
     * 
     * @return string Descrição do código de retorno
     */
    public function getMsgRet()
    {
        return $this->msgRet;
    }

    /**
     * Get RawResponse
     * 
     * @return string XML Response
     */
    public function getRawResponse()
    {
        return $this->rawResponse;
    }

    /**
     * Is Transaction Canceled?
     * 
     * @return boolean Is Transaction Canceled?
     */
    public function isCanceled()
    {
        if ($this->codRet == '00') {
            return true;
        }

        return false;
    }

    /**
     * Set Chargeback Cancel Result XML
     * 
     * @param string $xmlResult Chargeback Cancel Result XML
     */
    public function setResultXml($xmlResult)
    {
        $this->rawResponse = $xmlResult;
        $this->parseResponseXml();
    }

    /**
     * Parse Response XML
     */
    protected function parseResponseXml()
    {
        $simpleXml = simplexml_load_string($this->rawResponse);
        foreach ($simpleXml->root->children() as $childName => $childValue) {
            switch (strtoupper($childName)):
                case 'CODRET':
                    $this->codRet = $childValue;
                    break;
                case 'MSGRET':
                    $this->msgRet = $childValue;
                    break;
            endswitch;
        }
    }

}
