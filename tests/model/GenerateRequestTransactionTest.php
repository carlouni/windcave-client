<?php
use Gccm\WindcaveClient\model\GenerateRequestTransaction;

use PHPUnit\Framework\TestCase;

final class GenerateRequestTransactionTest extends TestCase
{
    public function testToXml(): void
    {
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
        $this->assertXmlStringEqualsXmlString(
            $generateRequest->toXml(),
            "<GenerateRequest><PxPayUserId>SampleUserId</PxPayUserId><PxPayKey>abcdef1234567890abcdef1234567890abcdef1234567890abcdef1234567890</PxPayKey><MerchantReference>Auth Example</MerchantReference><TxnType>Auth</TxnType><AmountInput>1.00</AmountInput><CurrencyInput>NZD</CurrencyInput><TxnData1>John Doe</TxnData1><TxnData2>0211111111</TxnData2><TxnData3>98 Anzac Ave, Auckland 1010</TxnData3><EmailAddress>SampleUserId@paymentexpress.com</EmailAddress><TxnId>P03E890575E9D4A2</TxnId><UrlSuccess>https://demo.paymentexpress.com/SandboxSuccess.aspx</UrlSuccess><UrlFail>https://demo.paymentexpress.com/SandboxSuccess.aspx</UrlFail></GenerateRequest>"
        );
    }

    public function testThrowsExceptionIfInvalidField(): void
    {
        $this->expectException(RuntimeException::class);
        $generateRequest = new GenerateRequestTransaction();
        $generateRequest->setData([
            'InvalidField' => 'This is invalid'
        ]);
    }
}
