<?php

namespace Komerci;

/**
 * AuthorizationResponse
 *
 * @author Carlos Cima
 */
class AuthorizationResponse
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
     * 160 bytes
     * 
     * @var string
     */
    protected $msgRet;

    /**
     * Número do Pedido
     * 
     * O parâmetro “NUMPEDIDO” retornará o nº do pedido que foi informado pelo estabelecimento
     * na chamada da operação. O sistema da Redecard não fará consistência deste parâmetro.
     * 
     * 16 bytes
     * 
     * @var string
     */
    protected $numPedido;

    /**
     * Data da transação
     * 
     * O parâmetro “DATA” retornará a data em que a transação foi autorizada (no formato AAAAMMDD).
     * 
     * 8 bytes
     * 
     * @var string
     */
    protected $data;

    /**
     * Número de Autorização
     * 
     * O parâmetro “NUMAUTOR” retornará o nº de autorização da transação.
     * 
     * 6 bytes
     * 
     * @var string
     */
    protected $numAutor;

    /**
     * Número do Comprovante de Venda (NSU)
     * 
     * O parâmetro “NUMCV” retornará o nº do comprovante de vendas da transação.
     * 
     * 9 bytes
     * 
     * @var string
     */
    protected $numCv;

    /**
     * Número de Autenticação
     * 
     * O parâmetro “NUMAUTENT” retornará o nº de autenticação da transação.
     * 
     * 27 bytes
     * 
     * @var string
     */
    protected $numAutent;

    /**
     * Número seqüencial único
     * 
     * O parâmetro “NUMSQN” retornará o número seqüencial único da transação.
     * 
     * 12 bytes
     * 
     * @var string
     */
    protected $numSqn;

    /**
     * Código do país emissor
     * 
     * O parâmetro “ORIGEM_BIN” retornará o código de nacionalidade do emissor do cartão validado.
     * O estabelecimento poderá optar por rejeitar transações de emissores estrangeiros (emitidos fora
     * do Brasil) através do tratamento deste parâmetro. Nos casos de bandeiras: Mastercard e Diners,
     * este parâmetro é retornado com o padrão de três caracteres para designar o país emissor
     * (Exemplo: BRA para Brasil). Na situação de bandeira Visa, este parâmetro é retornado com o padrão
     * de dois caracteres para designar o país emissor (Exemplo: BR para Brasil).
     * 
     * Obs: O estabelecimento poderá optar por rejeitar transações de emissores
     *      estrangeiros através do tratamento deste parâmetro.
     * 
     * Obs2: Caso o estabelecimento opte por aceitar cartões emitidos no exterior, deverá
     *       sempre analisar ou monitorar a solicitação antes de confirmar a transação.
     * 
     * 3 bytes
     * 
     * @var string
     */
    protected $origemBin;

    /**
     * Código de retorno da confirmação automática
     * 
     * O parâmetro “CONFCODRET” devolverá o código de retorno da confirmação da transação.
     * 
     * Obs: Caso tenha optado por confirmação manual ou a transação não seja
     * aprovada, este campo não será retornado.
     * 
     * 2 bytes
     * 
     * @var string 
     */
    protected $confCodRet;

    /**
     * Descrição do código de retorno
     * 
     * O parâmetro “CONFMSGRET” devolverá a mensagem de retorno da confirmação
     * da transação.
     * 
     * Obs: Caso tenha optado por confirmação manual ou a transação
     * não seja aprovada, este campo não será retornado.
     * 
     * 160 bytes
     * 
     * @var string
     */
    protected $confMsgRet;

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
     * O parâmetro “CODRET” retornará o código de erro se houver algum problema no processamento
     * da transação ou se o emissor não autorizá-la por qualquer motivo. Vide tabela “Código de Erro para
     * Autorização”. Este código é devolvido apenas para transações não autorizadas.
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
     * O parâmetro “MSGRET” retornará a mensagem de erro correspondente ao código de erro
     * “CODRET” se houver algum problema no processamento da transação ou se o emissor não autorizá-la
     * por qualquer motivo. Vide tabela “Código de Erro para Autorização”.
     * 
     * 160 bytes
     * 
     * @return string Descrição do código de retorno
     */
    public function getMsgRet()
    {
        return $this->msgRet;
    }

    /**
     * Get NumPedido
     * 
     * Número do Pedido
     * 
     * O parâmetro “NUMPEDIDO” retornará o nº do pedido que foi informado pelo estabelecimento
     * na chamada da operação. O sistema da Redecard não fará consistência deste parâmetro.
     * 
     * 16 bytes
     * 
     * @return string Número do Pedido
     */
    public function getNumPedido()
    {
        return $this->numPedido;
    }

    /**
     * Get Data
     * 
     * Data da transação
     * 
     * O parâmetro “DATA” retornará a data em que a transação foi autorizada (no formato AAAAMMDD).
     * 
     * 8 bytes
     * 
     * @return string Data da transação
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Get NumAutor
     * 
     * Número de Autorização
     * 
     * O parâmetro “NUMAUTOR” retornará o nº de autorização da transação.
     * 
     * 6 bytes
     * 
     * @return string Número de Autorização
     */
    public function getNumAutor()
    {
        return $this->numAutor;
    }

    /**
     * Get NumCv
     * 
     * Número do Comprovante de Venda (NSU)
     * 
     * O parâmetro “NUMCV” retornará o nº do comprovante de vendas da transação.
     * 
     * 9 bytes
     * 
     * @return string Número do Comprovante de Venda (NSU)
     */
    public function getNumCv()
    {
        return $this->numCv;
    }

    /**
     * Get NumAutent
     * 
     * Número de Autenticação
     * 
     * O parâmetro “NUMAUTENT” retornará o nº de autenticação da transação.
     * 
     * 27 bytes
     * 
     * @return string Número de Autenticação
     */
    public function getNumAutent()
    {
        return $this->numAutent;
    }

    /**
     * Get NumSqn
     * 
     * Número seqüencial único
     * 
     * O parâmetro “NUMSQN” retornará o número seqüencial único da transação.
     * 
     * 12 bytes
     * 
     * @return string Número seqüencial único
     */
    public function getNumSqn()
    {
        return $this->numSqn;
    }

    /**
     * Get OrigemBin
     * 
     * Código do país emissor
     * 
     * O parâmetro “ORIGEM_BIN” retornará o código de nacionalidade do emissor do cartão validado.
     * O estabelecimento poderá optar por rejeitar transações de emissores estrangeiros (emitidos fora
     * do Brasil) através do tratamento deste parâmetro. Nos casos de bandeiras: Mastercard e Diners,
     * este parâmetro é retornado com o padrão de três caracteres para designar o país emissor
     * (Exemplo: BRA para Brasil). Na situação de bandeira Visa, este parâmetro é retornado com o padrão
     * de dois caracteres para designar o país emissor (Exemplo: BR para Brasil).
     * 
     * Obs: O estabelecimento poderá optar por rejeitar transações de emissores
     *      estrangeiros através do tratamento deste parâmetro.
     * 
     * Obs2: Caso o estabelecimento opte por aceitar cartões emitidos no exterior, deverá
     *       sempre analisar ou monitorar a solicitação antes de confirmar a transação.
     * 
     * 3 bytes
     * 
     * @return string Código do país emissor
     */
    public function getOrigemBin()
    {
        return $this->origemBin;
    }

    /**
     * Get ConfCodRet
     * 
     * Código de retorno da confirmação automática
     * 
     * O parâmetro “CONFCODRET” devolverá o código de retorno da confirmação da transação.
     * 
     * Obs: Caso tenha optado por confirmação manual ou a transação não seja
     * aprovada, este campo não será retornado.
     * 
     * 2 bytes
     * 
     * @return string Código de retorno da confirmação automática
     */
    public function getConfCodRet()
    {
        return $this->confCodRet;
    }

    /**
     * Get ConfMsgRet
     * 
     * Descrição do código de retorno
     * 
     * O parâmetro “CONFMSGRET” devolverá a mensagem de retorno da confirmação
     * da transação.
     * 
     * Obs: Caso tenha optado por confirmação manual ou a transação
     * não seja aprovada, este campo não será retornado.
     * 
     * 160 bytes
     * 
     * @return string Descrição do código de retorno
     */
    public function getConfMsgRet()
    {
        return $this->confMsgRet;
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
     * Is Authorization Approved?
     * 
     * Assuma uma transação como APROVADA somente quando o parâmetro
     * CODRET estiver zerado (0) e o parâmetro NUMCV estiver diferente de vazio.
     * Em qualquer outra situação, a transação NÂO está APROVADA.
     * 
     * @return boolean Is Authorization Approved?
     */
    public function isApproved()
    {
        if ($this->codRet == '00' && !empty($this->numCv)) {
            return true;
        }

        return false;
    }

    /**
     * Set Authorization Result XML
     * 
     * @param string $xmlResult Authorization Result XML
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
        foreach ($simpleXml->children() as $childName => $childValue) {
            switch (strtoupper($childName)):
                case 'CODRET':
                    $this->codRet = $childValue;
                    break;
                case 'MSGRET':
                    $this->msgRet = $childValue;
                    break;
                case 'NUMPEDIDO':
                    $this->numPedido = $childValue;
                    break;
                case 'DATA':
                    $this->data = $childValue;
                    break;
                case 'NUMAUTOR':
                    $this->numAutor = $childValue;
                    break;
                case 'NUMCV':
                    $this->numCv = $childValue;
                    break;
                case 'NUMAUTENT':
                    $this->numAutent = $childValue;
                    break;
                case 'NUMSQN':
                    $this->numSqn = $childValue;
                    break;
                case 'ORIGEM_BIN':
                    $this->origemBin = $childValue;
                    break;
            endswitch;
        }
    }

}
