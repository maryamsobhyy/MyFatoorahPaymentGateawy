<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException; // استيراد استثناء Guzzle لمعالجة الأخطاء
use GuzzleHttp\Psr7\Request;

class FatoorhService
{
    private $request_client;
    private $base_url;
    private $headers;

    public function __construct(Client $request_client)
    {
        $this->request_client = $request_client;
        $this->base_url = env('FATOORH_BASE_URL'); // استخدام env بشكل صحيح
        $this->headers = [
            'Authorization' => 'Bearer ' . env('FATOORH_TOKEN'), // تأكد من وجود مسافة بعد Bearer
            'Content-Type' => 'application/json'
        ];
    }

    // دالة لإرسال الطلب إلى API مع معالجة للأخطاء المحتملة
    private function buildrequest($url, $method, $data = [])
    {
        $request = new Request($method, $this->base_url . $url, $this->headers);

        try {
            // إرسال الطلب باستخدام Guzzle وإرسال البيانات ك JSON
            $response = $this->request_client->send($request, [
                'json' => $data
            ]);

            // إذا كان الطلب ناجحًا، فكرر الاستجابة بصورة JSON
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            // إذا حدثت استثناءات (أخطاء)، تحقق مما إذا كان هناك استجابة خطأ وقم بمعالجتها
            if ($e->hasResponse()) {
                return json_decode($e->getResponse()->getBody()->getContents(), true);
            } else {
                // إذا كانت هناك أخطاء أخرى غير متوقعة
                return [
                    'error' => 'Unknown error occurred.'
                ];
            }
        }
    }

    // دالة لإرسال طلب الدفع إلى الخدمة (endpoint)
    public function sendpayment($data)
    {
        // استخدام الدالة buildrequest لإرسال الطلب إلى endpoint SendPayment
        return $this->buildrequest('/v2/SendPayment', 'POST', $data);
    }
    public function GetPaymentStatus($data){
        //to get all data and safe in database
        return $this->buildrequest('/v2/GetPaymentStatus', 'POST', $data);
    }

}
