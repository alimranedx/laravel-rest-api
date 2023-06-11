<?php
namespace App\Services\SmsServices;
use App\Services\SmsServices\SmsService;

class ProdSmsService implements SmsService{
    public function sendSms()
    {
        return "hello SMS send form production server";
    }
}