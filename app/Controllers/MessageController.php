<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MessageModel;
use CodeIgniter\HTTP\ResponseInterface;

class MessageController extends BaseController
{
    protected $message_model;
    public function __construct()
    {
        $this->message_model = new MessageModel();
    }

    public function index()
    {
        if ($this->checkAdmin()) {

            $res = $this->message_model->orderBy('created_at', 'DESC')->findAll();

            $data = [
                'page_title' => "Messages",
                'admin' => $this->checkAdmin(),
                'page' => 'pages/messages',
                'messages' =>  $res,
                'breadCrumbs' => true
            ];

            echo view('/partials/header', $data);
            echo view('/partials/nav', $data);
            echo view('/partials/footer', $data);
        } else {
            return redirect()->to(site_url('/'));
        }
    }

    public function send_message()
    {

        $name = $this->request->getVar('name');
        $email = $this->request->getVar('email');
        $subject = $this->request->getVar('subject');
        $body = $this->request->getVar('body');

        $data = [
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'body' => $body
        ];

        $res = $this->message_model->insert($data);

        if ($res) {
            if ($this->send_mail($email, $subject, $body)) {
                return $this->response->setStatusCode(200)->setJSON([
                    'message' => 'Message Save Succesfuly.'
                ]);
            }
        } else {
            return $this->response->setStatusCode(400)->setJSON([
                'message' => 'Error Occured.'
            ]);
        }
    }

    public function open_message()
    {
        $id = $this->request->getVar('id');

        $res = $this->message_model->find($id);

        if ($res) {
            $data = [
                'name' => $res['name'],
                'email' => $res['email'],
                'body' => $res['body'],
                'message' => 'Data Found with an ID of ' . $id
            ];

            return $this->response->setStatusCode(200)->setJSON($data);
        } else {
            return $this->response->setStatusCode(400)->setJSON([
                'messages' => 'Error While Getting Data with ID: ' . $id
            ]);
        }
    }

    private function send_mail($from, $subject, $message)
    {
        $container = "<div>
        <h1>You Have Received A Message</h1>
        <p>Subject: " . $subject . "</p>
        <p>From: " . $from . "</p>"
            . $message .
            "</div>";

        $email = \Config\Services::email();

        $email->setFrom(getenv('CI_EMAIL'), 'JCFM');
        $email->setTo("jhuncarlomacdon@gmail.com");

        $email->setSubject("New Message");
        $email->setMessage($container);

        if ($email->send()) {
            return true;
        } else {
            return false;
        }
    }
}
