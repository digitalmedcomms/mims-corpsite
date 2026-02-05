<?php

namespace App\Controllers\Admin;

use App\Models\FormsModel;

class Forms extends AdminController
{

    public function __construct()
    {
        $this->forms = new FormsModel();
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
        return view('admin/forms/add', $data);
    }

    public function edit($id = ''){
        if(!empty($id)){
            $form = $this->forms->find($id);
            if(!empty($form)){
                $data = array_merge($this->data, [
                    'title'     => trans('forms'),
                    'active_tab'     => 'forms',
                    'form'      => $form
                ]);
                return view('admin/forms/edit', $data);
            }else{
                return redirect()->to('admin/forms');
            }
        }else{
            return redirect()->to('admin/forms');
        }
    }


    public function insert(){
        if($this->request->getMethod() === 'post'){
            $validation =  \Config\Services::validation();
            $rules = [
                'form_name' => [
                    'rules'  => 'required|is_unique[forms.name]',
                ]
            ];

            if ($this->request->getPost('enable_confirmation')) {
                $rules['confirmation_message'] = [
                    'rules' => 'required',
                    'label' => 'Confirmation Message'
                ];
            }

            if ($this->request->getPost('enable_notification')) {
                $rules['notification_email'] = [
                    'rules' => 'required|valid_email',
                    'label' => 'Notification Email'
                ];
                $rules['notification_from_name'] = [
                    'rules' => 'required',
                    'label' => 'Notification From Name'
                ];
                $rules['notification_from_email'] = [
                    'rules' => 'required|valid_email',
                    'label' => 'Notification From Email'
                ];
                $rules['notification_subject'] = [
                    'rules' => 'required',
                    'label' => 'Notification Subject'
                ];
                $rules['notification_message'] = [
                    'rules' => 'required',
                    'label' => 'Notification Message'
                ];
            }

            if ($this->validate($rules)) {
                $item = [
                    'name' => $this->request->getPost('form_name'),
                    'description' => $this->request->getPost('form_description'),
                    'fields' => $this->request->getPost('fields'),
                    'confirmation_message' => $this->request->getPost('confirmation_message'),
                    'notification_email' => $this->request->getPost('notification_email'),
                    'notification_cc' => $this->request->getPost('notification_cc'),
                    'notification_from_name' => $this->request->getPost('notification_from_name'),
                    'notification_from_email' => $this->request->getPost('notification_from_email'),
                    'notification_subject' => $this->request->getPost('notification_subject'),
                    'notification_message' => $this->request->getPost('notification_message'),
                    'enable_confirmation' => $this->request->getPost('enable_confirmation') ? 1 : 0,
                    'enable_notification' => $this->request->getPost('enable_notification') ? 1 : 0,
                    'status' => $this->request->getPost('form_status'),
                ];
                $this->forms->insert($item);

                $this->session->setFlashData('success', trans("forms") . " " . trans("msg_suc_updated"));
                $this->session->setFlashData("mes_settings", 1);

                return redirect()->to('admin/forms');
            }else{
                $this->session->setFlashData('errors_form', $validation->listErrors());
                return redirect()->back()->withInput()->with('error', 'Unable to process your request.');
            }
        }else{
            return redirect()->to('admin/forms');
        }
    }


    public function update($id = ''){
        if(!empty($id)){
            if($this->request->getMethod() === 'post'){

                $validation =  \Config\Services::validation();
                $rules = [
                    'form_name' => [
                        'rules'  => 'required|is_unique[forms.name,id,'.$id.']',
                    ]
                ];

                if ($this->request->getPost('enable_confirmation')) {
                    $rules['confirmation_message'] = [
                        'rules' => 'required',
                        'label' => 'Confirmation Message'
                    ];
                }

                if ($this->request->getPost('enable_notification')) {
                    $rules['notification_email'] = [
                        'rules' => 'required|valid_email',
                        'label' => 'Notification Email'
                    ];
                    $rules['notification_from_name'] = [
                        'rules' => 'required',
                        'label' => 'Notification From Name'
                    ];
                    $rules['notification_from_email'] = [
                        'rules' => 'required|valid_email',
                        'label' => 'Notification From Email'
                    ];
                    $rules['notification_subject'] = [
                        'rules' => 'required',
                        'label' => 'Notification Subject'
                    ];
                    $rules['notification_message'] = [
                        'rules' => 'required',
                        'label' => 'Notification Message'
                    ];
                }

                if ($this->validate($rules)) {
                    $item = [
                        'name' => $this->request->getPost('form_name'),
                        'description' => $this->request->getPost('form_description'),
                        'fields' => $this->request->getPost('fields'),
                        'confirmation_message' => $this->request->getPost('confirmation_message'),
                        'notification_email' => $this->request->getPost('notification_email'),
                        'notification_cc' => $this->request->getPost('notification_cc'),
                        'notification_from_name' => $this->request->getPost('notification_from_name'),
                        'notification_from_email' => $this->request->getPost('notification_from_email'),
                        'notification_subject' => $this->request->getPost('notification_subject'),
                        'notification_message' => $this->request->getPost('notification_message'),
                        'enable_confirmation' => $this->request->getPost('enable_confirmation') ? 1 : 0,
                        'enable_notification' => $this->request->getPost('enable_notification') ? 1 : 0,
                        'status' => $this->request->getPost('form_status'),
                    ];
                    $this->forms->update($id, $item);

                    $this->session->setFlashData('success', trans("forms") . " " . trans("msg_suc_updated"));
                    $this->session->setFlashData("mes_settings", 1);

                    return redirect()->to('admin/forms');
                }else{
                    $this->session->setFlashData('errors_form', $validation->listErrors());
                    return redirect()->back()->withInput()->with('error', 'Unable to process your request.');
                }
            }else{
                return redirect()->to('admin/forms');
            }
        }else{
            return redirect()->to('admin/forms');
        }
    }

    public function delete($id = ''){
        if(!empty($id)){
            $this->forms->delete($id);
            $this->session->setFlashData('success', 'Form was successfully deleted.');
            $this->session->setFlashData("mes_settings", 1);
            return redirect()->to('admin/forms');
        }else{
            return redirect()->to('admin/forms');
        }
        
    }

    public function tableListing(){
        $input = $_POST;
        $limit = $input['length'] ?? 10;
        $start = $input['start'] ?? 0;
        $search = $input['search']['value'] ?? '';

        $query = $this->forms;
        if (!empty($search)) {
            $query = $query->like('name', $search)->orLike('description', $search);
        }

        $totalRecords = $query->countAllResults(false);
        $records = $query->orderBy('id', 'DESC')->findAll($limit, $start);

        $data = [];
        foreach ($records as $row) {
            $status = '<span class="badge badge-'. ($row['status'] == 1 ? 'success' : 'danger') .'">'. ($row['status'] == 1 ? 'Active' : 'Inactive') .'</span>';
            
            $action = '<a href="'. base_url('admin/forms/edit/'.$row['id']) .'" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a> ';
            $action .= '<a href="'. base_url('admin/forms/delete/'.$row['id']) .'" class="btn btn-sm btn-danger btn-delete-item" onclick="return confirm(\'Are you sure you want to delete this form?\')"><i class="fa fa-trash"></i> Delete</a>';

            $data[] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'description' => $row['description'],
                'status' => $status,
                'action' => $action
            ];
        }

        $output = [
            'draw' => intval($input['draw']),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $data
        ];

        return $this->response->setJSON($output);
    }
}