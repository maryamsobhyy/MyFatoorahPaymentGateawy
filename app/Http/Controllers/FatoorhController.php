<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use App\Services\FatoorhService;

class FatoorhController extends Controller
{
    private $FatoorhService;

    public function __construct(FatoorhService $FatoorhService)
    {
        $this->FatoorhService = $FatoorhService;
    }

    public function index()
    {
        $data = [
            'CustomerName' => 'Maryiem Sobhy',
            'NotificationOption' => 'LNK',
            'InvoiceValue' => 100.0,
            'DisplayCurrencyIso' => 'SAR',
            'CustomerEmail' => 'maryam@example.com',
            'CallBackUrl' => 'http://127.0.0.1:8000/callback',
            'ErrorUrl' => 'https://goagle.com',
            'Language' => 'en',
            'MobileCountryCode' => '+966',
            'CustomerMobile' => '1234567890',
        ];

        $response = $this->FatoorhService->sendpayment($data);

        if (isset($response['error'])) {
            // تعامل مع الخطأ هنا
            return response()->json(['error' => $response['error']], 500);
        }

        // تعامل مع الاستجابة الناجحة هنا
        return response()->json($response);
    }
    public function callback(Request $request)
    {
    

        // التحقق من وجود paymentId في الطلب
        if (!$request->has('paymentId')) {
            return response()->json([
                'IsSuccess' => false,
                'Message' => 'PaymentId is required',
            ], 400);
        }

        $data = [];
        $data['key'] = $request->paymentId; // تقديم paymentId كـ 'key'
        $data['KeyType'] = 'PaymentId'; // نوع المفتاح هو 'PaymentId'

        // استدعاء خدمة FatoorhService للتحقق من حالة الدفع
        $response = $this->FatoorhService->GetPaymentStatus($data);

        return response()->json($response);
    }


}
