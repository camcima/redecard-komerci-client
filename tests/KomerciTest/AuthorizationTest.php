<?php

namespace KomerciTest;

use Komerci\Authorization;

/**
 * AuthorizationTest
 *
 * @author Carlos Cima
 */
class AuthorizationTest extends AbstractTest
{
    public function testAuthorization() {
        $auth = new Authorization();
        $auth->setTotal('1000');
        $auth->setNrCartao('5555666677778884');
        $auth->setMes('4');
        $auth->setAno('16');
        $auth->setCvc2('555');
        $auth->setTransacao(Authorization::TYPE_A_VISTA);
        $auth->setFiliacao('037916785');
        $auth->setPortador('CHONGAS MARIOLA');
        $auth->setNumPedido('0001');
        $result = $auth->send();
        var_dump($result);
    }
}
