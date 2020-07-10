<?php
namespace Gccm\WindcaveClient;

class SocketHttpClient extends AbstractHttpClient
{

    /**
     * @param string $endpoint Windcave API endpoint
     */
    public function __construct($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @param string $xml XML string containing transaction to be sent.
     */
    public function submitXml($xml): string
    {
        // parsing the given URL
        $URL_Info = parse_url($this->endpoint);
  
        // Building referrer
        $referer = array_key_exists('HTTP_REFERER', $_SERVER) ? $_SERVER['HTTP_REFERER'] : '';
  
        // Find out which port is needed - if not given use standard (=80)
        if (!isset($URL_Info["port"])) {
            $URL_Info["port"] = 443;
        }
  
        // building POST-request:
        $requestdata = '';
        $requestdata.="POST ".$URL_Info["path"]." HTTP/1.1\n";
        $requestdata.="Host: ".$URL_Info["host"]."\n";
        $requestdata.="Referer: $referer\n";
        $requestdata.="Content-type: application/x-www-form-urlencoded\n";
        $requestdata.="Content-length: ".strlen($xml)."\n";
        $requestdata.="Connection: close\n";
        $requestdata.="\n";
        $requestdata.=$xml."\n";
  
        $fp = fsockopen("ssl://{$URL_Info['host']}", $URL_Info["port"], $errno, $errstr);
  
        if (!$fp) {
            throw new \RuntimeException("$errstr ($errno)");
        }
  
        $fputs = fputs($fp, $requestdata);
        if (!$fputs) {
            throw new \RuntimeException("Can't send request:\r\n$requestdata");
        }
  
        $result = '';
        while (!feof($fp)) {
            $result .= fgets($fp, 128);
        }
        fclose($fp);
        
        $response = $this->parseHttpResponse($result);
        echo $response['statusCode'];
        if ($response['statusCode'] !== 200 || empty($response['body'])) {
            throw new \RuntimeException(
                "Call to {$this->endpoint} resulted in {$response['statusCode']} {$response['reasonPhrase']}: Unexpected result when sending requests to Payment Express."
            );
        }

        return $response['body'];
    }

    /**
     * @param string $httpResponse HTTP response
     */
    private function parseHttpResponse($httpResponse): array
    {
        $statusCode= 500;
        $reasonPhrase = 'Server Error';
        $body = '';

        $splitedResponse = preg_split("/\r\n\r\n/", $httpResponse, 2);
        if (!$splitedResponse) {
            throw new \RuntimeException('$httpResponse is not a valid HTTP response');
        }

        if (isset($splitedResponse[1])) {
            $body = trim($splitedResponse[1]);
        }

        $headerLines = preg_split("/\r\n/", $splitedResponse[0]);
        $statusLine = array_shift($headerLines);

        if (!preg_match("/^(HTTP.+)\s(\d{3})\s([a-zA-Z0-9\s]+)/", $statusLine, $matches)) {
            throw new \RuntimeException('$httpResponse is not a valid HTTP response');
        }

        $statusCode = intval($matches[2]);
        $reasonPhrase = $matches[3];

        $headers = [];
        foreach ($headerLines as $line) {
            $splitedLine = preg_split('/:/', $line, 2);
            $headers[trim($splitedLine[0])] = isset($splitedLine[1]) ? trim($splitedLine[1]): '';
        }
        
        return [
            'statusCode' => $statusCode,
            'reasonPhrase' => $reasonPhrase,
            'headers' => $headers,
            'body' => $body,
        ];
    }
}
