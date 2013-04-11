<?php

namespace KomerciTest;

use Komerci\AuthorizationCancel;

/**
 * AuthorizationCancelTest
 *
 * @author Carlos Cima
 */
class AuthorizationCancelTest extends AbstractTest
{
    public function testAuthorizationCancel() {
        $cancel = new AuthorizationCancel();
        $cancel->setFiliacao('037916785');
        $cancel->setTotal(10);
        $cancel->setData('20130116');
        $cancel->setNumAutor('123456');
        $cancel->setNumCv('123456789');
        $cancel->setUsr('chongas');
        $cancel->setPwd('mariola');
        $result = $cancel->send();
    }
}
