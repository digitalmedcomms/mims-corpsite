<?php

namespace App\Controllers;

use App\Models\OfficesModel;
use App\Models\Locations\CountryModel;
use App\Models\PracticeModel;

class Privacy extends BaseController
{

    public function __construct()
    {
    }


    public function index()
    {
        $data = [];

        // PAGE HEAD PROCESSING
        return view('components/header', array(
            'title' => 'MIMS Privacy Policy',
            'description' => 'MIMS recognizes the importance of protecting the Personal Data collected from you in the operation of this Site, and take reasonable steps to maintain the security, integrity and privacy of any information in accordance with this Policy.',
            'url' => BASE_URL,
            'keywords' => '',
            'meta' => array(
                'title' => 'MIMS Privacy Policy',
                'description' => 'MIMS recognizes the importance of protecting the Personal Data collected from you in the operation of this Site, and take reasonable steps to maintain the security, integrity and privacy of any information in accordance with this Policy.',
                'image' => IMG_URL . ''
            ),
            'nav' => '',
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
                COMPILED_ASSETS_PATH . 'css/components/timeline',
                COMPILED_ASSETS_PATH . 'css/components/navigation_bar',
                COMPILED_ASSETS_PATH . 'css/components/footer',
                COMPILED_ASSETS_PATH . 'css/pages/contact'
            )
        ))
        .view('Pages/privacy', $data)
        .view('components/scripts_render', array(
            'scripts' => array(
                'https://code.jquery.com/jquery-3.5.1.min.js' => array(
                    'integrity' => 'sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=',
                    'crossorigin' => 'anonymous'
                ),
                ASSETS_URL . 'js/plugins/popper.min.js',
                ASSETS_URL . 'js/plugins/bootstrap/bootstrap.min.js',
                ASSETS_URL . 'js/plugins/bootstrap-select.min.js',
                ASSETS_URL . 'js/components/global.min.js',
                ASSETS_URL . 'js/plugins/owl.carousel.min.js',
                ASSETS_URL . 'js/components/wow.min.js',
                ASSETS_URL . 'js/plugins/timeline.min.js',
                ASSETS_URL . 'js/components/navigation_bar.min.js',
                ASSETS_URL . 'js/pages/contact.min.js?1',
            )
        ))
        .view('components/footer');
    }

    //maintenance mode
    public function maintenance()
    {
        return view('maintenance');
    }
}
