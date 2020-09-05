<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Backend\Settings;

use App\Http\Controllers\Controller;

/**
 * Description of PermissionController
 *
 * @author root
 */
class PermissionController extends Controller {

    //put your code here

    public function view() {
        $data['title_for_layout'] = 'Selamat Datang di Dasawisma Bogor Timur';
        $js_files = array(
            'metronics/assets/global/scripts/datatable.js',
            'metronics/assets/global/plugins/datatables/datatables.min.js',
            'metronics/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'
        );
        $this->load_js($js_files);
        return view($this->_config_path_layout . 'Metronic.index', $data);
    }

    public function get_list() {
        
    }

    public function get_data() {
        
    }

    public function insert() {
        
    }

    public function update() {
        
    }

    public function update_status() {
        
    }

    public function remove() {
        
    }

    public function delete() {
        
    }

}
