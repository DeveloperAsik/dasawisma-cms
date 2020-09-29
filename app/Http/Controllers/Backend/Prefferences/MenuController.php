<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Backend\Prefferences;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function insert() {
        $post = $request->all();
        if (isset($post) && !empty($post)) {
            $result = DB::table('tbl_menus')->insertGetId(
                    [
                        'name' => $post['name'],
                        'path' => $post['path'],
                        'rank' => $post['icon'],
                        'level' => $post['icon'],
                        'icon' => $post['icon'],
                        'description' => $post['description'],
                        'is_active' => $post['status'],
                        'is_cms' => $post['cms'],
                        'is_open' => $post['open'],
                        'is_badge' => $post['icon'],
                        'is_logged_in' => $post['logged'],
                        'module_id' => $post['badge'],
                        'parent_id' => $post['icon'],
                        'created_by' => $post['icon'],
                        'created_date' => $post['icon']
                    ]
            );
            if ($result) {
                return json_encode(array('status' => 200, 'message' => 'Success insert data into db', 'data' => array('id' => $post['id'])));
            } else {
                return json_encode(array('status' => 201, 'message' => 'Failed insert data into db', 'data' => null));
            }
        }
    }

    public function update(Request $request) {
        $post = $request->all();
        if (isset($post) && !empty($post)) {
            $result = DB::table('tbl_menus')->where('id', $post['id'])->update(
                    [
                        'name' => $post['name'],
                        'path' => $post['path'],
                        'icon' => $post['icon'],
                        'description' => $post['description'],
                        'is_active' => $post['status'],
                        'is_logged_in' => $post['logged'],
                        'is_cms' => $post['cms'],
                        'is_open' => $post['open'],
                        'is_badge' => $post['badge']
                    ]
            );
            if ($result) {
                return json_encode(array('status' => 200, 'message' => 'Success update data into db', 'data' => array('id' => $post['id'])));
            } else {
                return json_encode(array('status' => 200, 'message' => 'Failed update data into db', 'data' => null));
            }
        }
    }

    public function delete() {
        $post = $request->all();
        if (isset($post) && !empty($post)) {
            $result = DB::table('users')->where('id', $post['id'])->delete();
            if ($result) {
                return json_encode(array('status' => 200, 'message' => 'Success delete data from db', 'data' => array('id' => $post['id'])));
            } else {
                return json_encode(array('status' => 20, 'message' => 'Failed delete data from db', 'data' => null));
            }
        }
    }

    public function get_icon(Request $Request) {
        
    }

}
