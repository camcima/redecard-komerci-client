<?php

namespace Komerci;

/**
 * Description of CaptureCancel
 * 
 * Essa operação tem como objetivo cancelar uma transação de pré-autorização utilizando o método
 * VoidConfPreAuthorization.
 *
 * Obs1: A operação de estorno só pode ser solicitada no mesmo dia
 * em que a transação de captura foi realizada, isto é, até as 23:59h
 * do horário oficial de Brasília.
 * 
 * Obs2: Este método requer autenticação de Usuário e Senha e validação
 * do cadastramento através do Anexo B: “Gerenciamento de Usuários
 * Webservices”.
 * 
 * @author Carlos Cima
 */
class CaptureCancel
{
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
     * Código do Concentrador
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
     * @return \Komerci\CaptureCancel
     */
    public function setFiliacao($filiacao)
    {
        $this->filiacao = $filiacao;

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
     * @return \Komerci\CaptureCancel
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
     * @return \Komerci\CaptureCancel
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
     * @return \Komerci\CaptureCancel
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
     * @return \Komerci\CaptureCancel
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
     * @return \Komerci\CaptureCancel
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
     * @return \Komerci\CaptureCancel
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
            'VoidConfPreAuthorization' => array(
                'Filiacao' => $this->filiacao,
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
     * @return \Komerci\CaptureCancel
     */
    public function send()
    {
        $xmlResult = Client::SoapRequest('VoidConfPreAuthorization', $this->getRequestArray(), true);
        $captureCancelResponse = new CaptureCancelResponse();
        $captureCancelResponse->setResultXml($xmlResult);

        return $captureCancelResponse;
    }

}
