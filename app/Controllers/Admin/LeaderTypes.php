<?php

namespace App\Controllers\Admin;


use App\Models\LeaderTypesModel;


class LeaderTypes extends AdminController
{

    public function __construct()
    {
        $this->leaderTypes = new LeaderTypesModel();
    }

    public function index(){
        
        $data = array_merge($this->data, [
            'title'     => trans('leader_types'),
            'active_tab'     => 'leader_types',
        ]);

        return view('admin/leader_types/index', $data);

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
                return redirect()->to('admin/leader-types');
            }
        }else{
            return redirect()->to('admin/leader-types');
        }
    }

    public function insert(){
        if($this->request->getMethod() === 'post'){
            $item = [
                'name' => $this->request->getPost('name'),
                'status' => $this->request->getPost('status'),
            ];

            $this->leaderTypes->save($item);

            $this->session->setFlashData('success', trans("leader_types") . " " . trans("msg_suc_updated"));
            $this->session->setFlashData("mes_settings", 1);

            return redirect()->to('admin/leader-types');
        }else{
            return redirect()->to('admin/leader-types');
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

                return redirect()->to('admin/leader-types');
            }else{
                return redirect()->to('admin/leader-types');
            }
        }else{
            return redirect()->to('admin/leader-types');
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
        $data = $this->leaderTypes->listing($input);

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