<?php


return  [

    'api_url' =>'http://basic.unifonic.com/rest/SMS/messages',
    'api_key' =>  env('UNIFONIC_API_KEY'),
    'sender_id' =>  env('UNIFONIC_SENDER_ID', 'Aqarz')

];

