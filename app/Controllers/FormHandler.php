<?php

namespace App\Controllers;

use App\Models\FormsModel;
use CodeIgniter\API\ResponseTrait;

class FormHandler extends BaseController
{
    use ResponseTrait;

    public function submit($id)
    {
        $formsModel = new FormsModel();
        $form = $formsModel->where('id', $id)->where('status', 1)->first();

        if (empty($form)) {
            return $this->failNotFound('Form not found or inactive.');
        }

        $submittedData = $this->request->getPost();
        
        // Remove CSRF token from data if present
        unset($submittedData[csrf_token()]);

        // Here you would typically save the submission to a database table if needed.
        // For now, let's assume we just handle notifications.

        if ($form['enable_notification'] == 1) {
            $this->sendNotification($form, $submittedData);
        }

        $message = $form['enable_confirmation'] == 1 ? $form['confirmation_message'] : 'Form submitted successfully!';

        return $this->respond([
            'status' => 'success',
            'message' => $message
        ]);
    }

    private function sendNotification($form, $data)
    {
        $email = \Config\Services::email();

        $fromEmail = !empty($form['notification_from_email']) ? $form['notification_from_email'] : $this->generalSettings['contact_email'];
        $fromName = !empty($form['notification_from_name']) ? $form['notification_from_name'] : $this->generalSettings['application_name'];

        $email->setFrom($fromEmail, $fromName);
        $email->setTo($form['notification_email']);

        if (!empty($form['notification_cc'])) {
            $email->setCC($form['notification_cc']);
        }

        $email->setSubject($form['notification_subject']);

        $message = $form['notification_message'];
        $message .= "<br><br><strong>Submitted Data:</strong><br><ul>";
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $value = implode(', ', $value);
            }
            $message .= "<li><strong>" . ucfirst(str_replace('_', ' ', $key)) . ":</strong> " . htmlspecialchars($value) . "</li>";
        }
        $message .= "</ul>";

        $email->setMessage($message);

        $email->send();
    }
}
