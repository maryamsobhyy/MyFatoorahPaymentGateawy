<?php

namespace App\Services;

use GuzzleHttp\Client;

class FatoorhService
{
    private $request_client;
    private $base_url;
    public function __construct(Client $request_client)
    {
        $this->request_client=$request_client;
    }
}
