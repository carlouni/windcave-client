<?php
use Gccm\WindcaveClient\SocketHttpClient;
use Gccm\WindcaveClient\model\GenerateRequestTransaction;
use Gccm\WindcaveClient\model\GenerateRequestResult;

use PHPUnit\Framework\TestCase;

final class SocketHttpClientTest extends TestCase
{
    public function testSubmitXml(): void
    {
        $socketHttpClient = new SocketHttpClient('https://sec.paymentexpress.com/pxaccess/pxpay.aspx');
        $generateRequest = new GenerateRequestTransaction();
        $generateRequest->setData([
            'PxPayUserId' => 'SampleUserId',
            'PxPayKey' => '17ce70a6025d8b925373066d3f71704a1868ea30a8d0485b6d086f722fdd9997',
            'MerchantReference' => 'Auth Example',
            'TxnType' => 'Auth',
            'AmountInput' => '1.00',
            'CurrencyInput' => 'NZD',
            'TxnData1' => 'John Doe',
            'TxnData2' => '0211111111',
            'TxnData3' => '98 Anzac Ave, Auckland 1010',
            'EmailAddress' => 'SampleUserId@paymentexpress.com',
            'TxnId' => uniqid(),
            'UrlSuccess' => 'https://demo.paymentexpress.com/SandboxSuccess.aspx',
            'UrlFail' => 'https://demo.paymentexpress.com/SandboxSuccess.aspx',
        ]);
        $xml = $socketHttpClient->submitXml($generateRequest->toXml());
        $result = new GenerateRequestResult();
        $result->setXml($xml);
        $resultArray = $result->toArray();
        $this->assertEquals($resultArray['ResponseText'], 'Invalid Access Info');
    }

    
    
}