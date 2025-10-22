<?php
namespace App\Services;

use CodeIgniter\Config\Services;

class EmailService
{
    public function sendEmail($to = null, $subject = null, $message = null)
    {
        $email = Services::email();

        $to      = $to ?? 'it@bcps.edu.bd';
        $subject = $subject ?? 'Test Email from .env Configuration';
        $message = $message ?? '<h1>Hello World!</h1><p>This email is sent using .env configuration.</p>';

        $email->setTo($to);
        $email->setSubject($subject);
        $email->setMessage($message);

        if ($email->send()) {
            return true;
        } else {
            log_message('error', $email->printDebugger(['headers']));
            return false;
        }
    }
}