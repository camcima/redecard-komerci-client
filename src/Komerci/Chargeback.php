<?php

namespace Komerci;

/**
 * Chargeback
 * 
 * Para realizar o estorno de uma transação é necessário utilizar o método VoidTransaction
 *
 * @author Carlos Cima
 */
class Chargeback
{
    /**
     * Is Test
     * 
     * @var boolean 
     */
    protected $isTest;

    /**
     * Valor total da compra
     * 
     * O parâmetro “TOTAL” deverá conter o valor total da transação.
     * Este valor deverá ser separado por “.” (ponto). Exemplo: 34.60
     * Não deve conter separador de milhar
     * É obrigatória a existência de duas casas decimais.
     * 
     * 10 bytes
     * 
     * @var string
     */
    protected $total;

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
     * CONCENTRADOR
     * 
     * N/A - Enviar parâmetro com valor vazio
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
     * Get Total
     * 
     * Valor total da compra
     * 
     * O parâmetro “TOTAL” deverá conter o valor total da transação.
     * Este valor deverá ser separado por “.” (ponto). Exemplo: 34.60
     * Não deve conter separador de milhar
     * É obrigatória a existência de duas casas decimais.
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
     * Valor total da compra
     * 
     * O parâmetro “TOTAL” deverá conter o valor total da transação.
     * Este valor deverá ser separado por “.” (ponto). Exemplo: 34.60
     * Não deve conter separador de milhar
     * É obrigatória a existência de duas casas decimais.
     * 
     * 10 bytes
     * 
     * @param string $total Valor total da compra
     * @return \Komerci\Chargeback
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
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
     * @return \Komerci\Chargeback
     */
    public function setFiliacao($filiacao)
    {
        $this->filiacao = $filiacao;

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
     * @return \Komerci\Chargeback
     */
    public function setNumCv($numCv)
    {
        $this->numCv = $numCv;

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
     * @return \Komerci\Chargeback
     */
    public function setNumAutor($numAutor)
    {
        $this->numAutor = $numAutor;

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
     * @return \Komerci\Chargeback
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
     * @return \Komerci\Chargeback
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
            'VoidTransaction' => array(
                'Total' => $this->total,
                'Filiacao' => $this->filiacao,
                'NumCV' => $this->numCv,
                'NumAutor' => $this->numAutor,
                'Concentrador' => $this->concentrador,
                'Usr' => $this->usr,
                'Pwd' => $this->pwd
            )
        );
    }

    /**
     * Send Capture Request to Komerci SOAP Server
     * 
     * @return \Komerci\ChargebackResponse
     */
    public function send()
    {
        $xmlResult = Client::SoapRequest('VoidTransaction', $this->getRequestArray(), $this->isTest);
        $chargebackResponse = new ChargebackResponse();
        $chargebackResponse->setResultXml($xmlResult);

        return $chargebackResponse;
    }

}