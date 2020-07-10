<?php
namespace Gccm\WindcaveClient\model;

class ProcessResponseResult extends AbstractResult
{
    public function __construct()
    {
        $this->validFields = [
           'Success',
           'TxnType',
           'CurrencyInput',
           'MerchantReference',
           'TxnData1',
           'TxnData2',
           'TxnData3',
           'AuthCode',
           'CardName',
           'CardHolderName',
           'CardNumber',
           'DateExpiry',
           'ClientInfo',
           'TxnId',
           'EmailAddress',
           'DpsTxnRef',
           'BillingId',
           'DpsBillingId',
           'AmountSettlement',
           'CurrencySettlement',
           'DateSettlement',
           'TxnMac',
           'ResponseText',
           'CardNumber2',
           'Cvc2ResultCode',
        ];
    }
}
