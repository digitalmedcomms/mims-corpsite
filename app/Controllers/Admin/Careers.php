<?php

namespace App\Controllers\Admin;


use App\Models\LeaderTypesModel;
use App\Models\CareersModel;
use App\Models\OfficesModel;


class Careers extends AdminController
{

    public function __construct()
    {
        $this->leaderTypes = new LeaderTypesModel();
        $this->careers = new CareersModel();
    }

    public function index(){
        
        $data = array_merge($this->data, [
            'title'     => trans('careers'),
            'active_tab'     => 'careers',
        ]);

        $officeObj = new OfficesModel();
        $offices = $officeObj->findAll();

        $data['offices'] = $offices;
        $data['job_types'] = $this->careers->job_types;
        $data['job_locations'] = $this->careers->job_locations;

        return view('admin/careers/index', $data);

    }

    public function edit($id = ''){
        if(!empty($id)){

            $career = $this->careers->find($id);
            if(!empty($career)){
                $data = array_merge($this->data, [
                    'title'     => trans('careers'),
                    'active_tab'     => 'careers',
                ]);
                $data['career'] = $career;
                $officeObj = new OfficesModel();
                $offices = $officeObj->findAll();

                $data['offices'] = $offices;
                $data['job_types'] = $this->careers->job_types;
                $data['job_locations'] = $this->careers->job_locations;

                return view('admin/careers/edit', $data);
            }else{
                return redirect()->to('admin/careers');
            }
        }else{
            return redirect()->to('admin/careers');
        }
    }

    public function insert(){
        if($this->request->getMethod() === 'post'){

            
            $item = [
                'job_title' => $this->request->getPost('job_title'),
                'job_description' => $this->request->getPost('job_description'),
                'job_type' => $this->request->getPost('job_type'),
                'job_location' => $this->request->getPost('job_location'),
                'office_id' => $this->request->getPost('office_id'),
                'link' => $this->request->getPost('link'),
                'status' => $this->request->getPost('status'),
            ];

            $this->careers->save($item);

            $this->session->setFlashData('success', trans("careers") . " " . trans("msg_suc_updated"));
            $this->session->setFlashData("mes_settings", 1);

            return redirect()->to('admin/careers');
        }else{
            return redirect()->to('admin/careers');
        }
    }
    
    public function update($id = ''){
        if(!empty($id)){
            if($this->request->getMethod() === 'post'){
                
                $item = [
                    'job_title' => $this->request->getPost('job_title'),
                    'job_description' => $this->request->getPost('job_description'),
                    'job_type' => $this->request->getPost('job_type'),
                    'job_location' => $this->request->getPost('job_location'),
                    'office_id' => $this->request->getPost('office_id'),
                    'link' => $this->request->getPost('link'),
                    'status' => $this->request->getPost('status'),
                ];


                $this->careers->set($item)->where('id', $id)->update();

                $this->session->setFlashData('success', trans("careers") . " " . trans("msg_suc_updated"));
                $this->session->setFlashData("mes_settings", 1);

                return redirect()->to('admin/careers');
            }else{
                return redirect()->to('admin/careers');
            }
        }else{
            return redirect()->to('admin/careers');
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
        $data = $this->careers->listing($input);

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