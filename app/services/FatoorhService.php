<?php

namespace App\Services;

use GuzzleHttp\Client;

class FatoorhService
{
    private $request_client;
    private $base_url;
    private $headers;
    public function __construct(Client $request_client)
    {
        //علشان اقدر اكلم اي third party لازم استخدم client وانا هنا استخدمت نوع منه اسمه Guzzlehttp
        $this->request_client = $request_client;
        // ايه ال url اللي هكلمه يعني ايه ال third party url اللي هكلمه
        $this->base_url = env('Fatoorh_base_url');
        //headers لازم ابعت لل guzzlehttp حاجات بتفرضها عليا
        $this->headers = [
            'Authorization' => 'Bearer' . env('Fatoorh_token'),
            'Content-Type' => 'application/json'
        ];

    }
    private function buildrequest ()
    {

    }
    public function sendpayment ($data)
    {

    }
}
