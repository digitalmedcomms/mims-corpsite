<?php

namespace App\Models;

use CodeIgniter\Model;

class CareersModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'careers';
    protected $primaryKey       = 'id';
    protected $allowedFields = ['office_id', 'job_title', 'job_description', 'job_type', 'job_location', 'link', 'status'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public $job_types = [
        10 => 'Full-time',
        20 => 'Part-time',
        30 => 'Permanent',
        40 => 'Temporary',
    ];


    public $job_locations = [
        10 => 'Remote',
        20 => 'Hybrid',
        30 => 'Onsite',
    ];
    

    function listing($input){
        $data = [];

        $db = \Config\Database::connect();
        $builder = $db->table('careers');

        $cols = ['id'];
        $builder->select(implode(",", $cols));
        $query = $builder->get();


        $count = $query->getNumRows();
        $data['recordsTotal'] = $count;

        $cols = [
            'careers.job_title',
            'careers.job_description',
            'careers.job_type',
            'careers.job_location',
            'careers.office_id',
            'careers.link',
            'offices.name as office_name',
            'careers.status',
            'careers.id',
        ];

        $orderby = $cols[1] . " DESC";

        $builder->select(implode(",", $cols));

        if(isset($input['limit']) ){
            $builder->limit($input['limit']);
        }

        if(isset($input['start']) && !empty($input['start']) ){
            $builder->limit($input['limit'], $input['start']);
        }

        if(isset($input['order']) && !empty($input['order']) ){
            $orderby = $cols[$input['order'][0]['column']] . " " . $input['order'][0]['dir'];
        }

        $builder->orderBy($orderby);

        $builder->join('offices', 'offices.id = careers.office_id', 'INNER');
        $query = $builder->get();
        $count = $query->getNumRows();

        $data['recordsFiltered'] = $count;
        $data['data'] = array();

        foreach($query->getResult('array') as $result){
            $item = $result;
            $item['job_title'] = '<div><strong>'.$result['job_title'].'</strong></div><div>'.$this->job_types[$result['job_type']].' - '.$this->job_locations[$result['job_location']].'</div><div>'.$result['office_name'].'</div>';
            $item['status'] = '<div class="text-center">'.getStatusBadge($result['status']).'</div>';

            $item['action'] = '<div class="text-center">';
            $item['action'] .= '<a style="padding: 2px 12px;font-size: 12px;" class="btn btn-primary" href="'. base_url("admin/careers/edit/" . $result['id']).'" title="Edit"><i class="fa fa-edit"></i> Edit</a>';
            $item['action'] .= '</div>';

            $data['data'][] = $item;
        }
        return $data;
    }
}