<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Backend\Master;

use App\Http\Controllers\Controller;

/**
 * Description of AreaController
 *
 * @author root
 */
class AreaController extends Controller {

    //put your code here
    public function view() {
        $data['title_for_layout'] = 'welcome';
        $load_js = array(
            'metronic/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js',
            'metronic/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'
        );
        $this->load_js($load_js);
        return view($this->_config_path_layout . 'Metronic.index', $data);
    }

}
