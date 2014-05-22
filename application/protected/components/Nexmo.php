<?php

use GuzzleHttp\Client as Client;
use GuzzleHttp\Exception\RequestException as RequestException;

class Nexmo {
    public $key;
    public $secret;

    public function __construct($key,$secret)
    {
        $this->key = $key;
        $this->secret = $secret;
    }


    public function getAccountNumbers()
    {
        $client = new Client();
        $url = Yii::app()->params['nexmo']['accountEndpoint'].'/numbers/'.$this->key.'/'.$this->secret.'?size=100';
        $headers = array(
            'Accept' => 'application/json',
        );
        try {
            $response = $client->get($url,array('headers' => $headers));
            return $response->json();
        } catch (RequestException $e) {
            return $e->getMessage();
        }
    }


    public function sendSms($from,$to,$text)
    {
        $client = new Client();
        $url = Yii::app()->params['nexmo']['smsEndpoint'];
        try{
            $request = $client->createRequest('post',$url,['body' => [
                'api_key' => $this->key,
                'api_secret' => $this->secret,
                'from' => $from,
                'to' => $to,
                'text' => $text,
                'type' => 'text'
            ]]);
            $response = $client->send($request);
            return $response->json();
        } catch (RequestException $e) {
            return $e->getMessage();
        }
    }


}