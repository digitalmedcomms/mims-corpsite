<?php

namespace App\Controllers\Admin;


use App\Models\LeadersModel;
use App\Models\LeaderTypesModel;
use App\Models\Locations\CountryModel;
use App\Models\PracticeModel;


class Forms extends AdminController
{

    public function __construct()
    {
        $this->leaderTypes = new LeaderTypesModel();
        $this->leaders = new LeadersModel();
        $this->countries = new CountryModel();
        $this->practices = new PracticeModel();
    }

    public function index(){
        $data = array_merge($this->data, [
            'title'     => trans('forms'),
            'active_tab'     => 'forms',
        ]);

        return view('admin/forms/index', $data);
    }


    public function add(){
        
        $data = array_merge($this->data, [
            'title'     => trans('forms'),
            'active_tab'     => 'forms',
        ]);
        $leaderTypes = $this->leaderTypes->where(['status' => 1])->findAll();
        $data['countries'] = $this->countries->where(['status' => 1])->findAll();
        $data['practices'] = $this->practices->where(['status' => 1])->findAll();
        $data['leaderTypes'] = $leaderTypes;

        return view('admin/forms/add', $data);
    }

    public function edit($id = ''){
        if(!empty($id)){

            $leader = $this->leaders->find($id);
            if(!empty($leader)){
                $data = array_merge($this->data, [
                    'title'     => trans('leader_types'),
                    'active_tab'     => 'leader_types',
                ]);
                $data['countries'] = $this->countries->where(['status' => 1])->findAll();
                $data['practices'] = $this->practices->where(['status' => 1])->findAll();
                $data['leaderTypes'] = $this->leaderTypes->where(['status' => 1])->findAll();
                $leader['countries'] = explode(",", $leader['countries']);
                $data['leader'] = $leader;
                return view('admin/leaders/edit', $data);
            }else{
                return redirect()->to('admin/leaders');
            }
        }else{
            return redirect()->to('admin/leaders');
        }
    }


    public function insert(){
        if($this->request->getMethod() === 'post'){
            $validation =  \Config\Services::validation();
            $rules = [
                'name' => [
                    'rules'  => 'required',
                ],
                'leader_type_id' => [
                    'label' => 'Leader Type',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => trans('form_validation_required'),
                    ],
                ],
                // 'image_id' => [
                //     'label'  => 'Profile Image',
                //     'rules'  => 'required',
                // ],
                'biography' => [
                    'rules' => 'required'
                ],
                'designation' => [
                    'rules' => 'required'
                ]
            ];

            $countries = '';
            $practice = 0;
            if($this->request->getPost('leader_type_id') == 2){
                $rules['countries'] = ['rules' => 'required'];
                if($this->request->getPost('countries')){
                    $countries = implode(",", $this->request->getPost('countries'));
                }
            }else if($this->request->getPost('leader_type_id') == 3){
                $rules['practice'] = ['rules' => 'required'];
                $practice = $this->request->getPost('practice');
            }

            if ($this->validate($rules)) {
                $item = [
                    'leader_type_id' => $this->request->getPost('leader_type_id'),
                    'image_path' => $this->request->getPost('image_path'),
                    'image_id' => $this->request->getPost('image_id') ?? 0,
                    'practice' => $practice,
                    'countries' => $countries,
                    'name' => $this->request->getPost('name'),
                    'designation' => $this->request->getPost('designation'),
                    'biography' => $this->request->getPost('biography'),
                    'order' => $this->request->getPost('order'),
                    'status' => $this->request->getPost('status'),
                ];
                $this->leaders->save($item);

                $this->session->setFlashData('success', trans("leaders") . " " . trans("msg_suc_updated"));
                $this->session->setFlashData("mes_settings", 1);

                return redirect()->to('admin/leaders');
            }else{
                $this->session->setFlashData('errors_form', $validation->listErrors());
                return redirect()->back()->withInput()->with('error', 'Unable to process your request.');
            }
        }else{
            return redirect()->to('admin/leaders');
        }
    }


    public function update($id = ''){
        if(!empty($id)){
            if($this->request->getMethod() === 'post'){
                $validation =  \Config\Services::validation();
                $rules = [
                    'name' => [
                        'rules'  => 'required',
                    ],
                    'leader_type_id' => [
                        'label' => 'Leader Type',
                        'rules'  => 'required',
                        'errors' => [
                            'required' => trans('form_validation_required'),
                        ],
                    ],
                    // 'image_id' => [
                    //     'label'  => 'Profile Image',
                    //     'rules'  => 'required',
                    // ],
                    'biography' => [
                        'rules' => 'required'
                    ],
                    'designation' => [
                        'rules' => 'required'
                    ]
                ];

                $countries = '';
                $practice = 0;
                if($this->request->getPost('leader_type_id') == 2){
                    $rules['countries'] = ['rules' => 'required'];
                    if($this->request->getPost('countries')){
                        $countries = implode(",", $this->request->getPost('countries'));
                    }
                }else if($this->request->getPost('leader_type_id') == 3){
                    $rules['practice'] = ['rules' => 'required'];
                    $practice = $this->request->getPost('practice');
                }
                if ($this->validate($rules)) {
                    $item = [
                        'leader_type_id' => $this->request->getPost('leader_type_id'),
                        'image_path' => $this->request->getPost('image_path'),
                        'image_id' => $this->request->getPost('image_id') ?? 0,
                        'practice' => $practice,
                        'countries' => $countries,
                        'name' => $this->request->getPost('name'),
                        'designation' => $this->request->getPost('designation'),
                        'biography' => $this->request->getPost('biography'),
                        'order' => $this->request->getPost('order'),
                        'status' => $this->request->getPost('status'),
                    ];
                    $this->leaders->set($item)->where('id', $id)->update();

                    $this->session->setFlashData('success', trans("leaders") . " " . trans("msg_suc_updated"));
                    $this->session->setFlashData("mes_settings", 1);

                    return redirect()->to('admin/leaders');
                }else{
                    $this->session->setFlashData('errors_form', $validation->listErrors());
                    return redirect()->back()->withInput()->with('error', 'Unable to process your request.');
                }
            }else{
                return redirect()->to('admin/leaders');
            }
        }else{
            return redirect()->to('admin/leaders');
        }
    }

    public function delete($id = ''){
        if(!empty($id)){
            $this->leaders->where('id', $id)->delete();
            $this->session->setFlashData('success', 'Leader was successfully deleted.');
            $this->session->setFlashData("mes_settings", 1);
            return redirect()->to('admin/leaders');
        }else{
            return redirect()->to('admin/leaders');
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
        $data = [];
        // $data = $this->leaders->listing($input);

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