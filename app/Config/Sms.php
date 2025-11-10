<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Sms extends BaseConfig
{

    /**
     * The "user name" for SMS gateway
     */
    public string $userName;

    /**
     * The "password" for SMS gateway
     */
    public string $password;

    /**
     * The "sender ID" for SMS gateway
     */
    public string $senderID;

    /**
     * The "API URL" for SMS gateway
     */
    public string $apiUrl;

    /**
     * The "API Token" for SMS gateway
     */
    public string $apiToken;

    public function __construct()
    {
        // Load from environment variables or set default values
        $this->userName = env('sms.apiUsername', 'localhost');
        $this->password = env('sms.apiSerect', 'default_password');
        $this->senderID = env('sms.sid', 'DEFAULTID');
        $this->apiUrl   = env('sms.apiEndpoint', 'https://api.example-sms-gateway.com/send');
        $this->apiToken = env('sms.apiKey', 'default_api_token');
    }

}
