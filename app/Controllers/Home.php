<?php

namespace App\Controllers;

use App\Models\MessageModel;
use App\Models\PostModel;
use App\Models\ProjectModel;
use Exception;
use PDO;

use function PHPSTORM_META\type;

class Home extends BaseController
{

    protected $post_model;
    protected $project_model;

    public function __construct()
    {
        $this->post_model = new PostModel();
        $this->project_model = new ProjectModel();
    }


    private function checkAdmin()
    {
        if ($this->session->get('admin_id') == null) {
            return false;
        } else {
            return true;
        }
    }

    public function index()
    {
        $data = [
            'page_title' => "Home",
            'admin' => $this->checkAdmin(),
            'page' => 'pages/home',
            'breadCrumbs' => false
        ];
        echo view('/partials/header', $data);
        echo view('/partials/nav', $data);
        echo view('/partials/footer', $data);
    }
    public function post()
    {
        $res = $this->post_model->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'page_title' => "Home",
            'admin' => $this->checkAdmin(),
            'post' => $res,
            'page' => 'pages/post',
            'breadCrumbs' => true,
        ];

        echo view('/partials/header', $data);
        echo view('/partials/nav', $data);
        echo view('/partials/footer', $data);
    }

    public function openPost($postId)
    {
        $res = $this->post_model->find($postId);

        if ($res != null) {
            $data = [
                'page_title' => "Home",
                'admin' => $this->checkAdmin(),
                'post' => $res,
                'page' => 'pages/openPost',
                'breadCrumbs' => true
            ];

            echo view('/partials/header', $data);
            echo view('/partials/nav', $data);
            echo view('/partials/footer', $data);
        } else {
            return redirect()->to(site_url('/all_post'));
        }
    }

    public function projects()
    {
        $uri = $this->request->getUri();

        $res = $this->project_model->groupBy('created_at', 'DESC')->findAll();

        $data = [
            'page_title' => "Home",
            'admin' => $this->checkAdmin(),
            'page' => 'pages/projects',
            'projects' => ($res ? $res : ""),
            'breadCrumbs' => true
        ];

        echo view('/partials/header', $data);
        echo view('/partials/nav', $data);
        echo view('/partials/footer', $data);
    }

    public function openProject($id)
    {
        $res = $this->project_model->find($id);

        $data = [
            'page_title' => "Home",
            'admin' => $this->checkAdmin(),
            'project' => $res,
            'page' => 'pages/openProject',
            'breadCrumbs' => true
        ];

        echo view('/partials/header', $data);
        echo view('/partials/nav', $data);
        echo view('/partials/footer', $data);
    }

    public function save_post()
    {
        $json_data = $this->request->getVar('json_data');
        $type = $this->request->getVar('type');
        $update = $this->request->getVar('transaction');;
        $id = $this->request->getVar('id');

        $j_data = json_decode($json_data, true);


        if ($type == 'post') {
            $header = '';
            foreach ($j_data as $item) {
                if ($item['type'] == 'h1') {
                    $header = $item['content'];
                }
            }
            try {
                $data = [
                    'head' => $header,
                    'content' => $json_data,
                    'user_id' => $this->session->get('admin_id')
                ];

                if ($update == 'update') {
                    $res = $this->post_model->update($id, $data);
                } else {
                    $res = $this->post_model->insert($data);
                }

                if ($res) {
                    echo 'Save Completed';
                } else {
                    echo 'Error While Saving';
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        } else {
            $data = [
                'content' => $json_data
            ];

            if ($update == 'update') {
                $res = $this->project_model->update($id, $data);
                echo 'Save Completed';
            }

            echo 'Error while saving';
        }
    }

    public function save_project()
    {
        $image = $this->request->getVar('image');
        $title = $this->request->getVar('title');
        $description = $this->request->getVar('description');
        $category = $this->request->getVar('category');

        $data = [
            "title" => $title,
            "description" => $description,
            "category" => $category,
            "img_src" => $image
        ];

        $res = $this->project_model->insert($data);

        if ($res) {
            return $this->response->setStatusCode(200)->setJSON(['message' => "Save Completed"]);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['message' => "Error While Saving"]);
        }
    }

    public function delete_post()
    {

        $id = $this->request->getVar('id');
        $type = $this->request->getVar('type');

        if ($id && $type == 'post') {
            $post_model = new PostModel();
            $res = $post_model->delete($id);
            if ($res) {
                return 'Deleted';
            }
        } else {
            $project_model = new ProjectModel();
            $res = $project_model->delete(['id' => $id]);
            if ($res) {
                return 'Deleted';
            }
        }

        return 'Error Occured';
    }

    public function upload_image()
    {
        $uploadedFile = $this->request->getFile('image');
        if ($uploadedFile->isValid() && !$uploadedFile->hasMoved()) {
            $newName = $uploadedFile->getRandomName();
            $uploadedFile->move(ROOTPATH . 'public/uploads', $newName);

            return $this->response->setStatusCode(200)->setJSON(['message' => 'Image uploaded successfully', 'filePath' => $newName]);
        } else {
            // Return an error response if the file is not valid
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Invalid file']);
        }
    }

    public function send_message()
    {
        $message_model = new MessageModel();

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

        $res = $message_model->insert($data);

        if ($res) {
            return $this->response->setStatusCode(200)->setJSON([
                'message' => 'Message Save Succesfuly.'
            ]);
        } else {
            return $this->response->setStatusCode(400)->setJSON([
                'message' => 'Error Occured.'
            ]);
        }
    }

    public function messages()
    {
        if ($this->checkAdmin()) {
            $message_model = new MessageModel();

            $res = $message_model->orderBy('created_at', 'DESC')->findAll();

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

    public function open_message()
    {
        $message_model = new MessageModel();
        $id = $this->request->getVar('id');

        $res = $message_model->find($id);

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

    public function send_mail()
    {
        // $to = $this->request->getVar('email');
        $to = "catherinedevenecia83@gmail.com";
        $subject = "Email Test 2";
        $message = "Testing from the website. Love you wabb wabb wabb wabb";

        $email = \Config\Services::email();

        $email->setFrom('macdon.jc.bscs@gmail.com', 'JCFM');
        $email->setTo($to);

        $email->setSubject($subject);
        $email->setMessage($message);

        if ($email->send()) {
            echo 'Email successfully sent';
        } else {
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }
    }
}
