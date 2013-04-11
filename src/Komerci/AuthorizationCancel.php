<?php

namespace Komerci;

/**
 * AuthorizationCancel
 * 
 * Essa operação tem como objetivo cancelar a sensibilização do saldo do cartão do portador
 * utilizando o método VoidPreAuthorization.
 *
 * @author Carlos Cima
 */
class AuthorizationCancel
{
    /**
     * Is Test
     * 
     * @var boolean 
     */
    protected $isTest;

    /**
     * Número de filiação do estabelecimento (fornecedor)
     * 
     * O parâmetro “FILIAÇÃO” deverá conter o nº de filiação do estabelecimento cadastrado com a Redecard.
     * 
     * 9 bytes
     * 
     * @var string
     */
    protected $filiacao;

    /**
     * Distribuidor
     * 
     * Número de filiação do estabelecimento distribuidor ou da empresa compradora (B2B)
     * 
     * O parâmetro “DISTRIBUIDOR” é específico para estabelecimentos que vendem através de distribuidores
     * ou que realizam B2B. Ele deverá conter o nº de filiação do estabelecimento responsável pela transação
     * (distribuidor ou empresa compradora de B2B), cadastrado junto a Redecard. Caso o estabelecimento
     * não pertença aos segmentos citados acima ou caso o próprio fornecedor é que seja o responsável
     * pela transação em questão, basta enviar este parâmetro com valor vazio.
     * 
     * Obs: O distribuidor só pode confirmar as transações de pré-autorização
     * que ele mesmo realizou, em nome e em favor de seu fornecedor.
     * 
     * 9 bytes
     * 
     * @var string 
     */
    protected $distribuidor = '';

    /**
     * Valor total da compra
     * 
     * O parâmetro “TOTAL” deverá conter o valor total da transação.
     * 
     * Obs1: Este valor deverá ser separado por “.” (ponto). Exemplo: 34.60
     * Obs2: Não deve conter separador de milhar
     * Obs3: É obrigatória a existência de duas casas decimais.
     * Obs4: No caso específico de Companhias Aéreas, este parâmetro
     * deverá conter o valor resultante da somatória dos valores das
     * passagens aéreas sem a “Taxa de Embarque”.
     * 
     * 10 bytes
     * 
     * @var string
     */
    protected $total;

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
     * O parâmetro “NUMAUTOR” deverá conter exatamente o mesmo nº de autorização da transação
     * que foi retornado pela Redecard no Passo 1 (Pré-Autorização). Por exemplo: Se foi retornado o nº 012345,
     * o estabelecimento deverá enviar o nº 012345 e não 12345 (suprimindo o valor “0” - zero).
     * 
     * 6 bytes
     * 
     * @var string
     */
    protected $numAutor;

    /**
     * Número do Comprovante de Venda (NSU)
     * 
     * O parâmetro “NUMCV” deverá conter o nº do comprovante de vendas da transação que foi retornado
     * pela Redecard no Passo 1 (Pré-Autorização).
     * 
     * 9 bytes
     * 
     * @var string
     */
    protected $numCv;

    /**
     * Concentrador
     * 
     * O parâmetro “CONCENTRADOR” deverá conter o código do concentrador.
     * 
     * Este dado não está sendo utilizado atualmente. Envie este parâmetro
     * com valor vazio, a menos que receba instrução contrária.
     * 
     * 5 bytes
     * 
     * @var string
     */
    protected $concentrador = '';

    /**
     * Código do usuário Master
     * 
     * O parâmetro “USR” deverá conter um código de usuário cadastrado seguindo
     * as instruções do Anexo B.
     * 
     * 16 bytes
     * 
     * @var string
     */
    protected $usr;

    /**
     * Senha de acesso do usuário Master
     * 
     * O parâmetro “PWD” deverá conter a senha de acesso cadastrado seguindo as instruções do Anexo B.
     * 
     * 20 bytes
     * 
     * @var string
     */
    protected $pwd;

    /**
     * Constructor
     * 
     * @param boolean $isTest
     */
    function __construct($isTest = false)
    {
        $this->isTest = $isTest;
    }

    /**
     * Get Filiacao
     * 
     * Número de filiação do estabelecimento (fornecedor)
     * 
     * O parâmetro “FILIAÇÃO” deverá conter o nº de filiação do estabelecimento cadastrado com a Redecard.
     * 
     * 9 bytes
     * 
     * @return string
     */
    public function getFiliacao()
    {
        return $this->filiacao;
    }

    /**
     * Set Filiacao
     * 
     * Número de filiação do estabelecimento (fornecedor)
     * 
     * O parâmetro “FILIAÇÃO” deverá conter o nº de filiação do estabelecimento cadastrado com a Redecard.
     * 
     * 9 bytes
     * 
     * @param string $filiacao
     * @return \Komerci\AuthorizationCancel
     */
    public function setFiliacao($filiacao)
    {
        $this->filiacao = $filiacao;

        return $this;
    }

    /**
     * Get Distribuidor
     * 
     * Número de filiação do estabelecimento distribuidor ou da empresa compradora (B2B)
     * 
     * O parâmetro “DISTRIBUIDOR” é específico para estabelecimentos que vendem através de distribuidores
     * ou que realizam B2B. Ele deverá conter o nº de filiação do estabelecimento responsável pela transação
     * (distribuidor ou empresa compradora de B2B), cadastrado junto a Redecard. Caso o estabelecimento
     * não pertença aos segmentos citados acima ou caso o próprio fornecedor é que seja o responsável
     * pela transação em questão, basta enviar este parâmetro com valor vazio.
     * 
     * Obs: O distribuidor só pode confirmar as transações de pré-autorização
     * que ele mesmo realizou, em nome e em favor de seu fornecedor.
     * 
     * 9 bytes
     * 
     * @return string
     */
    public function getDistribuidor()
    {
        return $this->distribuidor;
    }

    /**
     * Set Distribuidor
     * 
     * Número de filiação do estabelecimento distribuidor ou da empresa compradora (B2B)
     * 
     * O parâmetro “DISTRIBUIDOR” é específico para estabelecimentos que vendem através de distribuidores
     * ou que realizam B2B. Ele deverá conter o nº de filiação do estabelecimento responsável pela transação
     * (distribuidor ou empresa compradora de B2B), cadastrado junto a Redecard. Caso o estabelecimento
     * não pertença aos segmentos citados acima ou caso o próprio fornecedor é que seja o responsável
     * pela transação em questão, basta enviar este parâmetro com valor vazio.
     * 
     * Obs: O distribuidor só pode confirmar as transações de pré-autorização
     * que ele mesmo realizou, em nome e em favor de seu fornecedor.
     * 
     * 9 bytes
     * 
     * @param string $distribuidor
     * @return \Komerci\AuthorizationCancel
     */
    public function setDistribuidor($distribuidor)
    {
        $this->distribuidor = $distribuidor;

        return $this;
    }

    /**
     * Get Total
     * 
     * O parâmetro “TOTAL” deverá conter o valor total da transação.
     * 
     * Obs1: Este valor deverá ser separado por “.” (ponto). Exemplo: 34.60
     * Obs2: Não deve conter separador de milhar
     * Obs3: É obrigatória a existência de duas casas decimais.
     * Obs4: No caso específico de Companhias Aéreas, este parâmetro
     * deverá conter o valor resultante da somatória dos valores das
     * passagens aéreas sem a “Taxa de Embarque”.
     * 
     * 10 bytes
     * 
     * @return string Valor total da compra
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set Total
     * 
     * O parâmetro “TOTAL” deverá conter o valor total da transação.
     * 
     * Obs1: Este valor deverá ser separado por “.” (ponto). Exemplo: 34.60
     * Obs2: Não deve conter separador de milhar
     * Obs3: É obrigatória a existência de duas casas decimais.
     * Obs4: No caso específico de Companhias Aéreas, este parâmetro
     * deverá conter o valor resultante da somatória dos valores das
     * passagens aéreas sem a “Taxa de Embarque”.
     * 
     * 10 bytes
     * 
     * @param string $total Valor total da compra
     * @return \Komerci\AuthorizationCancel
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
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
     * Set Data
     * 
     * Data da transação
     * 
     * O parâmetro “DATA” retornará a data em que a transação foi autorizada (no formato AAAAMMDD).
     * 
     * 8 bytes
     * 
     * @param string $data Data da transação
     * @return \Komerci\AuthorizationCancel
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get NumAutor
     * 
     * Número de Autorização
     * 
     * O parâmetro “NUMAUTOR” deverá conter exatamente o mesmo nº de autorização da transação
     * que foi retornado pela Redecard no Passo 1 (Pré-Autorização). Por exemplo: Se foi retornado o nº 012345,
     * o estabelecimento deverá enviar o nº 012345 e não 12345 (suprimindo o valor “0” - zero).
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
     * Set NumAutor
     * 
     * Número de Autorização
     * 
     * O parâmetro “NUMAUTOR” deverá conter exatamente o mesmo nº de autorização da transação
     * que foi retornado pela Redecard no Passo 1 (Pré-Autorização). Por exemplo: Se foi retornado o nº 012345,
     * o estabelecimento deverá enviar o nº 012345 e não 12345 (suprimindo o valor “0” - zero).
     * 
     * 6 bytes
     * 
     * @param string $numAutor Número de Autorização
     * @return \Komerci\AuthorizationCancel
     */
    public function setNumAutor($numAutor)
    {
        $this->numAutor = $numAutor;

        return $this;
    }

    /**
     * Get NumCv
     * 
     * Número do Comprovante de Venda (NSU)
     * 
     * O parâmetro “NUMCV” deverá conter o nº do comprovante de vendas da transação que foi retornado
     * pela Redecard no Passo 1 (Pré-Autorização).
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
     * Set NumCv
     * 
     * Número do Comprovante de Venda (NSU)
     * 
     * O parâmetro “NUMCV” deverá conter o nº do comprovante de vendas da transação que foi retornado
     * pela Redecard no Passo 1 (Pré-Autorização).
     * 
     * 9 bytes
     * 
     * @param string $numCv Número do Comprovante de Venda (NSU)
     * @return \Komerci\AuthorizationCancel
     */
    public function setNumCv($numCv)
    {
        $this->numCv = $numCv;

        return $this;
    }

    /**
     * Get Usr
     * 
     * Código do usuário Master
     * 
     * O parâmetro “USR” deverá conter um código de usuário cadastrado seguindo
     * as instruções do Anexo B.
     * 
     * 16 bytes
     * 
     * @return string Código do usuário Master
     */
    public function getUsr()
    {
        return $this->usr;
    }

    /**
     * Set Usr
     * 
     * Código do usuário Master
     * 
     * O parâmetro “USR” deverá conter um código de usuário cadastrado seguindo
     * as instruções do Anexo B.
     * 
     * 16 bytes
     * 
     * @param string $usr Código do usuário Master
     * @return \Komerci\AuthorizationCancel
     */
    public function setUsr($usr)
    {
        $this->usr = $usr;

        return $this;
    }

    /**
     * Get Pwd
     * 
     * Senha de acesso do usuário Master
     * 
     * O parâmetro “PWD” deverá conter a senha de acesso cadastrado seguindo as instruções do Anexo B.
     * 
     * 20 bytes
     * 
     * @return string Senha de acesso do usuário Master
     */
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * Set Pwd
     * 
     * Senha de acesso do usuário Master
     * 
     * O parâmetro “PWD” deverá conter a senha de acesso cadastrado seguindo as instruções do Anexo B.
     * 
     * 20 bytes
     * 
     * @param string $pwd Senha de acesso do usuário Master
     * @return \Komerci\AuthorizationCancel
     */
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;

        return $this;
    }

    /**
     * Get Request Array
     * 
     * @return array
     */
    protected function getRequestArray()
    {
        return array(
            'VoidPreAuthorization' => array(
                'Filiacao' => $this->filiacao,
                'Distribuidor' => $this->distribuidor,
                'Total' => $this->total,
                'Data' => $this->data,
                'NumAutor' => $this->numAutor,
                'NumCV' => $this->numCv,
                'Concentrador' => $this->concentrador,
                'Usr' => $this->usr,
                'Pwd' => $this->pwd
            )
        );
    }

    /**
     * Send Authorization Cancel Request to Komerci SOAP Server
     * 
     * @return \Komerci\AuthorizationCancel
     */
    public function send()
    {
        $xmlResult = Client::SoapRequest('VoidPreAuthorization', $this->getRequestArray(), $this->isTest);
        $authorizationCancelResponse = new AuthorizationCancelResponse();
        $authorizationCancelResponse->setResultXml($xmlResult);

        return $authorizationCancelResponse;
    }

}
