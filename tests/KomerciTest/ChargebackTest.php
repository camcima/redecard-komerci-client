<?php

namespace KomerciTest;

use Komerci\Chargeback;

/**
 * ChargebackTest
 *
 * @author Carlos Cima
 */
class ChargebackTest extends AbstractTest
{
    public function testChargebackCancel() {
        $chargeback = new Chargeback();
        $chargeback->setTotal(10);
        $chargeback->setFiliacao('037916785');
        $chargeback->setNumAutor('123456');
        $chargeback->setNumCv('123456789');
        $chargeback->setUsr('chongas');
        $chargeback->setPwd('mariola');
        $result = $chargeback->send();
    }
}
