<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Backend\Master;

use App\Http\Controllers\Controller;
use App\Traits\Api;

/**
 * Description of CountryController
 *
 * @author root
 */
class CountryController extends Controller {

    use Api;

    protected $table_name = 'tbl_a_countries AS a';

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

    public function get_list(Request $request) {
        $post = $request->post();
        if (isset($post) && !empty($post)) {
            //dd($request->request->all());
            //init config for datatables
            $draw = $post['draw'];
            $start = $post['start'];
            $length = $post['length'];
            $search = trim($post['search']['value']);
            $keyword = 'all';
            $value = '';
            if ($search) {
                $keyword = 'title';
                $value = $search;
            }
            $param = [
                'uri' => config('app.base_api_uri') . '/fetch/countries?page=' . $start . '&total=' . $length . '&keyword=' . $keyword . '&value=' . $value . '&token=' . $request->session()->get('_token_api'),
                'method' => 'GET'
            ];
            $res = $this->__init_request_api($param);
            $arr = array();
            if ($res->status == 200) {
                $i = $start + 1;
                foreach ($res->data as $d) {
                    $status = '';
                    if ($d->is_active == 1) {
                        $status = 'checked';
                    }
                    $action_status = '<div class="form-group">
                        <div class="col-md-9" style="height:30px">
                            <input type="checkbox" class="make-switch" data-size="small" data-value="' . $d->is_active . '" data-id="' . $d->id . '" name="status" ' . $status . '/>
                        </div>
                    </div>';
                    $data['rowcheck'] = '
                    <div class="form-group form-md-checkboxes">
                        <div class="md-checkbox-list">
                            <div class="md-checkbox">
                                <input type="checkbox" id="select_tr' . $d->id . '" class="md-check select_tr" name="select_tr[' . $d->id . ']" data-id="' . $d->id . '" />
                                <label for="select_tr' . $d->id . '">
                                    <span></span>
                                    <span class="check" style="left:20px;"></span>
                                    <span class="box" style="left:14px;"></span>
                                </label>
                            </div>
                        </div>
                    </div>';
                    $data['num'] = $i;
                    $data['title'] = $d->title; //optional		
                    $data['description'] = $d->description; //optional
                    $data['additional_info'] = $d->additional_info; //optional
                    $data['integrated_services_post_name'] = $d->integrated_services_post_name; //optional
                    $data['active'] = $action_status; //optional
                    $data['action'] = '<a style="color:#000;text-align:center" href="/detail-data-laporan/' . $d->id . '/' . strtolower(str_replace(' ', '-', $d->title)) . '">lihat</a>'; //optional
                    $arr[] = $data;
                    $i++;
                }
            }
            $total_rows = $res->meta->total_rows;
            $output = array(
                'draw' => $draw,
                'recordsTotal' => $total_rows,
                'recordsFiltered' => $total_rows,
                'data' => $arr,
            );
            //output to json format
            echo json_encode($output);
        } else {
            echo json_encode(array());
        }
    }

    public function insert() {
        
    }

    public function update() {
        
    }

    public function delete() {
        
    }

}
