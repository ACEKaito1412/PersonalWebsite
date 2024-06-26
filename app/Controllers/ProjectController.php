<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProjectModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\ResponseInterface;

class ProjectController extends BaseController
{
    protected $project_model;

    public function __construct()
    {
        $this->project_model = new ProjectModel();
    }

    public function index()
    {
        $res = $this->project_model->groupBy('created_at', 'DESC')->findAll();

        $data = [
            'page_title' => "Projects",
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
        $project = $this->project_model->find($id);

        if ($project != null) {
            $images = $this->getImages();
            $data = [
                'page_title' => "Projects " . $id,
                'admin' => $this->checkAdmin(),
                'project' => $project,
                'page' => 'pages/openProject',
                'images' => $images,
                'breadCrumbs' => true
            ];

            echo view('/partials/header', $data);
            echo view('/partials/nav', $data);
            echo view('/partials/footer', $data);
        } else {
            throw PageNotFoundException::forPageNotFound("We can't find this page that your looking for.");
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
}
