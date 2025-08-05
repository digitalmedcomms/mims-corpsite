<?php

namespace App\Controllers;

use App\Models\OfficesModel;
use App\Models\Locations\CountryModel;
use App\Models\PracticeModel;

class Contactus extends BaseController
{

    public function __construct()
    {
        $this->offices = new OfficesModel();
        $this->countries = new CountryModel();
    }


    public function index()
    {
        $str = 'HS-000098==leow.jo.lene@singhealth.com.sg==Dr Jo Lene Leow||HS-000099==leow.jo.lene@singhealth.com.sg==Dr Jo Lene Leow||HS-000101==leow.jo.lene@singhealth.com.sg==Dr Jo Lene Leow||PS-000220==felicia_liew@rp.edu.sg==Ms Felicia Liew||HS-000240==jonathanyongjie.lam@uq.net.au==Mr Jonathan Yong Jie Lam Lam||CP-000262==vgabucan@uic.edu.ph==Asst Prof Von Jay Maico Gabucan||PE-000263==vgabucan@uic.edu.ph==Asst Prof Von Jay Maico Gabucan||CP-000265==thuha@choray.vn==Ms Ha Tran||HS-000326==law.rei.yin@skh.com.sg==Ms Rei Yin Law||PE-000354==daron_jx_cai@pharmacy.nhg.com.sg==Mr Chun Heong Daron Chua||PS-000438==vstrajan1679@gmail.com==Dr Vasanthi Srinivass Thiruvengadarajan||CP-000477==chua.seow.koon@skh.com.sg==Mr Seow Koon Chua||vHS-000499==felicia.chua.yaxin@snec.com.sg==Ms Felicia Chua||CP-000505==laykeuan_tan@renci.org.sg==Ms TAN LAY KEUAN||CP-000506==lim.hui.jun@skh.com.sg==Ms Hui Jun Lim||HS-000542==hui_jing_cherie_cheah@nuhs.edu.sg==Ms Hui Jing Cherie Cheah||HS-000546==klin@u.nus.edu==Mr Keegan Lin||PS-000547==jordantanym@u.nus.edu==Mr Jordan Yong Ming Tan||PS-000548==jordantanym@u.nus.edu==Mr Jordan Yong Ming Tan||CP-000563==toh.jing.heng@ktph.com.sg==Dr Jing Heng Toh||CP-000568==vivian_teo@imh.com.sg==Ms Vivian Teo||CP-000577==yao_zong_teo@ttsh.com.sg==Mr Yao Zong Teo||PE-000578==annie_ng@nyp.edu.sg==Ms Yin ni, Annie Ng||CP-000579==shixu_goh@nuhs.edu.sg==Mr Shixu Goh||CP-000628==santhi.arunachalam@kkh.com.sg==Mrs Santhi Arunachalam||PS-000629==ztc001@zju.edu.cn==Dr Tiecheng Zhong||CP-000632==hu.jieying@kkh.com.sg==Mrs Jieying Hu||HS-000653==estherchew1@gmail.com==Ms Esther Chew||PE-000662==soo_ying_zhou@moh.gov.sg==Mr Ying Zhou Soo||CP-000663==yashi_saw@nuhs.edu.sg==Ms Yashi Saw Saw||CP-000689==ya_ling_kee@ttsh.com.sg==Dr Ya Ling Kee||PE-000701==evelyn.macaraig@kkh.com.sg==Mrs Evelyn Macaraig||PS-000706==sean_chia@bti.a-star.edu.sg==Dr Sean Chia||CP-000719==wang.ai.wen@sgh.com.sg==Dr Aiwen Wang||CP-000721==wang.ai.wen@sgh.com.sg==Dr Aiwen Wang||CP-000726==wei_qin_tan@ttsh.com.sg==Mr Wei Qin Tan||CP-000731==tang.may.lin@singhealth.com.sg==Ms May Lin Tang||PS-000743==ck.hongthong@nmc.ac.th==Dr Charkkrit Hongthong||PS-000744==kwanchaya.m@nmc.ac.th==Dr Kwanchayanawish Machana||CP-000758==jaslyn.tan@watsons.com.sg==Ms Swee Mei Tan||CP-000764==jian_wei_teng@wh.com.sg==Mr Jian Wei Teng||HS-000769==jingyi.leong@u.nus.edu==Ms Jing-Yi Leong||CP-000778==foo.wei.yan@skh.com.sg==Ms Wei Yan Foo||CP-000782==e1103397@u.nus.edu==Ms Ronghui He||CP-000784==hwang.yi.kun@sgh.com.sg==Mr Yi Kun Hwang||CP-000785==goh.si.han@singhealth.com.sg==Ms Si Han Goh||CP-000786==rachel.khoo.s.y@singhealth.com.sg==Ms Rachel Khoo||CP-000788==esther_sj_bek@nuhs.edu.sg==Ms Esther Bek||HS-000791==ang.hui.gek@sgh.com.sg==Dr Hui Gek Ang||HS-000792==kwee_keng_kng@ttsh.com.sg==Ms Kwee Keng Kng||PE-000794==yinting.cheung@cuhk.edu.hk==A/Prof Yin Ting Cheung||CP-000795==benson.siow@sgh.com.sg==Dr Benson Siow||CP-000796==stephanie.chong.s.t@sgh.com.sg==Ms Stephanie Chong||PS-000797==xiqiuliu@hust.hust.edu==Asst Prof Xiqiu Liu||CP-000803==kenyu.tan@mountelizabeth.com.sg==Mr Ken Yu Tan||PS-000804==phansy@nus.edu.sg==Dr Soek Ying Neo||PS-000805==xuanli@u.nus.edu==Ms Xuan Li||CP-000808==674056962@qq.com==A/Prof xiqiu liu||PS-000809==jessica.lee.s.y@sgh.com.sg==Ms Jessica Lee||CP-000818==adisongoh88@u.nus.edu==Mr Adison Goh||CP-000819==alyssa_ry_tan@ttsh.com.sg==Ms Rui Yi Alyssa Tan||HS-000822==ch19970617@126.com==Dr Hong Cao||CP-000823==e0773975@u.nus.edu==Ms Jer Qi, Rebecca Boey||CP-000843==emily_poh@nuhs.edu.sg==Ms Yen Yen Emily Poh||CP-000844==emily_poh@nuhs.edu.sg==Ms Yen Yen Emily Poh||CP-000848==yee_ding_ng@cgh.com.sg==Ms Yee Ding Ng||CP-000850==joy.chong@watsons.com.sg==Ms Joy Boon Ka Chong||HS-000862==doreen.tan.sy@nus.edu.sg==A/Prof Doreen Su-Yin Tan||CP-000882==chongkaiyun03@gmail.com==Ms Mavis Chong||HS-000890==ngyunyan@u.nus.edu==Ms Yun Yan Ng||PE-000891==e0958675@u.nus.edu==Mr Isaac Kah Wei Choi||HS-000896==e0970530@u.nus.edu==Ms Wei Ling Tee||CP-000898==pu_en_ow_yong@cgh.com.sg==Ms Pu En Ow Yong||CP-000903==eng.jing.jia@kkh.com.sg==Ms Jing Jia Eng||CP-000910==celeneseah@hotmail.com==Ms Celene Seah||PE-000931==rajalakshmi_rajaram@moh.gov.sg==Ms Rajalakshmi Rajaram||CP-000933==rajalakshmi_rajaram@moh.gov.sg==Ms Rajalakshmi Rajaram||CP-000952==samuel.kzh@gmail.com==Mr Samuel Koh Koh||PE-000985==lim.kiat.wee@sgh.com.sg==Dr Kiat Wee Lim||PE-000987==abdul_aw_begam@nuhs.edu.sg==Ms Abdul Azeez Waseemah Begam||CP-000994==shaneliaw85@gmail.com==Mr Shane Liaw||CP-000995==christina_jy_tan@ttsh.com.sg==Dr Christina Tan||PE-001009==tan_lay_khee@tp.edu.sg==Ms Lay khee Tan||CP-001011==nur_wahdaniah_husni@cgh.com.sg==Ms Nur Wahdaniah||CP-001013==lim.teong.guan@sgh.com.sg==Mr Teong Guan Lim||CP-001017==ong.wan.chee@sgh.com.sg==Dr Wan Chee Ong||CP-001019==xin_yong_tay@cgh.com.sg==Ms Xin Yong Tay||CP-001022==debbie_cheng@ttsh.com.sg==Ms Debbie Cheng||CP-001026==hong_yun_wong@nuhs.edu.sg==Mr Hong Yun Wong||HS-001028==esther_sj_bek@nuhs.edu.sg==Ms Esther Bek||HS-001029==christina_jy_tan@ttsh.com.sg==Dr Christina Tan||HS-001030==alisa_sl_chan@ttsh.com.sg==Ms Siu Ling Alisa Chan||HS-001031==tang_xue_li@moh.gov.sg==Ms Xue Li Tang||HS-001032==e0958373@u.nus.edu==Mr Axel Yeoh||CP-001046==zhi_yao_chan@nuhs.edu.sg==Mr Zhi Yao Chan||CP-001047==janice_tan_qy2@nuhs.edu.sg==Ms Janice Tan||CP-001048==tan_tuan_he@wh.com.sg==Mr Tuan He Tan||CP-001049==e0969188@u.nus.edu==Ms Shania Marani||CP-001050==hon_jin_liu@nuhs.edu.sg==Mr Hon Jin Liu||CP-001053==raashi@singhealth.com.sg==Ms Raashi -||HS-001054==joshua_low@nuhs.edu.sg==Mr Jun Wen Joshua Low||HS-001356==NEO_Zhi_Yang@moh.gov.sg==Mr Zhi Yang NEO';
        $lines = explode("||", $str);
        $ctr = 0;
        foreach($lines as $line){
            $items = explode("==", $line);
            echo $ctr . " => [<br>";
            for($x = 0; $x < count($items); $x++){
                if($x == 0){
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;'abstract_number' => '" . $items[$x] . "',<br>";
                }else if($x == 1){
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;'email' => '" . $items[$x] . "',<br>";
                }else{
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;'name' => '" . $items[$x] . "',<br>";
                }
            }
            echo "],<br>";
            $ctr++;
        }

        exit();
        $data = [];
        $countries = $this->countries->where(['status' => 1])->findAll();
        $offices = $this->offices->where(['status' => 1])->findAll();

        $offices_arr = [];
        foreach($countries as $country){
            foreach($offices as $office){
                if($country['id'] == $office['country_id']){
                    $offices_arr[$country['code']][] = $office;
                }
            }
        }
        $data['offices_json'] = json_encode($offices_arr);
        $data['countries'] = $countries;
        // PAGE HEAD PROCESSING
        return view('components/header', array(
            'title' => 'MIMS Singapore (Headquarters) | Asia Pacific leading multichannel provider of medical information',
            'description' => 'MIMS is headquartered in Singapore. We have a strong presence in Asia Pacific supported by over 1,000 employees across 36 local offices.',
            'url' => BASE_URL,
            'keywords' => '',
            'meta' => array(
                'title' => 'MIMS Singapore (Headquarters) | Asia Pacific leading multichannel provider of medical information',
                'description' => 'MIMS is headquartered in Singapore. We have a strong presence in Asia Pacific supported by over 1,000 employees across 36 local offices.',
                'image' => IMG_URL . ''
            ),
            'nav' => 'aboutus',
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
        .view('Pages/contact', $data)
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
