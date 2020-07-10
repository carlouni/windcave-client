<?php
use Gccm\WindcaveClient\model\ProcessResponseResult;

use PHPUnit\Framework\TestCase;

final class ProcessResponseResultTest extends TestCase
{
    public function testToArray(): void
    {
        $xmlResult = <<<EOT
<Response valid="1">
<Success>1</Success>
<TxnType>Validate</TxnType>
<CurrencyInput>NZD</CurrencyInput>
<MerchantReference>Create Token Example</MerchantReference>
<TxnData1>John Doe</TxnData1>
<TxnData2>0211111111</TxnData2>
<TxnData3>98 Anzac Ave, Auckland 1010</TxnData3>
<AuthCode>103426</AuthCode>
<CardName>Visa</CardName>
<CardHolderName>CREATE TOKEN EXAMPLE</CardHolderName>
<CardNumber>411111........11</CardNumber>
<DateExpiry>1111</DateExpiry>
<ClientInfo>192.168.1.111</ClientInfo>
<TxnId>P03E9C7087908EB2</TxnId>
<EmailAddress>SampleUserId@paymentexpress.com</EmailAddress>
<DpsTxnRef>00000006049d1234</DpsTxnRef>
<BillingId></BillingId>
<DpsBillingId>0000060004444444</DpsBillingId>
<AmountSettlement>1.00</AmountSettlement>
<CurrencySettlement>NZD</CurrencySettlement>
<DateSettlement>20100928</DateSettlement>
<TxnMac>BD43E619</TxnMac>
<ResponseText>APPROVED</ResponseText>
<CardNumber2></CardNumber2>
<Cvc2ResultCode>M</Cvc2ResultCode>
</Response>
EOT;
        $result = new ProcessResponseResult();
        $result->setXml($xmlResult);
        $resultArray = $result->toArray();
        $this->assertEquals('1', $resultArray['Success']);
    }
}
