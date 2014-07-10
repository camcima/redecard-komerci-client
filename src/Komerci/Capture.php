<?php

namespace Komerci;

/**
 * Capture
 * 
 * Realizar a confirmação do passo1 da transação de pré-autorização para que esta possa ser faturada.
 * O estabelecimento tem até 30 dias para realizar este passo.
 * Este método requer autenticação de Usuário e Senha e validação
 * do cadastramento através do Anexo B: “Gerenciamento de Usuários
 * Webservices”.
 *
 * @author Carlos Cima
 */
class Capture
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
     * DISTRIBUIDOR
     * 
     * N/A - Enviar parâmetro com valor vazio
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
     * Número de Parcelas
     * 
     * O parâmetro “PARCELAS” deverá conter o nº de parcelas da transação no formato “99”. A decisão
     * sobre o parcelamento ou não da transação é tomada neste momento de confirmação, e não
     * na solicitação de captura de pré-autorização (Passo 1). Para efetuar transações à vista, o parâmetro
     * “PARCELAS” deverá ser preenchido com o valor “00” (zero zero).
     * 
     * 2 bytes
     * 
     * @var string
     */
    protected $parcelas;

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
     * @return \Komerci\Capture
     */
    public function setFiliacao($filiacao)
    {
        $this->filiacao = $filiacao;

        return $this;
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
     * @return \Komerci\Capture
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get Parcelas
     * 
     * Número de Parcelas
     * 
     * O parâmetro “PARCELAS” deverá conter o nº de parcelas da transação no formato “99”. A decisão
     * sobre o parcelamento ou não da transação é tomada neste momento de confirmação, e não
     * na solicitação de captura de pré-autorização (Passo 1). Para efetuar transações à vista, o parâmetro
     * “PARCELAS” deverá ser preenchido com o valor “00” (zero zero).
     * 
     * 2 bytes
     * 
     * @return string Número de Parcelas
     */
    public function getParcelas()
    {
        return $this->parcelas;
    }

    /**
     * Set Parcelas
     * 
     * Número de Parcelas
     * 
     * O parâmetro “PARCELAS” deverá conter o nº de parcelas da transação no formato “99”. A decisão
     * sobre o parcelamento ou não da transação é tomada neste momento de confirmação, e não
     * na solicitação de captura de pré-autorização (Passo 1). Para efetuar transações à vista, o parâmetro
     * “PARCELAS” deverá ser preenchido com o valor “00” (zero zero).
     * 
     * 2 bytes
     * 
     * @param string $parcelas Número de Parcelas
     * @return \Komerci\Capture
     */
    public function setParcelas($parcelas)
    {
        $this->parcelas = $parcelas;

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
     * @return \Komerci\Capture
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
     * @return \Komerci\Capture
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
     * @return \Komerci\Capture
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
     * @return \Komerci\Capture
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
     * @return \Komerci\Capture
     */
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;

        return $this;
    }

    /**
     * @param boolean $isTest
     */
    public function setIsTest($isTest)
    {
        $this->isTest = $isTest;
    }

    /**
     * @return boolean
     */
    public function getIsTest()
    {
        return $this->isTest;
    }

    /**
     * Get Request Array
     * 
     * @return array
     */
    protected function getRequestArray()
    {
        return array(
            'ConfPreAuthorization' => array(
                'Filiacao' => $this->filiacao,
                'Distribuidor' => $this->distribuidor,
                'Total' => $this->total,
                'Parcelas' => $this->parcelas,
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
     * Send Capture Request to Komerci SOAP Server
     * 
     * @return \Komerci\CaptureResponse
     */
    public function send()
    {
        $xmlResult = Client::SoapRequest('ConfPreAuthorization', $this->getRequestArray(), $this->isTest);
        $captureResponse = new CaptureResponse();
        $captureResponse->setResultXml($xmlResult);

        return $captureResponse;
    }

}