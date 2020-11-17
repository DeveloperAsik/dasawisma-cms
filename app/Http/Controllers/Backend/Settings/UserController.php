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
use App\Http\Libraries\Auth;
//model
use Illuminate\Support\Facades\DB;
//custom lib
use App\Http\Libraries\Tools_Library;

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
        Auth::session_data_clear();
        Session_Library::_destroy();
        header("Location: " . $this->_config_base_url . '/login');
    }

    public function dashboard() {
        $data['title_for_layout'] = 'welcome to orenoproject dashboard';
        $abouts = DB::table('tbl_abouts AS a')->where('a.is_active', 1)->first();
        $data['_about'] = $abouts;
        return view($this->_config_path_layout . 'Metronic.index', $data);
    }

    public function auth(Request $request) {
        $post = $request->post();
        $result = json_encode(array('status' => 500, 'message' => 'something went wrong!!!'));
        if (isset($post) && !empty($post)) {
            $result = $this->__validate_password($request, $post);
        }
        return $result;
    }

    protected function __validate_password($request, $data = array()) {
        $return = json_encode(array('status' => 204, 'message' => 'empty data!!!'));
        if ($data != null) {
            $user_exist = DB::table('tbl_users AS a')->where('a.is_active', 1)->orWhere([['a.email', $data['username']], ['a.username', $data['username']]])->first();
            if ($user_exist == null) {
                return json_encode(array('status' => 404, 'message' => 'cannot find username/email or id user in db'));
            }
            $res = $this->__verify_hash(base64_decode($data['password']), $user_exist->password);
            if ($res == true) {
                $user_session = $this->__generate_user_session($request, $user_exist, $data['deviceid']);
                if ($user_session['status'] == 200) {
                    return json_encode(array('status' => 200, 'message' => 'success generate token'));
                } else {
                    return json_encode(array('status' => 404, 'message' => 'generate token failed'));
                }
            } else {
                return json_encode(array('status' => 404, 'message' => 'generate token failed'));
            }
        }
    }

    protected function __verify_hash($password_raw, $password_hash) {
        if (password_verify($password_raw, $password_hash)) {
            return true;
        } else {
            return false;
        }
    }

    protected function __generate_user_session($request, $data = array(), $deviceid = null) {
        if ($data) {
            DB::table('tbl_user_tokens AS a')->where('a.user_id', $data->id)->update(['a.is_guest' => 0]);
            $user_group = DB::table('tbl_user_groups AS a')->where([['a.is_active', 1], ['a.user_id', $data->id]])->first();
            $group = DB::table('tbl_groups AS a')->where([['a.is_active', 1], ['a.id', $user_group->group_id]])->first();
            $arr_sess_user = array(
                '_user_logged_in' => array(
                    'id' => $data->id,
                    'firstname' => $data->first_name,
                    'lastname' => $data->last_name,
                    'email' => $data->email,
                    'group' => $group->name,
                    'login_date' => Tools_Library::getDateNow(),
                    'login_exp' => Tools_Library::getDateAfter(4)
                )
            );
            $request->session()->put('_is_logged_in', true);
            $request->session()->put('_user_logged_in', $arr_sess_user['_user_logged_in']);
            $request->session()->put('_device_id', $deviceid);
            DB::table('tbl_users')->where('id', $data->id)->update(['is_logged_in' => 1]);
            DB::table('tbl_user_logged_in')->insert(
                    [
                        'user_token_id' => 0,
                        'user_id' => $data->id,
                        'group_id' => $group->id,
                        'logged_in' => true,
                        'start_date' => Tools_Library::getDateNow(),
                        'exp_date' => Tools_Library::getDateAfter(4)
                    ]
            );
            return (array('status' => 200, 'message' => 'successfully generate user session.'));
        } else {
            return (array('status' => 404, 'message' => 'failed generate user session'));
        }
    }

}
