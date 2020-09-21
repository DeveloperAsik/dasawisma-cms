<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Backend\Prefferences;

use App\Http\Controllers\Controller;
use App\Model\Tbl_modules;

/**
 * Description of MenuController
 *
 * @author root
 */
class MenuController extends Controller {

    //put your code here
    public function view() {
        $data['title_for_layout'] = 'Selamat Datang di Dasawisma Bogor Timur';
        $Tbl_modules = new Tbl_modules();
        $data['modules'] = $Tbl_modules->find('all', array('fields' => 'all', 'table_name' => 'tbl_modules', 'conditions' => array('where' => array('a.is_active' => '= "1"'))));

        $css_files = array(
            '/libs/bootstrap/treeview/dist/bootstrap-treeview.min.css'
        );
        $this->load_css($css_files);
        $js_files = array(
            '/libs/bootstrap/treeview/dist/bootstrap-treeview.min.js'
        );
        $this->load_js($js_files);
        $data['menu_actions'] = ['view', 'add-child'];
        return view($this->_config_path_layout . 'Metronic.index', $data);
    }

}
