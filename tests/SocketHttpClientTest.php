<?php
use Gccm\WindcaveClient\SocketHttpClient;
use Gccm\WindcaveClient\model\GenerateRequestTransaction;

use PHPUnit\Framework\TestCase;

final class SocketHttpClientTest extends TestCase
{
    public function testSubmitXml(): void
    {
        $socketHttpClient = new SocketHttpClient('https://sec.paymentexpress.com/pxaccess/pxpay.aspx');
        $generateRequest = new GenerateRequestTransaction();
        $generateRequest->setData([
            'PxPayUserId' => 'SampleUserId',
            'PxPayKey' => 'abcdef1234567890abcdef1234567890abcdef1234567890abcdef1234567890',
            'MerchantReference' => 'Auth Example',
            'TxnType' => 'Auth',
            'AmountInput' => '1.00',
            'CurrencyInput' => 'NZD',
            'TxnData1' => 'John Doe',
            'TxnData2' => '0211111111',
            'TxnData3' => '98 Anzac Ave, Auckland 1010',
            'EmailAddress' => 'SampleUserId@paymentexpress.com',
            'TxnId' => 'P03E890575E9D4A2',
            'UrlSuccess' => 'https://demo.paymentexpress.com/SandboxSuccess.aspx',
            'UrlFail' => 'https://demo.paymentexpress.com/SandboxSuccess.aspx',
        ]);
        $result = $socketHttpClient->submitXml($generateRequest);
        echo $result;
    }

    
    
}