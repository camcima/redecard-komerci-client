<?php

namespace Komerci;

use Komerci\AuthorizationResponse;

/**
 * Authorization
 *
 * @author Carlos Cima
 */
class Authorization
{
    /**
     * Modalidades de Pagamento
     */
    const TYPE_A_VISTA = '04';
    const TYPE_PARCELADO_EMISSOR = '06';
    const TYPE_PARCELADO_ESTABELECIMENTO = '08';
    const TYPE_IATA_A_VISTA = '39';
    const TYPE_IATA_PARCELADO = '40';
    const TYPE_PRE_AUTHORIZATION = '73';

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
     * Tipo de Transação
     * 
     * O parâmetro “TRANSAÇÃO” deverá conter o código do tipo de transação
     * a ser processada, de acordo com a tabela a seguir:
     * 
     * Tipo de Transação            => Código
     * =================               ======
     * À vista                      => 04
     * Parcelado Emissor            => 06
     * Parcelado Estabelecimento    => 08
     * IATA à vista                 => 39
     * IATA Parcelado               => 40
     * Pré-Autorização              => 73
     * 
     * 2 bytes
     * 
     * @var string
     */
    protected $transacao;

    /**
     * Número de Parcelas
     * 
     * O parâmetro “PARCELAS” deverá conter o nº de parcelas da transação. Ele deverá ser preenchido
     * com o valor “00” (zero zero) quando o parâmetro “TRANSACAO” for “04” ou “39”, isto é, à vista.
     * 
     * Não é possível efetuar transações parceladas para cartões emitidos fora do Brasil.
     * Trata-se de uma regra dos emissores estrangeiros.
     * 
     * 2 bytes
     * 
     * @var string
     */
    protected $parcelas;

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
     * Número do pedido gerado pelo estabelecimento
     * 
     * O parâmetro “NUMPEDIDO” deverá conter o nº do pedido referência da loja.
     * Este campo poderá ser preenchido de acordo com a política interna do
     * estabelecimento e deve ser “tratado” nos casos de pedidos duplicados pelo próprio
     * sistema do estabelecimento. O sistema da Redecard não valida esse parâmetro.
     * 
     * Não utilizar caracteres especiais (acentuação)
     * Campo Obrigatório
     * 
     * 16 bytes
     * 
     * @var string
     */
    protected $numPedido = '';

    /**
     * Número do cartão
     * 
     * O parâmetro “NRCARTAO” deverá conter o número do cartão de crédito do portador, podendo
     * ser MasterCard, Diners ou Visa. Não são aceitos cartões de Débito.
     * 
     * 16 bytes
     * 
     * @var string
     */
    protected $nrCartao;

    /**
     * CVC2
     * 
     * O parâmetro “CVC2” deverá conter o código de segurança do cartão com três posições numéricas.
     * 
     * 3 bytes
     * 
     * @var string
     */
    protected $cvc2;

    /**
     * Mês da validade do cartão
     * 
     * O parâmetro “MES” deverá conter o mês de validade do cartão do portador com duas posições
     * (FORMATO MM).
     * 
     * 2 bytes
     * 
     * @var string
     */
    protected $mes;

    /**
     * Ano da validade do cartão
     * 
     * O parâmetro “ANO” deverá conter o ano de validade do cartão do portador com duas posições
     * (FORMATO AA).
     * 
     * 2 bytes
     * 
     * @var string
     */
    protected $ano;

    /**
     * Nome do portador
     * 
     * O parâmetro “PORTADOR” deverá conter o nome do portador da forma que foi informado por ele.
     * 
     * 30 bytes
     * 
     * @var string
     */
    protected $portador;

    /**
     * IATA
     * 
     * N/A - Enviar parâmetro com valor vazio
     * 
     * 9 bytes
     * 
     * @var string 
     */
    protected $iata = '';

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
     * TAXAEMBARQUE
     * 
     * N/A - Enviar parâmetro com valor vazio
     * 
     * 10 bytes
     * 
     * @var string
     */
    protected $taxaEmbarque = '';

    /**
     * ENTRADA
     * 
     * N/A - Enviar parâmetro com valor vazio
     * 
     * 10 bytes
     * 
     * @var string
     */
    protected $entrada = '';

    /**
     * NUMDOC1
     * 
     * N/A - Enviar parâmetro com valor vazio
     * 
     * 16 bytes
     * 
     * @var string
     */
    protected $numDoc1 = '';

    /**
     * NUMDOC2
     * 
     * N/A - Enviar parâmetro com valor vazio
     * 
     * 16 bytes
     * 
     * @var string
     */
    protected $numDoc2 = '';

    /**
     * NUMDOC3
     * 
     * N/A - Enviar parâmetro com valor vazio
     * 
     * 16 bytes
     * 
     * @var string
     */
    protected $numDoc3 = '';

    /**
     * NUMDOC4
     * 
     * N/A - Enviar parâmetro com valor vazio
     * 
     * 16 bytes
     * 
     * @var string
     */
    protected $numDoc4 = '';

    /**
     * PAX1
     * 
     * N/A - Enviar parâmetro com valor vazio
     * 
     * 26 bytes
     * 
     * @var string
     */
    protected $pax1 = '';

    /**
     * PAX2
     * 
     * N/A - Enviar parâmetro com valor vazio
     * 
     * 26 bytes
     * 
     * @var string
     */
    protected $pax2 = '';

    /**
     * PAX3
     * 
     * N/A - Enviar parâmetro com valor vazio
     * 
     * 26 bytes
     * 
     * @var string
     */
    protected $pax3 = '';

    /**
     * PAX4
     * 
     * 26 bytes
     * 
     * N/A - Enviar parâmetro com valor vazio
     * 
     * @var string
     */
    protected $pax4 = '';

    /**
     * CONFTXN
     * 
     * Caso este parâmetro não seja preenchido com S, o sistema entende que é necessário
     * fazer uma confirmação manual utilizando o método ConfirmTxn. O estabelecimento
     * tem até 2 minutos para executar esta confirmação manual após a autorização.
     * Mais detalhes no anexo A – “Confirmação Manual”.
     * 
     * 1 byte
     * 
     * @var string
     */
    protected $confTxn = 'S';

    /**
     * ADD_Data
     * 
     * N/A - Enviar parâmetro com valor vazio
     * 
     * @var string
     */
    protected $addData = '';
    
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
     * @param string $total Valor total da compra
     * @return \Komerci\Authorization
     */
    public function setTotal($total)
    {
        $this->total = number_format($total, 2, '.', '');

        return $this;
    }

    /**
     * Get Transacao
     * 
     * Tipo de Transação
     * 
     * O parâmetro “TRANSAÇÃO” deverá conter o código do tipo de transação
     * a ser processada, de acordo com a tabela a seguir:
     * 
     * Tipo de Transação            => Código
     * =================               ======
     * À vista                      => 04
     * Parcelado Emissor            => 06
     * Parcelado Estabelecimento    => 08
     * IATA à vista                 => 39
     * IATA Parcelado               => 40
     * 
     * 2 bytes
     * 
     * @return string Tipo de Transação
     */
    public function getTransacao()
    {
        return $this->transacao;
    }

    /**
     * Set Transacao
     * 
     * Tipo de Transação
     * 
     * O parâmetro “TRANSAÇÃO” deverá conter o código do tipo de transação
     * a ser processada, de acordo com a tabela a seguir:
     * 
     * Tipo de Transação            => Código
     * =================               ======
     * À vista                      => 04
     * Parcelado Emissor            => 06
     * Parcelado Estabelecimento    => 08
     * IATA à vista                 => 39
     * IATA Parcelado               => 40
     * 
     * 2 bytes
     * 
     * @param string $transacao Tipo de Transação
     * @return \Komerci\Authorization
     */
    public function setTransacao($transacao)
    {
        $this->transacao = $transacao;
        if ($transacao == static::TYPE_A_VISTA) {
            $this->parcelas = '00';
        }

        return $this;
    }

    /**
     * Get Parcelas
     * 
     * Número de Parcelas
     * 
     * O parâmetro “PARCELAS” deverá conter o nº de parcelas da transação. Ele deverá ser preenchido
     * com o valor “00” (zero zero) quando o parâmetro “TRANSACAO” for “04” ou “39”, isto é, à vista.
     * 
     * Não é possível efetuar transações parceladas para cartões emitidos fora do Brasil.
     * Trata-se de uma regra dos emissores estrangeiros.
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
     * O parâmetro “PARCELAS” deverá conter o nº de parcelas da transação. Ele deverá ser preenchido
     * com o valor “00” (zero zero) quando o parâmetro “TRANSACAO” for “04” ou “39”, isto é, à vista.
     * 
     * Não é possível efetuar transações parceladas para cartões emitidos fora do Brasil.
     * Trata-se de uma regra dos emissores estrangeiros.
     * 
     * 2 bytes
     * 
     * @param string $parcelas Número de Parcelas
     * @return \Komerci\Authorization
     */
    public function setParcelas($parcelas)
    {
        $this->parcelas = str_pad((int) $parcelas, 2, '0', STR_PAD_LEFT);;

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
     * @return string Número de filiação do estabelecimento (fornecedor)
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
     * @param type $filiacao Número de filiação do estabelecimento (fornecedor)
     * @return \Komerci\Authorization
     */
    public function setFiliacao($filiacao)
    {
        $this->filiacao = $filiacao;

        return $this;
    }

    /**
     * Get NumPedido
     * 
     * Número do pedido gerado pelo estabelecimento
     * 
     * O parâmetro “NUMPEDIDO” deverá conter o nº do pedido referência da loja.
     * Este campo poderá ser preenchido de acordo com a política interna do
     * estabelecimento e deve ser “tratado” nos casos de pedidos duplicados pelo próprio
     * sistema do estabelecimento. O sistema da Redecard não valida esse parâmetro.
     * 
     * Não utilizar caracteres especiais (acentuação)
     * Campo Obrigatório
     * 
     * 16 bytes
     * 
     * @return string Número do pedido gerado pelo estabelecimento
     */
    public function getNumPedido()
    {
        return $this->numPedido;
    }

    /**
     * Set NumPedido
     * 
     * Número do pedido gerado pelo estabelecimento
     * 
     * O parâmetro “NUMPEDIDO” deverá conter o nº do pedido referência da loja.
     * Este campo poderá ser preenchido de acordo com a política interna do
     * estabelecimento e deve ser “tratado” nos casos de pedidos duplicados pelo próprio
     * sistema do estabelecimento. O sistema da Redecard não valida esse parâmetro.
     * 
     * Não utilizar caracteres especiais (acentuação)
     * Campo Obrigatório
     * 
     * 16 bytes
     * 
     * @param type $numPedido Número do pedido gerado pelo estabelecimento
     * @return \Komerci\Authorization
     */
    public function setNumPedido($numPedido)
    {
        $this->numPedido = $numPedido;

        return $this;
    }

    /**
     * Get NrCartao
     * 
     * Número do cartão
     * 
     * O parâmetro “NRCARTAO” deverá conter o número do cartão de crédito do portador, podendo
     * ser MasterCard, Diners ou Visa. Não são aceitos cartões de Débito.
     * 
     * 16 bytes
     * 
     * @return string Número do cartão
     */
    public function getNrCartao()
    {
        return $this->nrCartao;
    }

    /**
     * Set NrCartao
     * 
     * Número do cartão
     * 
     * O parâmetro “NRCARTAO” deverá conter o número do cartão de crédito do portador, podendo
     * ser MasterCard, Diners ou Visa. Não são aceitos cartões de Débito.
     * 
     * 16 bytes
     * 
     * @param string $nrCartao Número do cartão
     * @return \Komerci\Authorization
     */
    public function setNrCartao($nrCartao)
    {
        $this->nrCartao = $nrCartao;

        return $this;
    }

    /**
     * CVC2
     * 
     * O parâmetro “CVC2” deverá conter o código de segurança do cartão com três posições numéricas.
     * 
     * 3 bytes
     * 
     * @return string CVC2
     */
    public function getCvc2()
    {
        return $this->cvc2;
    }

    /**
     * Set CVC2
     * 
     * CVC2
     * 
     * O parâmetro “CVC2” deverá conter o código de segurança do cartão com três posições numéricas.
     * 
     * 3 bytes
     * 
     * @param string $cvc2 CVC2
     * @return \Komerci\Authorization
     */
    public function setCvc2($cvc2)
    {
        $this->cvc2 = $cvc2;

        return $this;
    }

    /**
     * Get Mes
     * 
     * Mês da validade do cartão
     * 
     * O parâmetro “MES” deverá conter o mês de validade do cartão do portador com duas posições
     * (FORMATO MM).
     * 
     * 2 bytes
     * 
     * @return string Mês da validade do cartão
     */
    public function getMes()
    {
        return $this->mes;
    }

    /**
     * Set Mes
     * 
     * Mês da validade do cartão
     * 
     * O parâmetro “MES” deverá conter o mês de validade do cartão do portador com duas posições
     * (FORMATO MM).
     * 
     * 2 bytes
     * 
     * @param string $mes Mês da validade do cartão
     * @return \Komerci\Authorization
     */
    public function setMes($mes)
    {
        $this->mes = str_pad((int) $mes, 2, '0', STR_PAD_LEFT);

        return $this;
    }

    /**
     * Get Ano
     * 
     * Ano da validade do cartão
     * 
     * O parâmetro “ANO” deverá conter o ano de validade do cartão do portador com duas posições
     * (FORMATO AA).
     * 
     * 2 bytes
     * 
     * @return string Ano da validade do cartão
     */
    public function getAno()
    {
        return $this->ano;
    }

    /**
     * Set Ano
     * 
     * Ano da validade do cartão
     * 
     * O parâmetro “ANO” deverá conter o ano de validade do cartão do portador com duas posições
     * (FORMATO AA).
     * 
     * 2 bytes
     * 
     * @param string $ano Ano da validade do cartão
     * @return \Komerci\Authorization
     */
    public function setAno($ano)
    {
        $this->ano = str_pad((int) $ano, 2, '0', STR_PAD_LEFT);

        return $this;
    }

    /**
     * Get Portador
     * 
     * Nome do portador
     * 
     * O parâmetro “PORTADOR” deverá conter o nome do portador da forma que foi informado por ele.
     * 
     * 30 bytes
     * 
     * @return string Nome do portador
     */
    public function getPortador()
    {
        return $this->portador;
    }

    /**
     * Set Portador
     * 
     * Nome do portador
     * 
     * O parâmetro “PORTADOR” deverá conter o nome do portador da forma que foi informado por ele.
     * 
     * 30 bytes
     * 
     * @param string $portador Nome do portador
     * @return \Komerci\Authorization
     */
    public function setPortador($portador)
    {
        $this->portador = $portador;

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
            'GetAuthorized' => array(
                'Total' => $this->total,
                'Transacao' => $this->transacao,
                'Parcelas' => $this->parcelas,
                'Filiacao' => $this->filiacao,
                'NumPedido' => $this->numPedido,
                'Nrcartao' => $this->nrCartao,
                'CVC2' => $this->cvc2,
                'Mes' => $this->mes,
                'Ano' => $this->ano,
                'Portador' => $this->portador,
                'IATA' => $this->iata,
                'Distribuidor' => $this->distribuidor,
                'Concentrador' => $this->concentrador,
                'TaxaEmbarque' => $this->taxaEmbarque,
                'Entrada' => $this->entrada,
                'Pax1' => $this->pax1,
                'Pax2' => $this->pax2,
                'Pax3' => $this->pax3,
                'Pax4' => $this->pax4,
                'Numdoc1' => $this->numDoc1,
                'Numdoc2' => $this->numDoc2,
                'Numdoc3' => $this->numDoc3,
                'Numdoc4' => $this->numDoc4,
                'ConfTxn' => $this->confTxn,
                'Add_Data' => $this->addData
            )
        );
    }

    /**
     * Send Authorization Request to Komerci SOAP Server
     * 
     * @return \Komerci\AuthorizationResponse
     */
    public function send()
    {
        $xmlResult = Client::SoapRequest('GetAuthorized', $this->getRequestArray(), $this->isTest);
        $authorizationResponse = new AuthorizationResponse();
        $authorizationResponse->setResultXml($xmlResult);

        return $authorizationResponse;
    }

}
