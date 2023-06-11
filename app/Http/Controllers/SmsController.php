<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SmsServices\SmsService;

class SmsController extends Controller
{
    public function sendSms(SmsService $sms, Request $request)
    {
        
        dd($sms->sendSms());
    }
}
