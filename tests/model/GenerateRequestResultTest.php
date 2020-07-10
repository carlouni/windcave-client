<?php
use Gccm\WindcaveClient\model\GenerateRequestResult;

use PHPUnit\Framework\TestCase;

final class GenerateRequestResultTest extends TestCase
{
    public function testToArray(): void
    {
        $paymentUrl = 'https://sec.paymentexpress.com/pxmi3/EF4054F622D6C4C1B4F9AEA59DC91CAD3654CD60ED7ED04110CBC402959AC7CF035878AEB85D87223';
        $xmlResult = <<<EOT
        <Request valid="1">
        <URI>$paymentUrl</URI>
        </Request>
EOT;

        $result = new GenerateRequestResult();
        $result->setXml($xmlResult);
        $resultArray = $result->toArray();
        $this->assertEquals($paymentUrl, $resultArray['URI']);
    }
}
