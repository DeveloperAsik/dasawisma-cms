<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Backend\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Libraries\Session_Library;
use App\Http\Libraries\Tools_Library;
use App\Http\Libraries\Auth;

//model
use DB;
use App\Model\Tbl_user_tokens;
use App\Model\Tbl_users;
use App\Model\Tbl_user_groups;
use App\Model\Tbl_groups;

/**
 * Description of UserController
 *
 * @author root
 */
class UserController extends Controller {

    //put your code here

    public function login() {
        $data['title_for_layout'] = 'Selamat Datang di Dasawisma Bogor Timur';
        return view($this->_config_path_layout . 'Metronic.index_login', $data);
    }

    public function logout() {
        Auth::session_data_clear(Session_Library::_get('_user_logged_in'));
        Session_Library::_destroy();
        header("Location: " . $this->_config_base_url . '/login');
    }

    public function dashboard() {
        $data['title_for_layout'] = 'welcome to orenoproject dashboard';
        return view($this->_config_path_layout . 'Metronic.index', $data);
    }

    public function save_token(Request $Request) {
        $data = array(
            'token' => $Request->input('token')
        );
        $res = false;
        $Tbl_user_tokens = new Tbl_user_tokens();
        if ($data) {
            $user_token = $Tbl_user_tokens->find('first', array(
                'fields' => 'all',
                'table_name' => 'tbl_user_tokens',
                'conditions' => array(
                    'where' => array(
                        'a.is_active' => '= "' . 1 . '"',
                        'a.token_generated' => '= "' . $data['token'] . '"'
                    )
                )
                    )
            );
            $Tbl_users = new Tbl_users();
            $user_detail = Tbl_users::find('first', array(
                        'fields' => 'all',
                        'table_name' => 'tbl_users',
                        'conditions' => array(
                            'where' => array(
                                'a.id' => '= "' . $user_token->user_id . '"'
                            )
                        )
                            )
            );
            $Tbl_user_groups = new Tbl_user_groups();
            $user_group = Tbl_user_groups::find('first', array(
                        'fields' => 'all',
                        'table_name' => 'tbl_user_groups',
                        'conditions' => array(
                            'where' => array(
                                'a.user_id' => '= "' . $user_token->user_id . '"'
                            )
                        )
                            )
            );
            $Tbl_groups = new Tbl_groups();
            $group = Tbl_groups::find('first', array(
                        'fields' => 'all',
                        'table_name' => 'tbl_groups',
                        'conditions' => array(
                            'where' => array(
                                'a.id' => '= "' . $user_group->group_id . '"'
                            )
                        )
                            )
            );
            $arr_sess_user = array(
                '_user_logged_in' => array(
                    'id' => $user_detail->id,
                    'firstname' => $user_detail->first_name,
                    'lastname' => $user_detail->last_name,
                    'email' => $user_detail->email,
                    'group' => $group->name,
                    'login_date' => Tools_Library::getDateNow(),
                    'login_exp' => Tools_Library::getDateAfter(4)
                )
            );
            Session_Library::_set('_is_logged_in', true);
            Session_Library::_set('_user_logged_in', $arr_sess_user['_user_logged_in']);
            Session_Library::_set('_token', $data['token']);
            DB::table('tbl_users')->where('id', $user_token->user_id)->update(['is_logged_in' => 1]);
            $res = DB::table('tbl_user_logged_in')->insert(
                    [
                        'user_token_id' => $user_token->id,
                        'user_id' => $user_token->user_id,
                        'group_id' => $user_group->group_id,
                        'logged_in' => true,
                        'start_date' => Tools_Library::getDateNow(),
                        'exp_date' => Tools_Library::getDateAfter(4)
                    ]
            );
        }
        if ($res == true) {
            return json_encode(array('status' => 200, 'message' => 'success'));
        } else {
            return json_encode(array('status' => 201, 'message' => 'failed'));
        }
    }

}
