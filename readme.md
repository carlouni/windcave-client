# Windcave Client
This is a library to enable the implementation of payment gateways using Windcave payment platform.

## Usage

### Installation
```
$ composer require gccm/windcave-client
```

### Generate Payment URL
The <b>url</b> returned by <b>$windcave->getPaymentUrl</b> is where the payer should be redirected to proceed with payment.

```PHP
use Gccm\WindcaveClient\Windcave;
use Gccm\WindcaveClient\exception\WindcaveException;

try {
    $windcave = new Windcave(
        'https://sec.paymentexpress.com/pxaccess/pxpay.aspx',
        'SampleUserId',
        '17ce70a6025d8b925373066d3f71704a1868ea30a8d0485b6d086f722fdd9997'
    );

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
        'UrlSuccess' => 'https://demo.paymentexpress.com/SandboxSuccess.aspx',
        'UrlFail' => 'https://demo.paymentexpress.com/SandboxSuccess.aspx',
    ]);

    echo $url;
} catch (WindcaveException $e) {
    // do some stuff with $e
}

```

#### Example Response
```
https://sec.paymentexpress.com/pxmi3/EF4054F622D6C4C1B4F9AEA59DC91CAD3654CD60ED7ED04110CBC402959AC7CF035878AEB85D87223
```

### Obtain payment result
Call the <b>$windcave->getResult</b> method passing the <b>result</b> hash returned by Windcave.

```PHP
use Gccm\WindcaveClient\Windcave;
use Gccm\WindcaveClient\exception\WindcaveException;

try {
    $windcave = new Windcave(
        'https://sec.paymentexpress.com/pxaccess/pxpay.aspx',
        'SampleUserId',
        '17ce70a6025d8b925373066d3f71704a1868ea30a8d0485b6d086f722fdd9997'
    );

    $result = $windcave->getResult('00008400001853747f2bc6ded6012345');

    var_dump($result);
]);
} catch (WindcaveException $e) {
    // do some stuff with $e
}

```

#### Example Response
```
array(25) {
  'Success' => string(1) "1"
  'TxnType' => string(4) "Auth"
  'CurrencyInput' => string(3) "NZD"
  'MerchantReference' => string(12) "Auth Example"
  'TxnData1' => string(8) "John Doe"
  'TxnData2' => string(10) "0211111111"
  'TxnData3' => string(27) "98 Anzac Ave, Auckland 1010"
  'AuthCode' => string(6) "185621"
  'CardName' => string(4) "Visa"
  'CardHolderName' => string(4) "TEST"
  'CardNumber' => string(16) "411111........11"
  'DateExpiry' => string(4) "0720"
  'ClientInfo' => string(15) "220.253.106.137"
  'TxnId' => string(13) "5f0c057921ed3"
  'EmailAddress' => string(31) "SampleUserId@paymentexpress.com"
  'DpsTxnRef' => string(16) "0000000b7629a6eb"
  'BillingId' => string(0) ""
  'DpsBillingId' => string(0) ""
  'AmountSettlement' => string(4) "1.00"
  'CurrencySettlement' => string(3) "NZD"
  'DateSettlement' => string(8) "20200713"
  'TxnMac' => string(8) "2BC20210"
  'ResponseText' => string(8) "APPROVED"
  'CardNumber2' => string(0) ""
  'Cvc2ResultCode' => string(1) "P"
}
```