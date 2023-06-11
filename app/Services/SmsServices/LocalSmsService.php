<?php
namespace App\Services\SmsServices;
use App\Services\SmsServices\SmsService;

class LocalSmsService implements SmsService{
    public function sendSms(){
        return "local Sms send success";
    }
}