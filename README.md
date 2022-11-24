<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii2 Szamlazz.hu Api Extension</h1>
    <br>
</p>




Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/):

```
composer require --prefer-dist vadgab/yii2-borgun-api
```

Settings:

​	config/params.php

```
return [
...,
'base_url'=> 'http://*url*',
...
]
```

​			

Basic Usage
-----------

General use can be tried through the following examples:

- Create payment

	```php
  use vadgab\Yii2BorgunApi\BorgunApi;    
  
	$payment = new BorgunApi;
  
	$payment->test = 1;
	
	/* merchant variables */
	$payment->secretKey = "cdedfbb6ecab4a4994ac880144dd92dc";
	$payment->merchantid = "9256684";
	$payment->paymentgatewayid = "471";
	
	/* payment variables */
  $payment->orderid = "ORDER123001";
	$payment->currency = "HUF";
  $payment->language = "HU";
	$payment->buyername = "Gábor Vadász";
  $payment->buyeremail = "vadgab@allstar.hu";
  $payment->amount = "110";
  
  $payment->item['description'] = "Teszt product";
  $payment->item['count'] = "1";
	$payment->item['unitamount'] = "110";
  $payment->item['amount'] = "110";
	$payment->addItem();
  
  /* Send payment */
  $payment->sendPayment();

