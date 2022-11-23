<?php

namespace vadgab\Yii2BorgunApi;

use Yii;





class BorgunApi
{

    public $bPaymentModules = "site";

    /* send params borgun */
    public $merchantid = "";
    public $paymentgatewayid = "";
    public $checkhash = "";
    public $orderid = "";
    public $currency = "";
    public $language = "";
    public $buyername = "";
    public $buyeremail = "";
    public $items = array();
    public $amount = "";
    public $pagetype = "";
    public $skipreceiptpage = "";
    public $merchantlogo = "https://www.b-payment.hu/docs/images/logo.jpg";
    public $merchantemail = "";

    const URL_MAIN_TEST = "https://www.szamlazz.hu/szamla/";
    const URL_MAIN_LIVE = "https://www.szamlazz.hu/szamla/";
    const RETURN_SUCCESS = "/{bPaymentModules}/success";
    const RETURN_SUCCESS_SERVER = "/{bPaymentModules}/successserver";
    const RETURN_CANCEL = "/{bPaymentModules}/cancel";
    const RETURN_ERROR = "/{bPaymentModules}/error";


    public function sendPayment(){


    }








}
?>