<?php

namespace App\Controllers\Admin;


use App\Models\CarouselModel;
use App\Models\CarouselDataModel;

class Carousel extends AdminController
{

    public function __construct()
    {
        $this->carousel = new CarouselModel();
        $this->carouselSlides = new CarouselDataModel();
    }

    public function index(){
        
        $data = array_merge($this->data, [
            'title'     => trans('carousel'),
            'active_tab'     => 'carousel',
        ]);

        return view('admin/carousel/index', $data);

    }

    public function edit($id = ''){
        if(!empty($id)){

            $leaderType = $this->leaderTypes->find($id);
            if(!empty($leaderType)){
                $data = array_merge($this->data, [
                    'title'     => trans('leader_types'),
                    'active_tab'     => 'leader_types',
                ]);
                $data['leaderType'] = $leaderType;
                return view('admin/leader_types/edit', $data);
            }else{
                return redirect()->to('admin/carousel');
            }
        }else{
            return redirect()->to('admin/carousel');
        }
    }


    public function view($id = ''){
        if(!empty($id)){

            $carousel = $this->carousel->find($id);
            if(!empty($carousel)){
                $data = array_merge($this->data, [
                    'title'     => trans('carousel'),
                    'active_tab'     => 'carousel',
                ]);
                $data['carousel'] = $carousel;
                return view('admin/carousel/view', $data);
            }else{
                return redirect()->to('admin/carousel');
            }
        }else{
            return redirect()->to('admin/carousel');
        }
    }

    public function add_slide($carousel_id){
        if(!empty($carousel_id)){
            $carousel = $this->carousel->find($carousel_id);
            if(!empty($carousel)){
                $data = array_merge($this->data, [
                    'title'     => trans('carousel'),
                    'active_tab'     => 'carousel',
                ]);
                $data['carousel'] = $carousel;
                return view('admin/carousel/add_slide', $data);
            }else{
                return redirect()->to('admin/carousel');
            }

        }else{
            return redirect()->to('admin/carousel');
        }
    }

    public function edit_slide($slide_id){
        if(!empty($slide_id)){
            $carouselSlide = $this->carouselSlides->find($slide_id);
            if(!empty($carouselSlide)){
                $data = array_merge($this->data, [
                    'title'     => trans('carousel'),
                    'active_tab'     => 'carousel',
                ]);
                $data['carouselSlide'] = $carouselSlide;
                return view('admin/carousel/edit_slide', $data);
            }else{
                return redirect()->to('admin/carousel');
            }

        }else{
            return redirect()->to('admin/carousel');
        }
    }

    public function insert_slide($carousel_id){
        if($this->request->getMethod() === 'post' && !empty($carousel_id)){
            $validation =  \Config\Services::validation();
            $rules = [
                'title' => [
                    'rules'  => 'required',
                ],
                'image_id' => [
                    'label'  => 'Slide Image',
                    'rules'  => 'required',
                ],
                'description' => [
                    'rules' => 'required'
                ],
                'order' => [
                    'label' => 'Slide Order',
                    'rules' => 'required'
                ]
            ];

            $with_button = 0;
            $button_label = '';
            $button_link = '';
            if($this->request->getPost('with_button') == 1){
                $with_button = 1;
                $rules['button_label'] = ['rules'=>'required'];
                $rules['button_link'] = ['rules'=>'required'];

                $button_label =  $this->request->getPost('button_label');
                $button_link =  $this->request->getPost('button_link');
            }

            if ($this->validate($rules)) {
                $item = [
                    'carousel_id' => $carousel_id,
                    'title' => $this->request->getPost('title'),
                    'description' => $this->request->getPost('description'),
                    'image_id' => $this->request->getPost('image_id'),
                    'image_filepath' => $this->request->getPost('image_path'),
                    'slide_order' => $this->request->getPost('order'),
                    'with_button' => $with_button,
                    'button_label' => $button_label,
                    'button_link' => $button_link,
                    'status' => $this->request->getPost('status'),
                ];

                $this->carouselSlides->save($item);
            }else{
                $this->session->setFlashData('errors_form', $validation->listErrors());
                return redirect()->back()->withInput()->with('error', 'Unable to process your request.');
            }

            $this->session->setFlashData('success', trans("carousel") . " Slide " . trans("msg_suc_added"));
            $this->session->setFlashData("mes_settings", 1);

            return redirect()->to('admin/carousel/view/'.$carousel_id);
        }else{
            return redirect()->to('admin/carousel/view/'.$carousel_id);
        }
        
    }
    
    public function update($id = ''){
        if(!empty($id)){
            if($this->request->getMethod() === 'post'){
                $item = [
                    'name' => $this->request->getPost('name'),
                    'status' => $this->request->getPost('status'),
                ];

                $this->leaderTypes->set($item)->where('id', $id)->update();

                $this->session->setFlashData('success', trans("leader_types") . " " . trans("msg_suc_updated"));
                $this->session->setFlashData("mes_settings", 1);

                return redirect()->to('admin/carousel');
            }else{
                return redirect()->to('admin/carousel');
            }
        }else{
            return redirect()->to('admin/carousel');
        }
    }

    public function update_slide($slide_id){
        if($this->request->getMethod() === 'post' && !empty($slide_id)){
            $carouselSlide = $this->carouselSlides->find($slide_id);
            $validation =  \Config\Services::validation();
            $rules = [
                'title' => [
                    'rules'  => 'required',
                ],
                'image_id' => [
                    'label'  => 'Slide Image',
                    'rules'  => 'required',
                ],
                'description' => [
                    'rules' => 'required'
                ],
                'order' => [
                    'label' => 'Slide Order',
                    'rules' => 'required'
                ]
            ];

            $with_button = 0;
            $button_label = '';
            $button_link = '';
            if($this->request->getPost('with_button') == 1){
                $with_button = 1;
                $rules['button_label'] = ['rules'=>'required'];
                $rules['button_link'] = ['rules'=>'required'];

                $button_label =  $this->request->getPost('button_label');
                $button_link =  $this->request->getPost('button_link');
            }

            if ($this->validate($rules)) {
                $item = [
                    'title' => $this->request->getPost('title'),
                    'description' => $this->request->getPost('description'),
                    'image_id' => $this->request->getPost('image_id'),
                    'image_filepath' => $this->request->getPost('image_path'),
                    'slide_order' => $this->request->getPost('order'),
                    'with_button' => $with_button,
                    'button_label' => $button_label,
                    'button_link' => $button_link,
                    'status' => $this->request->getPost('status'),
                ];
                $this->carouselSlides->set($item)->where('id', $slide_id)->update();
            }else{
                $this->session->setFlashData('errors_form', $validation->listErrors());
                return redirect()->back()->withInput()->with('error', 'Unable to process your request.');
            }

            $this->session->setFlashData('success', trans("carousel") . " Slide " . trans("msg_suc_updated"));
            $this->session->setFlashData("mes_settings", 1);

            return redirect()->to('admin/carousel/view/'.$carouselSlide['carousel_id']);
        }else{
            return redirect()->to('admin/carousel/view/'.$carouselSlide['carousel_id']);
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
        $data = $this->carousel->listing($input);

        if(empty($data)){
            $data['data'] = [];
            $data['recordsTotal'] = 0;
            $data['recordsFiltered'] = 0;
        }

        $data['draw'] = $input['draw'];

        echo  json_encode($data);
        exit;
    }


    public function tableListingDetails($carousel_id){
        $data = [];
        $input = $_POST;

        if (isset($input['length']) && !empty($input['length'])){
            $input['limit'] = $input['length'];
        }
        $input['carousel_id'] = $carousel_id;
        $data = $this->carouselSlides->listing($input);

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