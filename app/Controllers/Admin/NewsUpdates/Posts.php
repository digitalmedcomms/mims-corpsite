<?php

namespace App\Controllers\Admin\NewsUpdates;


use App\Controllers\Admin\AdminController;
use App\Models\LeaderTypesModel;
use App\Models\PostCategoriesModel;
use App\Models\PostsModel;


class Posts extends AdminController
{

    public function __construct()
    {
        $this->postCategories = new PostCategoriesModel();
        $this->posts = new PostsModel();
    }

    public function index(){
        
        $data = array_merge($this->data, [
            'title'     => trans('posts'),
            'active_tab'     => 'posts',
        ]);

        return view('admin/news-updates/posts/index', $data);

    }
    public function add(){

        $data = array_merge($this->data, [
            'title'     => trans('posts'),
            'active_tab'     => 'posts',
        ]);
        $data['categories'] = $this->postCategories->where('status', 1)->findAll();
        return view('admin/news-updates/posts/add', $data);
}

    public function edit($id = ''){
        if(!empty($id)){

            $post = $this->posts->find($id);
            if(!empty($post)){
                $data = array_merge($this->data, [
                    'title'     => trans('posts'),
                    'active_tab'     => 'posts',
                ]);
                $data['post'] = $post;
                $data['categories'] = $this->postCategories->where('status', 1)->findAll();
                
                return view('admin/news-updates/posts/edit', $data);
            }else{
                return redirect()->to('admin/news-updates/posts');
            }
        }else{
            return redirect()->to('admin/news-updates/posts');
        }
    }

    public function insert(){
        if($this->request->getMethod() === 'post'){
            $validation =  \Config\Services::validation();
            $rules = [
                'title' => [
                    'label' => 'Post Title',
                    'rules'  => 'required',
                ],
                'category_id' => [
                    'label' => 'Post Category',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => trans('form_validation_required'),
                    ],
                ],
                // 'image_id' => [
                //     'label'  => 'Profile Image',
                //     'rules'  => 'required',
                // ],
                'status' => [
                    'label' => 'Post Status',
                    'rules' => 'required'
                ],
                'short_description' => [
                    'label' => 'Post Short Description',
                    'rules' => 'required'
                ],
                'content' => [
                    'label' => 'Post Content',
                    'rules' => 'required'
                ],
                'image_path' => [
                    'label' => 'Featured Image',
                    'rules' => 'required'
                ],
                'post_date' => [
                    'label' => 'Post Date',
                    'rules' => 'required'
                ]
            ];


            if ($this->validate($rules)) {

                $item = [
                    'title' => $this->request->getPost('title'),
                    'content' => $this->request->getPost('content'),
                    'slug' => $this->request->getPost('slug'),
                    'date' => date("Y-m-d", strtotime($this->request->getPost('post_date'))),
                    'status' => $this->request->getPost('status'),
                    'short_description' => $this->request->getPost('short_description'),
                    'category_id' => $this->request->getPost('category_id'),
                    'featured_img_path' => $this->request->getPost('image_path'),
                    'featured_img_id' => $this->request->getPost('image_id'),
                    'user_id' => $this->data['user']->id
                ];
                $this->posts->save($item);

                $this->session->setFlashData('success', trans("posts") . " " . trans("msg_suc_updated"));
                $this->session->setFlashData("mes_settings", 1);

                return redirect()->to('admin/news-updates/posts');
            }else{
                $this->session->setFlashData('errors_form', $validation->listErrors());
                return redirect()->back()->withInput()->with('error', 'Unable to process your request.');
            }


            $this->postCategories->save($item);

            $this->session->setFlashData('success', trans("posts") . " " . trans("msg_suc_updated"));
            $this->session->setFlashData("mes_settings", 1);

            return redirect()->to('admin/news-updates/posts');
        }else{
            return redirect()->to('admin/news-updates/posts');
        }
    }
    
    public function update($id = ''){
        if(!empty($id)){
            if($this->request->getMethod() === 'post'){

                $validation =  \Config\Services::validation();
                $rules = [
                    'title' => [
                        'label' => 'Post Title',
                        'rules'  => 'required',
                    ],
                    'category_id' => [
                        'label' => 'Post Category',
                        'rules'  => 'required',
                        'errors' => [
                            'required' => trans('form_validation_required'),
                        ],
                    ],
                    // 'image_id' => [
                    //     'label'  => 'Profile Image',
                    //     'rules'  => 'required',
                    // ],
                    'short_description' => [
                        'label' => 'Post Short Description',
                        'rules' => 'required'
                    ],
                    'status' => [
                        'label' => 'Post Status',
                        'rules' => 'required'
                    ],
                    'content' => [
                        'label' => 'Post Content',
                        'rules' => 'required'
                    ],
                    'image_path' => [
                        'label' => 'Featured Image',
                        'rules' => 'required'
                    ],
                    'post_date' => [
                        'label' => 'Post Date',
                        'rules' => 'required'
                    ]
                ];


                if ($this->validate($rules)) {

                    $item = [
                        'title' => $this->request->getPost('title'),
                        'content' => $this->request->getPost('content'),
                        'date' => date("Y-m-d", strtotime($this->request->getPost('post_date'))),
                        'status' => $this->request->getPost('status'),
                        'category_id' => $this->request->getPost('category_id'),
                        'short_description' => $this->request->getPost('short_description'),
                        'featured_img_path' => $this->request->getPost('image_path'),
                        'featured_img_id' => $this->request->getPost('image_id'),
                        'user_id' => $this->data['user']->id
                    ];
                    $this->posts->set($item)->where('id', $id)->update();

                    $this->session->setFlashData('success', trans("posts") . " " . trans("msg_suc_updated"));
                    $this->session->setFlashData("mes_settings", 1);

                    return redirect()->to('admin/news-updates/posts');
                }else{
                    return redirect()->to('admin/news-updates/posts');
                }
            }else{
                return redirect()->to('admin/news-updates/posts');
            }
        }
    }

    public function tableListing(){
        $data = [];
        $input = $_POST;

        if (isset($input['length']) && !empty($input['length'])){
            $input['limit'] = $input['length'];
        }

        if (isset($module_id) && !empty($module_id)){
            $input['module_id'] = $module_id;
        }
        
        $data = $this->posts->listing($input);

        if(empty($data)){
            $data['data'] = [];
            $data['recordsTotal'] = 0;
            $data['recordsFiltered'] = 0;
        }

        $data['draw'] = $input['draw'];

        echo  json_encode($data);
        exit;
    }
}