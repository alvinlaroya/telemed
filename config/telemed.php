<?php

return [
    'contact_no' => 'XXXXXX',

    'asiapay' => [
        'link' => env('ASIAPAY_LINK', 'https://test.pesopay.com/b2cDemo/eng/payment/payForm.jsp'),
        'merchantId' => env('ASIAPAY_MERCHANT_ID', '12345678'),
        'currCode' => env('ASIAPAY_CURR_CODE', '608'),
        'mpsMode' => env('ASIAPAY_MPS_MODE', 'NIL'),
        'successUrl' => env('APP_URL') . '/book-a-service/success',
        'failUrl' => env('APP_URL') . '/book-a-service/failed',
        'cancelUrl' => env('APP_URL') . '/book-a-service/cancelled',
        'payType' => 'N',
        'lang' => 'E',
        'payMethod' => 'ALL',
        'secureHash' => env('ASIAPAY_SECURE_HASH', 'PFnxwaTq2D2KvIHgN1ipyrnSQLH17IYB'),
    ],

    'mode_of_payment' => [
        'credit_card' => 'Credit Card / Debit Card',
        'hmo' => 'HMO',
        'corporate' => 'Corporate',
        'insurance' => 'Insurance',
        'philhealth' => 'Philhealth',
        'doctor' => 'Doctor',
        'doctor_dependent' => 'Doctor Dependent',
        'MyHospital' => 'Direct Deposit'
    ],

    'mop_value' => [
        'hmo' => 'HMO Provider',
        'corporate' => 'Company Name',
        'insurance' => 'Insurance Company',
        'doctor' => 'Doctor',
        'doctor_dependent' => 'Doctor Dependent'
    ],

];
