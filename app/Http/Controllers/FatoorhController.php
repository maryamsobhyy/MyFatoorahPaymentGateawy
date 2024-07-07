<?php

namespace App\Http\Controllers;

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
            //Fill optional data
            'CustomerName' => 'Maryiem Sobhy',
            'NotificationOption' => 'LNK',
            "InvoiceValue" => 100.0,
            'DisplayCurrencyIso' => 'SAR',
            'CustomerEmail' => 'maryam@example.com',
            'CallBackUrl' => 'http://127.0.0.1:8000/',
            'ErrorUrl' => 'https://example.com/callback.php',
            'Language' => 'en',

        ];
        $this ->FatoorhService ->sendpayment($data);

    }
}
