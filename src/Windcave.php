<?php
namespace Gccm\WindcaveClient;

use Gccm\WindcaveClient\exception\WindcaveException;
use Gccm\WindcaveClient\http\HttpClientFactory;
use Gccm\WindcaveClient\model\TransactionFactory;
use Gccm\WindcaveClient\model\ResultFactory;

class Windcave
{
    private $httpClient;
    private $pxPayUserId;
    private $pxPayKey;

    /**
     * @param string $endpoint Windcave API endpoint
     * @param string $pxPayUserId Windcave API user ID
     * @param string $pxPayKey Windcave API hexadecimal key
     */
    public function __construct($endpoint, $pxPayUserId, $pxPayKey)
    {
        $this->httpClient  = HttpClientFactory::make('SocketHttpClient', $endpoint);
        $this->pxPayUserId = $pxPayUserId;
        $this->pxPayKey = $pxPayKey;
    }

    /**
     * @param array $data Associative array containing GenerateRequest data.
     * @return string
     */
    public function getPaymentUrl($data) : string
    {
        try {
            $newData = $data;
            $newData['PxPayUserId'] = $this->pxPayUserId;
            $newData['PxPayKey'] = $this->pxPayKey;

            $transaction = TransactionFactory::make('GenerateRequestTransaction');
            $transaction->setData($newData);
            $resultXml = $this->httpClient->submitXml($transaction->toXml());

            $result = ResultFactory::make('GenerateRequestResult');
            $result->setXml($resultXml);

            $resultArray = $result->toArray();

            if (filter_var($resultArray['URI'], FILTER_VALIDATE_URL) === false) {
                throw new \RuntimeException(
                    isset($resultArray['ResponseText']) ?
                    $resultArray['ResponseText'] :
                    'Unable to generate payment URL.'
                );
            }
            return $resultArray['URI'];
        } catch (\Exception $e) {
            throw new WindcaveException($e->getMessage());
        }
    }

    /**
     * @param string $responseHash Hexadecimal hash returned by Windcave after payment process.
     * @return array
     */
    public function getResult($responseHash) : array
    {
        try {
            $transaction = TransactionFactory::make('ProcessResponseTransaction');
            $transaction->setData([
                'PxPayUserId' => $this->pxPayUserId,
                'PxPayKey' => $this->pxPayKey,
                'Response' => $responseHash
            ]);
            $resultXml = $this->httpClient->submitXml($transaction->toXml());

            $result = ResultFactory::make('ProcessResponseResult');
            $result->setXml($resultXml);

            return $result->toArray();
        } catch (\Exception $e) {
            throw new WindcaveException($e->getMessage());
        }
    }
}
