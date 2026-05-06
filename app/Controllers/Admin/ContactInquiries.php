<?php

namespace App\Controllers\Admin;

use App\Models\ContactInquiryModel;

class ContactInquiries extends AdminController
{

    public function __construct()
    {
        $this->inquiryModel = new ContactInquiryModel();
    }

    public function index(){
        $data = array_merge($this->data, [
            'title'      => trans('contact_inquiries'),
            'active_tab' => 'contact_inquiries',
        ]);

        return view('admin/contact_inquiries/index', $data);
    }

    public function delete($id = ''){
        if(!empty($id)){
            $this->inquiryModel->delete($id);
            $this->session->setFlashData('success', 'Inquiry was successfully deleted.');
            return redirect()->to('admin/contact-inquiries');
        }else{
            return redirect()->to('admin/contact-inquiries');
        }
    }

    public function tableListing(){
        $input = $_POST;
        $limit = $input['length'] ?? 10;
        $start = $input['start'] ?? 0;
        $search = $input['search']['value'] ?? '';

        $query = $this->inquiryModel;
        if (!empty($search)) {
            $query = $query->groupStart()
                ->like('name', $search)
                ->orLike('organisation', $search)
                ->orLike('email', $search)
                ->orLike('message', $search)
                ->groupEnd();
        }

        $totalRecords = $query->countAllResults(false);
        $records = $query->orderBy('id', 'DESC')->findAll($limit, $start);

        $data = [];
        foreach ($records as $row) {
            $action = '<a href="'. base_url('admin/contact-inquiries/delete/'.$row['id']) .'" class="btn btn-sm btn-danger btn-delete-item" onclick="return confirm(\'Are you sure you want to delete this inquiry?\')"><i class="fa fa-trash"></i> Delete</a>';

            $data[] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'organisation' => $row['organisation'],
                'email' => $row['email'],
                'recipient' => $row['email_recipient'],
                'message' => nl2br(html_escape($row['message'])),
                'created_at' => formatted_date($row['created_at']),
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
