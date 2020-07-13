<?php
use Gccm\WindcaveClient\Windcave;

use PHPUnit\Framework\TestCase;

final class WindcaveTest extends TestCase
{
    public function testGetPaymentUrl(): void
    {
        $windcave = new Windcave('https://sec.paymentexpress.com/pxaccess/pxpay.aspx', $_ENV['PX_PAY_USER_ID'], $_ENV['PX_PAY_KEY']);
        $url = $windcave->getPaymentUrl([
            'MerchantReference' => 'Auth Example',
            'TxnType' => 'Auth',
            'AmountInput' => '1.00',
            'CurrencyInput' => 'NZD',
            'TxnData1' => 'John Doe',
            'TxnData2' => '0211111111',
            'TxnData3' => '98 Anzac Ave, Auckland 1010',
            'EmailAddress' => 'SampleUserId@paymentexpress.com',
            'TxnId' => uniqid(),
            'UrlSuccess' => isset($_ENV['URL_SUCCESS']) ? $_ENV['URL_SUCCESS'] : 'https://demo.paymentexpress.com/SandboxSuccess.aspx',
            'UrlFail' => isset($_ENV['URL_FAIL']) ? $_ENV['URL_FAIL'] : 'https://demo.paymentexpress.com/SandboxSuccess.aspx',
        ]);
        $this->assertMatchesRegularExpression('/^https:\/\/sec\.paymentexpress\.com\/pxmi3\/[0-9ABCDEF]+/', $url);
    }

    public function testGetResult(): void
    {
        $windcave = new Windcave('https://sec.paymentexpress.com/pxaccess/pxpay.aspx', $_ENV['PX_PAY_USER_ID'], $_ENV['PX_PAY_KEY']);
        $result = $windcave->getResult($_ENV['RESPONSE_HASH']);
        $this->assertEquals($result['TxnType'], 'Auth');
    }
}
