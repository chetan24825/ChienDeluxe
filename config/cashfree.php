<?php
return [
    'app_id' => env('CASHFREE_APP_ID'),
    'secret_key' => env('CASHFREE_SECRET_KEY'),
    'mode' => env('CASHFREE_MODE', 'test'),
    'urls'=>[
        'test'=>'https://sandbox.cashfree.com/pg',
        'production'=>'https://api.cashfree.com/pg'
    ]
];