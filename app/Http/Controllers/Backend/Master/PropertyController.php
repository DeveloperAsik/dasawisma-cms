<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Backend\Master;

use App\Http\Controllers\Controller;
/**
 * Description of PropertyController
 *
 * @author root
 */
class PropertyController extends Controller {

    //put your code here
    public function view() {
        $data['title_for_layout'] = 'welcome';
        $load_js = array(
            '/templates/metronic/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js',
            '/templates/metronic/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js'
        );
        $this->load_js($load_js);
        $load_css = array(
            '/templates/metronic/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css'
        );
        $this->load_css($load_css);
        return view($this->_config_path_layout . 'Metronic.index', $data);
    }

    public function get_list() {
        $Tbl_a_countries = new Tbl_a_countries();
        $res = $Tbl_a_countries->find('all', array('fields' => 'all', 'table_name' => 'tbl_a_countries', 'conditions' => array('where' => array('a.is_active' => '="1"'))));
        if (isset($res) && !empty($res) && $res != null) {
            return json_encode(array('status' => 200, 'message' => 'Successfully retrieving data.', 'data' => $res));
        } else {
            return json_encode(array('status' => 201, 'message' => 'Failed retrieving data', 'data' => null));
        }
    }

    public function insert() {
        
    }

    public function update() {
        
    }

    public function delete() {
        
    }

}

