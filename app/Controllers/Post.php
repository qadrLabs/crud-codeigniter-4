<?php namespace App\Controllers;

use App\Models\PostModel;
use CodeIgniter\Model;

class Post extends BaseController
{
    /**
     * @var Model
     */
    protected $model;

    public function __construct()
    {
        $this->model = new PostModel();
        $this->helpers = ['form', 'url'];
    }

    public function index()
    {
        $data = [
            'posts' => $this->model->paginate(10),
            'pager' => $this->model->pager,
            'title' => 'Post List'
        ];

        return view('posts/index', $data);
    }

}