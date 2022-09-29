<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Http;
use App\Models\Utils\Currency;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class Paymooney {
    private $paymooneyPublicKey;
    private $paymooneyPrivateKey;
    public $base_url;
    public $api_version;

    public function __construct()
    {
        $this->paymooneyPublicKey = config('paymooney.public');
        $this->paymooneyPrivateKey = config('paymooney.secret');
        $this->base_url = "https://www.paymooney.com";
        $this->api_version = "/api/v1.0";
    }

    public function generatePaymentUrl($amount,$currency,$candidateId,$ref)
    {
        $response = Http::post($this->base_url.$this->api_version.'/payment_url', [
            'amount' => $amount,
            'currency_code' => $currency,
            'lang' => 'en',
            'item_ref' => $ref,
            'item_name' => 'Shosa Payment',
            'public_key' => config('paymooney.public'),
            //'logo' => asset('images/logo/mffa.png'),
            //'environement' => 'test'
        ]);

        if($response["response"] == "success")
        {
            return $response["payment_url"];
        } else {
            abort(403, "An error occured. Please Try again");
        }
    }

    public function checkIfPaymentValid($ip,$sign_token){
        if (hash_equals($sign_token, crypt($this->paymooneyPrivateKey, $sign_token))) {
           if($ip=="199.59.247.243" || $ip=="199.59.247.250" )
             return true;
         }
         return false;
     }
}