<?php

namespace vadgab\Yii2BorgunApi;

use Yii;



class BorgunApi
{

    public $bPaymentModules = "site";

    /* send params borgun */
    public $test = "0";  
    public $payURL = "";
    public $secretKey = "";
    public $merchantid = "";
    public $paymentgatewayid = "";
    public $checkhash = "";
    public $orderid = "";
    public $currency = "";
    public $language = "";
    public $buyername = "";
    public $buyeremail = "";
    private $items = array();
    public $item = array();
    public $amount = "";
    public $pagetype = "";
    public $skipreceiptpage = "";
    public $merchantlogo = "https://www.b-payment.hu/docs/images/logo.jpg";
    public $merchantemail = "";


    private $postData = array();

    const URL_MAIN_TEST = "https://test.borgun.is/SecurePay/default.aspx";
    const URL_MAIN_LIVE = "https://securepay.borgun.is/SecurePay/default.aspx";
    const RETURN_SUCCESS = "/{bPaymentModules}/paysuccess";
    const RETURN_SUCCESS_SERVER = "/{bPaymentModules}/paysuccessserver";
    const RETURN_CANCEL = "/{bPaymentModules}/paycancel";
    const RETURN_ERROR = "/{bPaymentModules}/payerror";


    public function sendPayment(){

        if($this->test == 1)$this->payURL = self::URL_MAIN_TEST;
        else $this->payURL = self::URL_MAIN_LIVE;

        /* MAIN DATA */
        $this->post_data['merchantid'] = $this->merchantid;
        $this->post_data['paymentgatewayid'] = $this->paymentgatewayid;
        $this->post_data['checkhash'] = self::generateHashHmac();
        $this->post_data['orderid'] = $this->orderid;
        $this->post_data['currency'] = $this->currency;
        $this->post_data['language'] = $this->language;
        $this->post_data['buyername'] = $this->buyername;
        $this->post_data['buyeremail'] = $this->buyeremail;
        $this->post_data['amount'] = $this->amount;


        /* items add post data */
        $count = 0;
        if(!empty($this->items))foreach($this->items as $items){
            foreach($items as $key => $items_add){
                $this->post_data['item'.$key.'_'.$count] = $items_add;
            }
        }

        /*   return URL */
        $this->post_data['returnurlsuccess'] = Yii::$app->params['base_url'].str_replace("{bPaymentModules}",$this->bPaymentModules,self::RETURN_SUCCESS);
        $this->post_data['returnurlcancel'] = Yii::$app->params['base_url'].str_replace("{bPaymentModules}",$this->bPaymentModules,self::RETURN_CANCEL);
        $this->post_data['returnurlerror'] = Yii::$app->params['base_url'].str_replace("{bPaymentModules}",$this->bPaymentModules,self::RETURN_ERROR);
        $this->post_data['returnurlsuccessserver'] = Yii::$app->params['base_url'].str_replace("{bPaymentModules}",$this->bPaymentModules,self::RETURN_SUCCESS_SERVER);

        $fields_string = http_build_query($this->post_data);

        $out ='<form id="payForm" action="'.$this->payURL.'" method="post">';
            foreach ($this->post_data as $a => $b) {
                $out.= '<input type="hidden" name="'.htmlentities($a).'" value="'.htmlentities($b).'">';
            }
        $out.= '</form>';
        $out.= '<script type="text/javascript">';
        $out.= '    document.getElementById("payForm").submit();';
        $out.= '</script>';
        echo $out;

    }


     public function generateHashHmac(){
        $message = utf8_encode($this->merchantid.'|'.Yii::$app->params['base_url'].str_replace("{bPaymentModules}",$this->bPaymentModules,self::RETURN_SUCCESS).'|'.Yii::$app->params['base_url'].str_replace("{bPaymentModules}",$this->bPaymentModules,self::RETURN_SUCCESS_SERVER).'|'.$this->orderid.'|'.$this->amount.'|'.$this->currency);
        return  hash_hmac('sha256', $message, $this->secretKey);
    }
 
}
?>