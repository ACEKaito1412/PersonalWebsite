<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PostModel;
use CodeIgniter\HTTP\ResponseInterface;

class PostController extends BaseController
{

    private $post_model;
    public function __construct()
    {
        $this->post_model = new PostModel();
    }


    public function index()
    {
        $images = $this->getImages();
        $res = $this->post_model->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'page_title' => "All Post",
            'admin' => $this->checkAdmin(),
            'post' => $res,
            'page' => 'pages/post',
            'breadCrumbs' => true,
            'images' => $images
        ];

        echo view('/partials/header', $data);
        echo view('/partials/nav', $data);
        echo view('/partials/footer', $data);
    }

    public function openPost($postId)
    {
        $res = $this->post_model->find($postId);
        $images = $this->getImages();
        if ($res != null) {
            $data = [
                'page_title' => "Open Post " . $postId,
                'admin' => $this->checkAdmin(),
                'post' => $res,
                'page' => 'pages/openPost',
                'breadCrumbs' => true,
                'images' => $images
            ];

            echo view('/partials/header', $data);
            echo view('/partials/nav', $data);
            echo view('/partials/footer', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('We Cant Find What Your Looking For');
        }
    }
}
