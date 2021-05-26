<?php


namespace App\Unifonic;


use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Log;

class Client
{


    private $httpClient;
    private $options;

    public function __construct()
    {
        $this->options = $this->getOptions();



        $this->httpClient = new \GuzzleHttp\Client([
            'base_uri' => $this->options['api_url'],
            'defaults' => [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ]
            ]
        ]);
    }

    function getOptions()
    {
        return config('unifonic');
    }

    function send($to, UnifonicMessage $message)
    {
        if (is_array($to)) {
            $phones = '';
            foreach ($to as $item) {
                $phones .= $item . ',';
            }
            $to = trim($phones, ',');
        }
        $request = $this->httpClient->post('Messages/Send', [
            RequestOptions::FORM_PARAMS => [
                'AppSid'    => $this->options['api_key'],
                'SenderID'  => $this->options['sender_id'],
                'Recipient' => $to,
                'Body'      => $message->content,
            ]
        ]);
        $body = $request->getBody();
        $data = $body->getContents();
        Log::info(json_encode($data));
        Log::channel('slack')->info(json_encode($data));
        return $data;
    }



    function sendVerificationCode($to,$code, UnifonicMessage $message)
    {


        $request = $this->httpClient->post('', [
            RequestOptions::FORM_PARAMS => [
                'AppSid'    => $this->options['api_key'],
                //'Recipient' => '966541555511',
                'Recipient' => $to,
                'Body'      => 'Your Verification Code Is: '.$code,
                'responseType'=>'JSON',
                'CorrelationID'=>'%22%22',
                'baseEncode'=>'true',
                'statusCallback'=>'sent',
                'async'=>'false',

            ]
        ]);
        $body = $request->getBody();
        Log::channel('single')->info($body->getContents());
        Log::channel('slack')->info($body->getContents());
        return $body->getContents();
    }



    function sendForgetCode($to,$code)
    {


        $request = $this->httpClient->post('', [
            RequestOptions::FORM_PARAMS => [
                'AppSid'    => $this->options['api_key'],
                //'Recipient' => '966541555511',
                'Recipient' => $to,
                'Body'      => 'Your Verification Code Is: '.$code,
                'responseType'=>'JSON',
                'CorrelationID'=>'%22%22',
                'baseEncode'=>'true',
                'statusCallback'=>'sent',
                'async'=>'false',

            ]
        ]);
        $body = $request->getBody();
        Log::channel('single')->info($body->getContents());
        Log::channel('slack')->info($body->getContents());
        return $body->getContents();
    }



    function sendCustomer($to,$link)
    {


        $request = $this->httpClient->post('', [
            RequestOptions::FORM_PARAMS => [
                'AppSid'    => $this->options['api_key'],
                //'Recipient' => '966541555511',
                'Recipient' => $to,
                'Body'      => 'Your Plans Link Is: '.$link,
                'responseType'=>'JSON',
                'CorrelationID'=>'%22%22',
                'baseEncode'=>'true',
                'statusCallback'=>'sent',
                'async'=>'false',

            ]
        ]);
        $body = $request->getBody();
        Log::channel('single')->info($body->getContents());
        Log::channel('slack')->info($body->getContents());
        return $body->getContents();
    }

    function verify($recipient, $code)
    {
        $request = $this->httpClient->post('Verify/VerifyNumber', [
            RequestOptions::FORM_PARAMS => [
                'AppSid'    => $this->options['api_key'],
                'Recipient' => $recipient,
                'PassCode'  => $code,
            ]
        ]);
        $body = $request->getBody();
        $data = $body->getContents();
        Log::info(json_encode($data));
        Log::channel('slack')->info(json_encode($data));

        return json_decode($data);
    }


}
