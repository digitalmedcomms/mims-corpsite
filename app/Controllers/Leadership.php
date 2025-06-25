<?php

namespace App\Controllers;

use App\Models\LeadersModel;
use App\Models\LeaderTypesModel;
use App\Models\PracticeModel;

class Leadership extends BaseController
{

    public function __construct()
    {
        $this->leaderTypes = new LeaderTypesModel();
        $this->leaders = new LeadersModel();
        $this->practices = new PracticeModel();
    }
    public function index()
    {
      
        $data = [];
        $leader_types_arr = [];
        $leader_types = $this->leaderTypes->where('status', 1)->findAll();
        $data['practices'] = $this->practices->where('status', 1)->findAll();
        foreach($leader_types as $leader_type){
            if($leader_type['id'] == 3){
                foreach($data['practices'] as $practice){
                    $practice['leaders'] = $this->leaders->where('leader_type_id', $leader_type['id'])->where('status', 1)->where('practice', $practice['id'])->orderBy('`order` ASC')->findAll();
                    $leader_type['practices'][] = $practice;
                }
            }else{
                $leader_type['leaders'] = $this->leaders->where('leader_type_id', $leader_type['id'])->where('status', 1)->orderBy('`order` ASC')->findAll();
            }
            $leader_types_arr[] = $leader_type;
        }
        $data['leader_types'] = $leader_types_arr;
        // PAGE HEAD PROCESSING
        return view('components/header', array(
            'title' => 'MIMS | Asia Pacific leading multichannel provider of medical information',
            'description' => 'MIMS host a wealth of healthcare services to healthcare professionals, pharmaceutical companies and healthcare institutions.',
            'url' => BASE_URL,
            'keywords' => '',
            'meta' => array(
                'title' => 'MIMS | Asia Pacific leading multichannel provider of medical information',
                'description' => 'MIMS host a wealth of healthcare services to healthcare professionals, pharmaceutical companies and healthcare institutions.',
                'image' => IMG_URL . ''
            ),
            'styles' => array(
                'plugins/font_awesome',
                COMPILED_ASSETS_PATH . 'css/components/bootstrap',
                COMPILED_ASSETS_PATH . 'css/components/fontawesome',
                COMPILED_ASSETS_PATH . 'css/components/owl',
                COMPILED_ASSETS_PATH . 'css/components/bootstrap-main',
                COMPILED_ASSETS_PATH . 'css/components/bootstrap-select',
                COMPILED_ASSETS_PATH . 'css/components/buttons',
                COMPILED_ASSETS_PATH . 'css/components/global',
                COMPILED_ASSETS_PATH . 'css/components/animations',
                COMPILED_ASSETS_PATH . 'css/components/navigation_bar',
                COMPILED_ASSETS_PATH . 'css/components/footer',
                COMPILED_ASSETS_PATH . 'css/pages/leaders'
            )
        ))
        .view('Pages/leaders/index', $data)
        .view('components/scripts_render', array(
            'scripts' => array(
                'https://code.jquery.com/jquery-3.5.1.min.js' => array(
                    'integrity' => 'sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=',
                    'crossorigin' => 'anonymous'
                ),
                ASSETS_URL . 'js/plugins/popper.min.js',
                ASSETS_URL . 'js/plugins/bootstrap/bootstrap.min.js',
                ASSETS_URL . 'js/components/global.min.js',
                ASSETS_URL . 'js/components/wow.min.js',
                ASSETS_URL . 'js/plugins/owl.carousel.min.js',
                ASSETS_URL . 'js/components/navigation_bar.min.js',
                ASSETS_URL . 'js/pages/leaders.min.js',
            )
        ))
        .view('components/footer');
    }
}
