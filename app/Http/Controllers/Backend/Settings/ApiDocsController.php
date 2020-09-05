<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Backend\Settings;

use App\Http\Controllers\Controller;
/**
 * Description of ApiDocsController
 *
 * @author root
 */
class ApiDocsController extends Controller {

    //put your code here

    public function view() {
        $data['title_for_layout'] = 'Selamat Datang di Dasawisma Bogor Timur';
        return view($this->_config_path_layout . 'Metronic.index', $data);
    }

}
