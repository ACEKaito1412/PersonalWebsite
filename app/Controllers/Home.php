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

    public function test()
    {

        helper('filesystem');
        $imageFolder = './public/uploads';
        $images = directory_map($imageFolder);

        $imageFiles = array();
        foreach ($images as $file) {
            $fileInfo = pathinfo($file);
            $extension = strtolower($fileInfo['extension']);
            if (in_array($extension, array('jpg', 'jpeg', 'png', 'gif'))) {
                $imageFiles[] = $file;
            }
        }


        $images = json_encode($imageFiles);

        return $images;
    }

    public function save_item()
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

    public function delete_item()
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
}
