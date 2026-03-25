<?php

namespace App\Controllers;

use App\Models\OfficesModel;
use App\Models\Locations\CountryModel;
use App\Models\GeneralSettingModel;
use App\Models\EmailModel;
use App\Models\PracticeModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as MAILER_Exception;

class Contactus extends BaseController
{

    public function __construct()
    {
        $this->offices = new OfficesModel();
        $this->countries = new CountryModel();
    }


    public function index()
    {
        $data = [];
        $countries = $this->countries->where(['status' => 1])->findAll();
        $offices = $this->offices->where(['status' => 1])->findAll();

        $offices_arr = [];
        foreach($countries as $country){
            foreach($offices as $office){
                if($country['id'] == $office['country_id']){
                    $offices_arr[$country['code']][] = $office;
                }
            }
        }
        $data['offices_json'] = json_encode($offices_arr);
        $data['countries'] = $countries;

        $genSettingsModel = new GeneralSettingModel();
        $genSettings = $genSettingsModel->find(1);
        $data['captch_sitekey'] = $genSettings['recaptcha_site_key'];

        // PAGE HEAD PROCESSING
        return view('components/header', array(
            'title' => 'MIMS Singapore (Headquarters) | Asia Pacific leading multichannel provider of medical information',
            'description' => 'MIMS is headquartered in Singapore. We have a strong presence in Asia Pacific supported by over 1,000 employees across 36 local offices.',
            'url' => BASE_URL,
            'keywords' => '',
            'meta' => array(
                'title' => 'MIMS Singapore (Headquarters) | Asia Pacific leading multichannel provider of medical information',
                'description' => 'MIMS is headquartered in Singapore. We have a strong presence in Asia Pacific supported by over 1,000 employees across 36 local offices.',
                'image' => IMG_URL . ''
            ),
            'nav' => 'aboutus',
            'styles' => array(
                'plugins/font_awesome',
                COMPILED_ASSETS_PATH . 'css/components/bootstrap',
                COMPILED_ASSETS_PATH . 'css/components/fontawesome',
                COMPILED_ASSETS_PATH . 'css/components/owl',
                COMPILED_ASSETS_PATH . 'css/components/bootstrap-main',
                COMPILED_ASSETS_PATH . 'css/components/bootstrap-select',
                COMPILED_ASSETS_PATH . 'css/components/buttons',
                COMPILED_ASSETS_PATH . 'css/components/global',
                COMPILED_ASSETS_PATH . 'css/components/animations',
                COMPILED_ASSETS_PATH . 'css/components/timeline',
                COMPILED_ASSETS_PATH . 'css/components/navigation_bar',
                COMPILED_ASSETS_PATH . 'css/components/footer',
                COMPILED_ASSETS_PATH . 'css/pages/contact'
            )
        ))
        .view('Pages/contact', $data)
        .view('components/scripts_render', array(
            'scripts' => array(
                'https://code.jquery.com/jquery-3.5.1.min.js' => array(
                    'integrity' => 'sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=',
                    'crossorigin' => 'anonymous'
                ),
                ASSETS_URL . 'js/plugins/popper.min.js',
                'https://code.highcharts.com/maps/highmaps.js',
                'https://code.highcharts.com/maps/modules/exporting.js',
                'https://www.google.com/recaptcha/api.js?render='.$genSettings['recaptcha_site_key'],
                ASSETS_URL . 'js/plugins/bootstrap/bootstrap.min.js',
                ASSETS_URL . 'js/plugins/bootstrap-select.min.js',
                ASSETS_URL . 'js/components/global.min.js',
                ASSETS_URL . 'js/plugins/owl.carousel.min.js',
                ASSETS_URL . 'js/components/wow.min.js',
                ASSETS_URL . 'js/plugins/timeline.min.js',
                ASSETS_URL . 'js/components/navigation_bar.min.js',
                ASSETS_URL . '../admin/plugins/jquery-validation/jquery.validate.min.js',
                ASSETS_URL . 'js/pages/contact.min.js?135341',
            )
        ))
        .view('components/footer');
    }

    //maintenance mode
    public function maintenance()
    {
        return view('maintenance');
    }


    public function send_message(){
        $data = [
            'message' => 'Invalid request.',
            'success' => 0,
            'csrfName' => csrf_token(),
            'csrfHash' => csrf_hash()
        ];

        if($this->request->isAJAX() && $this->request->getMethod() === 'post'){
            $postData = $this->request->getPost();
            $validation =  \Config\Services::validation();
            $rules = [
                'name' => [
                    'label' => 'Name',
                    'rules'  => 'required',
                ],
                'emailRecipient' => [
                    'label' => 'Email Recipient',
                    'rules'  => 'required',
                ],
                'organisation' => [
                    'label' => 'Organisation',
                    'rules' => 'required'
                ],
                'email' => [
                    'label' => 'Email Address',
                    'rules' => 'required'
                ],
                'message' => [
                    'label' => 'Message',
                    'rules' => 'required'
                ],
            ];


            if($this->validate($rules)) {
                $genSettingsModel = new GeneralSettingModel();
                $genSettings = $genSettingsModel->find(1);

                
                $secret_key = $genSettings['recaptcha_secret_key']; // Replace with your secret key from reCAPTCHA admin console
                $verify_url = 'https://www.google.com/recaptcha/api/siteverify';

                $c_data = array(
                    'secret' => $secret_key,
                    'response' => $this->request->getPost('g-recaptcha-response'),
                    'remoteip' => $_SERVER['REMOTE_ADDR'] // Optional: User's IP address
                );

                $options = array(
                    'http' => array(
                        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                        'method'  => 'POST',
                        'content' => http_build_query($c_data)
                    )
                );

                $context  = stream_context_create($options);
                $result = file_get_contents($verify_url, false, $context);
                $captcha_response_data = json_decode($result, true);
                if($captcha_response_data['success'] == 1){
                    // $mail = new PHPMailer(true);
                    try{

                        $emailModel = new EmailModel();
                        $email = $postData['emailRecipient'];
                        $subject = 'General Enquiry to MIMS';
                        
                        $message = '
                            <strong>Name:</strong><br>
                            '.$postData['name'].'<br><br>
                            <strong>Organisation:</strong><br>
                            '.$postData['organisation'].'<br><br>
                            <strong>Email:</strong><br>
                            '.$postData['email'].'<br><br>
                            <strong>Message:</strong><br>
                            '.$postData['message'].'<br><br><br>

                            --<br>
                            This e-mail was sent from an enquiry form on MIMS Corporate Website.
                        ';
                        if ($emailModel->send_test_email($email, $subject, $message)) {
                        
                            $data['message'] = 'Message sent';
                            $data['success'] = 1;
                        }
                    //     $mail->isSMTP();
                    //     $mail->Host = $genSettings['mail_host'];
                    //     $mail->SMTPAuth = true;
                    //     $mail->Username = $genSettings['mail_username'];
                    //     $mail->Password = $genSettings['mail_password'];
                    //     $mail->SMTPSecure = 'tls';
                    //     $mail->CharSet = 'UTF-8';
                    //     $mail->Port = $genSettings['mail_port'];
                    //     $mail->setFrom($genSettings['mail_reply_to'], $genSettings['mail_title']);
                    //     $mail->isHTML(true);
                    //     $mail->Subject = 'MIMS Corporate::Inquiry';
                    //     $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
                    //     $mail->addAddress('pauljohn.angat@mims.com');

                    }catch (MAILER_Exception $e) {
                        if ($e) {
                            $data['message'] = 'Unable to send message. Please try again later.';
                        }
                    }


                }else{
                    $data['message'] = 'Invalid recaptcha response. Please refresh the page.';
                }
            }else{
                $errors = $this->validator->getErrors();
                $errorsArr = [];
                foreach($errors as $error){
                    $errorsArr[] = $error;
                }
                $data['message'] = 'Please check the following errors below:';
                $data['errors'] = $errorsArr;
            }


        }

        return $this->response->setJSON($data);

    }
}
