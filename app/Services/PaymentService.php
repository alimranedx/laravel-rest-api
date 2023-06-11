<?php
namespace App\Services;
use App\Services\PaymentGateway;

class PaymentService{
    protected $gateway;
    public function __construct(PaymentGateway $paymentGate){
        $this->gateway = $paymentGate;
    }
    public function printPayment(){
        return $this->gateway->execute();
    }
}