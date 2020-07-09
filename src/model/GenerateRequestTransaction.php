<?php
namespace Gccm\WindcaveClient\model;

class GenerateRequestTransaction extends AbstractTransaction
{
    public function __construct()
    {
        $this->type = 'GenerateRequest';
        $this->validFields = [
            'PxPayUserId',
            'PxPayKey',
            'MerchantReference',
            'TxnType',
            'AmountInput',
            'CurrencyInput',
            'TxnData1',
            'TxnData2',
            'TxnData3',
            'EmailAddress',
            'TxnId',
            'UrlSuccess',
            'UrlFail'
        ];
    }
}
