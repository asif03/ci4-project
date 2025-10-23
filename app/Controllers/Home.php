<?php

namespace App\Controllers;

use App\Models\FcpsPartOneModel;
use App\Services\EmailService;

class Home extends BaseController
{
    protected $fcpsPartOneModel;

    public function __construct()
    {
        $this->fcpsPartOneModel = new FcpsPartOneModel();
    }

    public function index(): string
    {
        return view('home');
    }

    public function registrationNoSms(): string
    {
        return view('registration_no_sms');
    }

    public function sendOtp()
    {
        $penNo        = $this->request->getPost('penNo');
        $mobileNo     = $this->request->getPost('mobileNo');
        $emailAddress = $this->request->getPost('emailAddress');
        $chooseOption = $this->request->getPost('chooseOption');

        if ($penNo == '' && ($mobileNo == '' || $emailAddress == '')) {
            return $this->response->setJSON([
                'success'    => false,
                'message'    => 'Please fill out required fields!',
                'csrf_token' => csrf_hash(), // send fresh token
            ]);
        }

        $params = [];

        if ($chooseOption === 'both') {
            $params = [
                'pen_number' => $penNo,
                'cell'       => $mobileNo,
                'email'      => $emailAddress,
            ];
        } elseif ($chooseOption === 'sms') {
            $params = [
                'pen_number' => $penNo,
                'cell'       => $mobileNo,
            ];
        } elseif ($chooseOption === 'email') {
            $params = [
                'pen_number' => $penNo,
                'email'      => $emailAddress,
            ];
        }

        $trainee = $this->fcpsPartOneModel->getTraineeInfoByParams($params);

        if ($trainee) {

            $otp = rand(1000, 9999);

            if ($chooseOption === 'sms' && $trainee['smscounter'] >= 4) {
                return $this->response->setJSON([
                    'success'    => false,
                    'message'    => 'You’ve already requested your Registration No. and Password via SMS twice. Please try a different method to continue.',
                    'csrf_token' => csrf_hash(), // send fresh token
                ]);
            }

            if ($chooseOption === 'email') {

                $data = [
                    'recipient_name' => $trainee['name'],
                    'otp'            => $otp,
                ];

                $to      = $trainee['email'];
                $subject = 'One-Time Password (OTP) from Bangladesh College of Physicians & Surgeons';

                // Load the HTML as a string
                $message = view('Emails/otp_template', $data);

                $emailService = new EmailService();
                $result       = $emailService->sendEmail($to, $subject, $message); // You can pass parameters if needed

                if ($result) {

                    $hashedOtp = password_hash($otp, PASSWORD_DEFAULT);

                    $updateData = [
                        'hashedotp' => $hashedOtp,
                    ];

                    $isUpdate = $this->fcpsPartOneModel->update($trainee['id'], $updateData);

                    if ($isUpdate) {
                        return $this->response->setJSON([
                            'success'    => true,
                            'message'    => 'OTP sent successfully to your ' . $chooseOption,
                            'csrf_token' => csrf_hash(), // send fresh token
                        ]);
                    } else {
                        return $this->response->setJSON([
                            'success'    => false,
                            'message'    => 'OTP sent failed to your ' . $chooseOption,
                            'csrf_token' => csrf_hash(), // send fresh token
                        ]);
                    }
                } else {
                    return $this->response->setJSON([
                        'success'    => false,
                        'message'    => 'OTP sent failed to your ' . $chooseOption,
                        'csrf_token' => csrf_hash(), // send fresh token
                    ]);
                }
            }

            /*if ($chooseOption === 'sms') {
            # code...
            }

            if ($chooseOption === 'both') {
            # code...
            }*/

            return $this->response->setJSON([
                'success'    => true,
                'message'    => 'OTP sent successfully to your ' . $chooseOption,
                'csrf_token' => csrf_hash(), // send fresh token
            ]);
        } else {
            return $this->response->setJSON([
                'success'    => false,
                'message'    => 'Invalid PEN or Mobile number or Email!',
                'csrf_token' => csrf_hash(), // send fresh token
            ]);
        }

    }

    public function verifyOtp()
    {
        $penNo        = $this->request->getPost('penNo');
        $mobileNo     = $this->request->getPost('mobileNo');
        $emailAddress = $this->request->getPost('emailAddress');
        $chooseOption = $this->request->getPost('chooseOption');
        $otp          = $this->request->getPost('otp');

        if ($penNo == '' && ($mobileNo == '' || $emailAddress == '')) {
            return $this->response->setJSON([
                'success'    => false,
                'message'    => 'Please fill out required fields!',
                'csrf_token' => csrf_hash(), // send fresh token
            ]);
        }

        $params = [];

        if ($chooseOption === 'both') {
            $params = [
                'pen_number' => $penNo,
                'cell'       => $mobileNo,
                'email'      => $emailAddress,
            ];
        } elseif ($chooseOption === 'sms') {
            $params = [
                'pen_number' => $penNo,
                'cell'       => $mobileNo,
            ];
        } elseif ($chooseOption === 'email') {
            $params = [
                'pen_number' => $penNo,
                'email'      => $emailAddress,
            ];
        }

        $trainee = $this->fcpsPartOneModel->getTraineeInfoByParams($params);

        if ($trainee) {

            if (password_verify($otp, $trainee['hashedotp'])) {

                if ($chooseOption === 'email') {

                    $data = [
                        'recipientName' => $trainee['name'],
                        'regNumber'     => $trainee['reg_no'],
                        'password'      => $trainee['password'],
                        // Footer variables (use actual application settings)
                        'websiteUrl'    => 'https://www.bcps.edu.bd',
                        'supportEmail'  => 'it@bcps.edu.bd',
                        'contactNumber' => '+880-2-9132070',
                        'loginUrl'      => site_url('login'), // Assuming you have a route named 'login'
                    ];

                    $to      = $trainee['email'];
                    $subject = 'Welcome! Your BCPS Registration Credentials';

                    // Load the HTML as a string
                    $message = view('Emails/registration_welcome', $data);

                    $emailService = new EmailService();
                    $result       = $emailService->sendEmail($to, $subject, $message); // You can pass parameters if needed

                    if ($result) {
                        return $this->response->setJSON([
                            'success'    => true,
                            'message'    => 'Registration info send successfully!',
                            'csrf_token' => csrf_hash(), // send fresh token
                        ]);
                    }
                } else {
                    return $this->response->setJSON([
                        'success'    => false,
                        'message'    => 'Woo! something heppen.',
                        'csrf_token' => csrf_hash(), // send fresh token
                    ]);
                }

            } else {
                return $this->response->setJSON([
                    'success'    => false,
                    'message'    => 'Invalid OTP!',
                    'csrf_token' => csrf_hash(), // send fresh token
                ]);
            }
        }
    }

    public function contactUs(): string
    {
        return view('contact');
    }
}