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
    private $items = array();
    public $item = array();
    public $amount = "";
    public $pagetype = "";
    public $skipreceiptpage = "";
    public $merchantlogo = "https://www.b-payment.hu/docs/images/logo.jpg";
    public $merchantemail = "";

    private $postData = array();

    const URL_MAIN_TEST = "https://www.szamlazz.hu/szamla/";
    const URL_MAIN_LIVE = "https://www.szamlazz.hu/szamla/";
    const RETURN_SUCCESS = "/{bPaymentModules}/success";
    const RETURN_SUCCESS_SERVER = "/{bPaymentModules}/successserver";
    const RETURN_CANCEL = "/{bPaymentModules}/cancel";
    const RETURN_ERROR = "/{bPaymentModules}/error";


    public function sendPayment(){

        /* MAIN DATA */
        $this->post_data['merchantid'] = $this->merchantid;
        $this->post_data['paymentgatewayid'] = $this->paymentgatewayid;
        $this->post_data['checkhash'] = $this->checkhash;
        $this->post_data['orderid'] = $this->orderid;
        $this->post_data['currency'] = $this->currency;
        $this->post_data['language'] = $this->language;
        $this->post_data['buyername'] = $this->buyername;
        $this->post_data['buyeremail'] = $this->buyeremail;
        $this->post_data['amount'] = $this->amount;
        $this->post_data['merchantid'] = $this->merchantid;

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


    }

    public function addItem(){

        /* MAIN DATA */
        $this->item['description'] = '';
        $this->item['count'] = '';
        $this->item['unitamount'] = '';
        $this->item['amount'] = '';
        /* add items schema */
        $this->items[] = $this->item;

    }








}
?>