<?php

namespace KomerciTest;

use Komerci\Capture;

/**
 * CaptureTest
 *
 * @author Carlos Cima
 */
class CaptureTest extends AbstractTest
{
    public function testCapture()
    {
        $capture = new Capture();
        $capture->setFiliacao('037916785');
        $capture->setTotal(10);
        $capture->setParcelas('00');
        $capture->setData('20130116');
        $capture->setNumAutor('123456');
        $capture->setNumCv('123456789');
        $capture->setUsr('chongas');
        $capture->setPwd('mariola');
        $result = $capture->send();

        $this->assertInstanceOf('\Komerci\CaptureResponse', $result);
    }

}
