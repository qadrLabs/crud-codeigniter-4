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

    public function create()
    {
        $data = [
            'title' => 'Create new post'
        ];

        return view('posts/create', $data);
    }

    public function store()
    {
        $title = $this->request->getPost('title');
        $content = $this->request->getPost('content');
        $status = $this->request->getPost('status');

        $post = [
            'title' => $title,
            'content' => $content,
            'status' => $status,
            'slug' => url_title(strtolower($title))
        ];

        $save = $this->model->save($post);

        if ($save) {
            session()->setFlashdata('success', 'Post has been added successfully.');
            return redirect()->to(base_url('post'));
        } else {
            session()->setFlashdata('error', 'Some problem occured, please try again');
            return redirect()->back();
        }
    }

}