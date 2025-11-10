<?php
namespace App\Services;

use CodeIgniter\Config\Services;

class SmsService
{
    protected function callApi($url, $params)
    {
        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($params),
            'accept:application/json',
        ));

        $response = curl_exec($ch);

        curl_close($ch);

        return $response;
    }

    /**
     * @param $msisdn
     * @param $messageBody
     * @param $csmsId (Unique)
     */
    public function singleSms($msisdn, $messageBody, $csmsId)
    {
        $sms = Services::sms();

        $params = [
            "api_token" => $sms->apiToken,
            "sid"       => $sms->senderID,
            "msisdn"    => $msisdn,
            "sms"       => $messageBody,
            "csms_id"   => $csmsId,
        ];
        $url    = trim($sms->apiUrl, '/') . "/api/v3/send-sms";
        $params = json_encode($params);

        return $this->callApi($url, $params);
    }

}
