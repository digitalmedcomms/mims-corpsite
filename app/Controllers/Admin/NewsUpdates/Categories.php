<?php

namespace App\Controllers\Admin\NewsUpdates;


use App\Controllers\Admin\AdminController;
use App\Models\LeaderTypesModel;
use App\Models\PostCategoriesModel;


class Categories extends AdminController
{

    public function __construct()
    {
        $this->postCategories = new PostCategoriesModel();
    }

    public function index(){
        
        $data = array_merge($this->data, [
            'title'     => trans('categories'),
            'active_tab'     => 'categories',
        ]);

        return view('admin/news-updates/categories/index', $data);

    }

    public function edit($id = ''){
        if(!empty($id)){

            $postCategory = $this->postCategories->find($id);
            if(!empty($postCategory)){
                $data = array_merge($this->data, [
                    'title'     => trans('categories'),
                    'active_tab'     => 'categories',
                ]);
                $data['postCategory'] = $postCategory;
                return view('admin/news-updates/categories/edit', $data);
            }else{
                return redirect()->to('admin/news-updates/categories');
            }
        }else{
            return redirect()->to('admin/news-updates/categories');
        }
    }

    public function insert(){
        if($this->request->getMethod() === 'post'){
            $item = [
                'name' => $this->request->getPost('name'),
                'slug' => $this->request->getPost('slug'),
                'status' => $this->request->getPost('status'),
            ];

            $this->postCategories->save($item);

            $this->session->setFlashData('success', trans("categories") . " " . trans("msg_suc_updated"));
            $this->session->setFlashData("mes_settings", 1);

            return redirect()->to('admin/news-updates/categories');
        }else{
            return redirect()->to('admin/news-updates/categories');
        }
    }
    
    public function update($id = ''){
        if(!empty($id)){
            if($this->request->getMethod() === 'post'){
                $item = [
                    'name' => $this->request->getPost('name'),
                    'slug' => $this->request->getPost('slug'),
                    'status' => $this->request->getPost('status'),
                ];

                $this->postCategories->set($item)->where('id', $id)->update();

                $this->session->setFlashData('success', trans("categories") . " " . trans("msg_suc_updated"));
                $this->session->setFlashData("mes_settings", 1);

                return redirect()->to('admin/news-updates/categories');
            }else{
                return redirect()->to('admin/news-updates/categories');
            }
        }else{
            return redirect()->to('admin/news-updates/categories');
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
        $data = $this->postCategories->listing($input);

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