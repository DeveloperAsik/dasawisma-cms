<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Backend\Master;

use App\Http\Controllers\Controller;

/**
 * Description of PostController
 *
 * @author root
 */
class PostController extends Controller {

    //put your code here

    public function create() {
        $data['title_for_layout'] = 'welcome';
        $load_js = array(
            '/templates/metronic/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js',
            '/templates/metronic/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js'
        );
        $this->load_js($load_js);
        return view($this->_config_path_layout . 'Metronic.index', $data);
    }

    public function view() {
        $data['title_for_layout'] = 'welcome';
        $load_js = array(
            '/templates/metronic/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js',
            '/templates/metronic/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'
        );
        $this->load_js($load_js);
        return view($this->_config_path_layout . 'Metronic.index', $data);
    }

    public function archives() {
        $data['title_for_layout'] = 'welcome';
        $load_js = array(
            '/templates/metronic/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js',
            '/templates/metronic/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'
        );
        $this->load_js($load_js);
        return view($this->_config_path_layout . 'Metronic.index', $data);
    }

}
