<?php

namespace App\Controllers\Admin;


use App\Models\OfficesModel;
use App\Models\Locations\CountryModel;
use App\Models\PracticeModel;


class Offices extends AdminController
{

    public function __construct()
    {
        $this->offices = new OfficesModel();
        $this->countries = new CountryModel();
        $this->practices = new PracticeModel();
    }

    public function index(){
        $data = array_merge($this->data, [
            'title'     => trans('offices'),
            'active_tab'     => 'offices',
        ]);

        return view('admin/offices/index', $data);
    }


    public function add(){
        
        $data = array_merge($this->data, [
            'title'     => trans('offices'),
            'active_tab'     => 'offices',
        ]);
        $data['countries'] = $this->countries->where(['status' => 1])->findAll();
        return view('admin/offices/add', $data);
    }

    public function edit($id = ''){
        if(!empty($id)){

            $office = $this->offices->find($id);
            if(!empty($office)){
                $data = array_merge($this->data, [
                    'title'     => trans('leader_types'),
                    'active_tab'     => 'leader_types',
                ]);
                $data['countries'] = $this->countries->where(['status' => 1])->findAll();
                $data['office'] = $office;
                return view('admin/offices/edit', $data);
            }else{
                return redirect()->to('admin/offices');
            }
        }else{
            return redirect()->to('admin/offices');
        }
    }


    public function insert(){
        if($this->request->getMethod() === 'post'){
            $validation =  \Config\Services::validation();
            $rules = [
                'name' => [
                    'label' => 'Name',
                    'rules'  => 'required',
                ],
                'address' => [
                    'label' => 'Address',
                    'rules'  => 'required',
                ],
                'country_id' => [
                    'label' => 'Country',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => trans('form_validation_required'),
                    ],
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required'
                ],
            ];

            if ($this->validate($rules)) {
                $item = [
                    'country_id' => $this->request->getPost('country_id'),
                    'name' => $this->request->getPost('name'),
                    'address' => $this->request->getPost('address'),
                    'email' => $this->request->getPost('email'),
                    'contact_number' => $this->request->getPost('contact_number'),
                    'status' => $this->request->getPost('status'),
                ];
                $this->offices->save($item);

                $this->session->setFlashData('success', trans("offices") . " " . trans("msg_suc_updated"));
                $this->session->setFlashData("mes_settings", 1);

                return redirect()->to('admin/offices');
            }else{
                $this->session->setFlashData('errors_form', $validation->listErrors());
                return redirect()->back()->withInput()->with('error', 'Unable to process your request.');
            }
        }else{
            return redirect()->to('admin/offices');
        }
    }


    public function update($id = ''){
        if(!empty($id)){
            if($this->request->getMethod() === 'post'){
                $validation =  \Config\Services::validation();
                $rules = [
                    'name' => [
                        'label' => 'Name',
                        'rules'  => 'required',
                    ],
                    'address' => [
                        'label' => 'Address',
                        'rules'  => 'required',
                    ],
                    'country_id' => [
                        'label' => 'Country',
                        'rules'  => 'required',
                        'errors' => [
                            'required' => trans('form_validation_required'),
                        ],
                    ],
                    'email' => [
                        'label' => 'Email',
                        'rules' => 'required'
                    ],
                ];

                if ($this->validate($rules)) {
                    $item = [
                        'country_id' => $this->request->getPost('country_id'),
                        'name' => $this->request->getPost('name'),
                        'address' => $this->request->getPost('address'),
                        'email' => $this->request->getPost('email'),
                        'contact_number' => $this->request->getPost('contact_number'),
                        'status' => $this->request->getPost('status'),
                    ];
                    $this->offices->set($item)->where('id', $id)->update();

                    $this->session->setFlashData('success', trans("offices") . " " . trans("msg_suc_updated"));
                    $this->session->setFlashData("mes_settings", 1);

                    return redirect()->to('admin/offices');
                }else{
                    $this->session->setFlashData('errors_form', $validation->listErrors());
                    return redirect()->back()->withInput()->with('error', 'Unable to process your request.');
                }
            }else{
                return redirect()->to('admin/offices');
            }
        }else{
            return redirect()->to('admin/offices');
        }
    }

    public function delete($id = ''){
        if(!empty($id)){
            $this->offices->where('id', $id)->delete();
            $this->session->setFlashData('success', 'Office was successfully deleted.');
            $this->session->setFlashData("mes_settings", 1);
            return redirect()->to('admin/offices');
        }else{
            return redirect()->to('admin/offices');
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
        $data = $this->offices->listing($input);

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