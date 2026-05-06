<?php

namespace App\Controllers\Admin;

use App\Models\PageVisitModel;

class PageVisits extends AdminController
{

    public function __construct()
    {
        $this->visitModel = new PageVisitModel();
    }

    public function index(){
        $data = array_merge($this->data, [
            'title'      => trans('page_visits'),
            'active_tab' => 'page_visits',
        ]);

        return view('admin/page_visits/index', $data);
    }

    public function delete($id = ''){
        if(!empty($id)){
            $this->visitModel->delete($id);
            $this->session->setFlashData('success', 'Visit log was successfully deleted.');
            return redirect()->to('admin/page-visits');
        }else{
            return redirect()->to('admin/page-visits');
        }
    }

    public function tableListing(){
        $input = $_POST;
        $limit = $input['length'] ?? 10;
        $start = $input['start'] ?? 0;
        $search = $input['search']['value'] ?? '';

        $query = $this->visitModel;
        if (!empty($search)) {
            $query = $query->groupStart()
                ->like('ip_address', $search)
                ->orLike('url', $search)
                ->orLike('user_agent', $search)
                ->groupEnd();
        }

        $totalRecords = $query->countAllResults(false);
        $records = $query->orderBy('id', 'DESC')->findAll($limit, $start);

        $data = [];
        foreach ($records as $row) {
            $action = '<a href="'. base_url('admin/page-visits/delete/'.$row['id']) .'" class="btn btn-sm btn-danger btn-delete-item" onclick="return confirm(\'Are you sure you want to delete this visit log?\')"><i class="fa fa-trash"></i> Delete</a>';

            $data[] = [
                'id' => $row['id'],
                'ip_address' => $row['ip_address'],
                'url' => $row['url'],
                'referrer' => $row['referrer'] ?? 'Direct',
                'user_agent' => $row['user_agent'],
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
