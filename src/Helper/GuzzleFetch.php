<?php


namespace App\Helper;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class GuzzleFetch
{
    public function __construct($accessToken = "") {
        $this->client = new Client();
        $this->accessToken = $accessToken;

        $this->headers = [
            "Authorization" => "Bearer $this->accessToken",
            "Content-Type" => "application/json"
        ];
    }

    public function post($url, $data = null)
    {

        try {
            $response = $this->client->request('POST', $url, [
                'json' => $data,
                'headers' => $this->headers,
            ]);

            return json_decode($response->getBody()->getContents());
        } catch (\Exception $exception) {
            $message = $exception->getMessage();

            $message = explode("response:", $message)[1];
            return $this->decode(array(
                "message" => "failed",
                "data" => json_decode($message)->message
            ));
        }

    }

    public function decode($data){
        return json_decode(json_encode($data));
    }
}