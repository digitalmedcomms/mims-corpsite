<?php

namespace App\Models;

use CodeIgniter\Model;

class OfficesModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'offices';
    protected $primaryKey       = 'id';
    protected $allowedFields = ['name','country_id','address','contact_number','email','status'];

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
    

    function listing($input){
        $data = [];

        $db = \Config\Database::connect();
        $builder = $db->table('offices');

        $cols = ['id'];
        $builder->select(implode(",", $cols));
        $query = $builder->get();


        $count = $query->getNumRows();
        $data['recordsTotal'] = $count;

        $cols = [
            'offices.name',
            'offices.country_id',
            'offices.address',
            'offices.contact_number',
            'offices.email',
            'offices.status',
            'location_countries.name as country_name',
            'offices.id',
        ];

        $orderby = $cols[7] . " ASC";

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
        $builder->join('location_countries', 'location_countries.id = offices.country_id', 'inner');

        $query = $builder->get();
        $count = $query->getNumRows();

        $data['recordsFiltered'] = $count;
        $data['data'] = array();

        foreach($query->getResult('array') as $result){
            $item = $result;
            $item['status'] = '<div class="text-center">'.getStatusBadge($result['status']).'</div>';

            $item['name'] = '<div><strong>'.$result['name'].'</strong></div><div>'.$result['address'].'</div>';
            $item['contact'] = '<div>'.$result['email'].'</div><div>'.$result['contact_number'].'</div>';

            $item['action'] = '<div class="text-center">';
            $item['action'] .= '<a style="padding: 2px 12px;font-size: 12px;" class="btn btn-primary" href="'. base_url("admin/offices/edit/" . $result['id']).'" title="Edit"><i class="fa fa-edit"></i> Edit</a> ';
            $item['action'] .= '<a style="padding: 2px 12px;font-size: 12px;" class="btn btn-danger" href="'. base_url("admin/offices/delete/" . $result['id']).'" title="Remove"><i class="fa fa-trash"></i> Remove</a>';
            $item['action'] .= '</div>';

            $data['data'][] = $item; 
        }
        return $data;
    }
}