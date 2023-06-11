<?php 
namespace App\Services;
class PaymentGateway{
    private $secondPayment;
    // protected $secret;
    // public function __construct(string $secretKey){
    //     $this->secret = $secretKey;
    // }
    public function __construct(SecondPayment $secondPayment){
        $this->secondPayment = $secondPayment;
    }
    public function execute(){
        return "payment gateway executed and the key is". $this->secondPayment->getContent();
    }
}