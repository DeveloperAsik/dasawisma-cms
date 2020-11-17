<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//load custom libraries class
use App\Http\Libraries\Variables_Library AS VLibrary;
use App\Http\Libraries\HttpRequest_Library AS HttpReqLibrary;
use App\Http\Libraries\Tools_Library AS ToolsLibrary;
//load table model
use App\Traits\Api;
use View;

class Controller extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests,
        Api;

    public function __construct(Request $request) {
        $this->initVar($request);
        $this->initAuth($request);
        $this->initBackendSidemenu($request);
    }

    public function initVar($request) {
        $conf = VLibrary::init();
        if ($conf['PATH']) {
            foreach ($conf['PATH'] AS $key => $values) {
                /*
                 * enable actual config variable to load globally 
                 * start here
                 */
                View::share($key, $values);
                /*
                 * enable actual config variable to load globally 
                 * end here
                 */
                $this->{$key} = $values;
            }
        }

        if ($conf['CONFIG']) {
            foreach ($conf['CONFIG'] AS $key => $values) {
                /*
                 * enable actual config variable to load globally 
                 * start here
                 */
                View::share($key, $values);
                /*
                 * enable actual config variable to load globally 
                 * end here
                 */
                $this->{$key} = $values;
            }
        }

        if (!$request->session()->get('_uuid') || $request->session()->get('_uuid') == null) {
            $request->session()->put('_uuid', uniqid());
        }
    }

    public function initAuth($request) {
        $route_exist = \Request::route()->getName();
        if (!$request->session()->get('_uuid') || $request->session()->get('_uuid') == null) {
            $request->session()->put('_uuid', uniqid());
        }
        //if ($request->session()->get('_token_access')) {
        //    View::share('_token_access', $request->session()->get('_token_access'));
        //}
        //$param = [
        //    'uri' => config('app.base_api_uri') . '/is-logged-in',
        //    'method' => 'GET',
        //    'header' => ['token' => $request->session()->get('_token_access')]
        //];
        //$is_logged_in = $this->__init_request_api($param);
        //$redirect = false;
        //if ($is_logged_in->status == 200 && $is_logged_in->data->logged_in == true) {
        //    $request->session()->put('_is_logged_in', $is_logged_in->data->logged_in);
        //    View::share('_is_logged_in', $is_logged_in->data->logged_in);
        //    if ($request->session()->get('_token_access')) {
        //        View::share('_token_access', $request->session()->get('_token_access'));
        //        $uri = VLibrary::init()['PATH']['_config_api_base_url'] . '/is-logged-in';
        //        $data = array('token' => $request->session()->get('_token_access'));
        //        $method = 'GET';
        //        $is_logged_in = HttpReqLibrary::run($uri, $data, $method);
        //        if ($is_logged_in->status == 200 && $is_logged_in->data->logged_in == false) {
        //            if ($route_exist != 'login') {
        //                $redirect = $this->_config_base_url . '/login';
        //            }
        //        } else {
        //            if ($route_exist == 'login' || $route_exist == 'backend') {
        //                $redirect = $this->_config_base_url . '/dashboard';
        //            }
        //        }
        //    } else {
        //        if ($route_exist != 'login') {
        //            $redirect = $this->_config_base_url . '/login';
        //        }
        //    }
        //} else {
        //    if ($route_exist != 'login') {
        //        $redirect = $this->_config_base_url . '/login';
        //    }
        //}
        //if ($redirect != false) {
        //    ToolsLibrary::setRedirect($redirect);
        //}
    }

    public function initBackendSidemenu($request) {
        if ($request->session()->get('_is_logged_in')) {
            $data = [
                'module_id' => 1,
                'logged' => 1,
                'module_name' => 'Backend'
            ];
            $menu = $this->initMenu($data, 'array');
            $result = $menu[0]['nodes'];
        } else {
            $result[] = array(
                'text' => 'root',
                'icon' => 'fa-contao',
                'href' => '#',
                'level' => '0',
                'id' => '0',
                'rank' => '0',
                'parent_id' => 0,
                'parent_name' => '',
                'module_id' => 0,
                'module_name' => 'root',
                'is_active' => 1,
                'is_logged_in' => 1,
                'is_cms' => 1,
                'is_open' => 1,
                'is_badge' => 1,
                'desc' => '-',
                'nodes' => null
            );
        }
        View::share('_menu_backend', $result);
    }

    public function initMenu($post = array(), $return = 'json') {
        if (isset($post) && !empty($post)) {
            $id = $post['module_id'];
            $logged = $post['logged'];
            $name = $post['module_name'];
            $res = array();
            $table_menu = 'tbl_menus AS a';
            $menu_1 = DB::table($table_menu)->where([['a.is_active', 1], ['a.is_cms', 1], ['a.level', 1], ['a.module_id', $id], ['a.is_logged_in', $logged]])->orderBy('a.rank', 'asc')->get();
            $arr1 = array();
            if (isset($menu_1) && !empty($menu_1)) {
                foreach ($menu_1 AS $keyword => $values) {
                    $menu_2 = DB::table($table_menu)->where([['a.is_active', 1], ['a.is_cms', 1], ['a.level', 2], ['a.module_id', $id], ['a.parent_id', $values->id]])->orderBy('a.rank', 'asc')->get();
                    $arr2 = array();
                    if (isset($menu_2) && !empty($menu_2)) {
                        foreach ($menu_2 AS $keyword2 => $values2) {
                            $menu_3 = DB::table($table_menu)->where([['a.is_active', 1], ['a.is_cms', 1], ['a.level', 3], ['a.module_id', $id], ['a.is_logged_in', $logged], ['a.parent_id', $values2->id]])->orderBy('a.rank', 'asc')->get();
                            $arr3 = array();
                            if (isset($menu_3) && !empty($menu_3)) {
                                foreach ($menu_3 AS $keyword3 => $values3) {
                                    $menu_4 = DB::table($table_menu)->where([['a.is_active', 1], ['a.is_cms', 1], ['a.level', 4], ['a.module_id', $id], ['a.is_logged_in', $logged], ['a.parent_id', $values3->id]])->orderBy('a.rank', 'asc')->get();
                                    $arr4 = array();
                                    if (isset($menu_4) && !empty($menu_4)) {
                                        foreach ($menu_4 AS $keyword4 => $values4) {
                                            $menu_5 = DB::table($table_menu)->where([['a.is_active', 1], ['a.is_cms', 1], ['a.level', 5], ['a.module_id', $id], ['a.is_logged_in', $logged], ['a.parent_id', $values4->id]])->orderBy('a.rank', 'asc')->get();
                                            $arr5 = array();
                                            if (isset($menu_5) && !empty($menu_5)) {
                                                foreach ($menu_5 AS $keyword5 => $values5) {
                                                    $parent5 = $this->get_parent_menu($values5->parent_id);
                                                    $module5 = $this->get_module($values5->module_id);
                                                    $arr5[] = array(
                                                        'text' => $values5->name,
                                                        'icon' => $values5->icon,
                                                        'href' => $values5->path,
                                                        'level' => $values5->level,
                                                        'id' => $values5->id,
                                                        'rank' => $values->rank,
                                                        'parent_id' => $parent5->id,
                                                        'parent_name' => $parent5->name,
                                                        'module_id' => $module5->id,
                                                        'module_name' => $module5->name,
                                                        'is_active' => (int) $values5->is_active,
                                                        'is_logged_in' => (int) $values5->is_logged_in,
                                                        'is_cms' => (int) $values5->is_cms,
                                                        'is_open' => (int) $values5->is_open,
                                                        'is_badge' => (int) $values5->is_badge,
                                                        'desc' => $values5->description,
                                                    );
                                                }
                                            }
                                            $parent4 = $this->get_parent_menu($values4->parent_id);
                                            $module4 = $this->get_module($values4->module_id);
                                            $arr4[] = array(
                                                'text' => $values4->name,
                                                'icon' => $values4->icon,
                                                'href' => $values4->path,
                                                'level' => $values4->level,
                                                'id' => $values4->id,
                                                'rank' => $values->rank,
                                                'parent_id' => $parent4->id,
                                                'parent_name' => $parent4->name,
                                                'module_id' => $module4->id,
                                                'module_name' => $module4->name,
                                                'is_active' => (int) $values4->is_active,
                                                'is_logged_in' => (int) $values4->is_logged_in,
                                                'is_cms' => (int) $values4->is_cms,
                                                'is_open' => (int) $values4->is_open,
                                                'is_badge' => (int) $values4->is_badge,
                                                'desc' => $values4->description,
                                                'nodes' => $arr5
                                            );
                                        }
                                    }
                                    $parent3 = $this->get_parent_menu($values3->parent_id);
                                    $module3 = $this->get_module($values3->module_id);
                                    $arr3[] = array(
                                        'text' => $values3->name,
                                        'icon' => $values3->icon,
                                        'href' => $values3->path,
                                        'level' => $values3->level,
                                        'id' => $values3->id,
                                        'parent_id' => $parent3->id,
                                        'rank' => $values->rank,
                                        'parent_name' => $parent3->name,
                                        'module_id' => $module3->id,
                                        'module_name' => $module3->name,
                                        'is_active' => (int) $values3->is_active,
                                        'is_logged_in' => (int) $values3->is_logged_in,
                                        'is_cms' => (int) $values3->is_cms,
                                        'is_open' => (int) $values3->is_open,
                                        'is_badge' => (int) $values3->is_badge,
                                        'desc' => $values3->description,
                                        'nodes' => $arr4
                                    );
                                }
                            }
                            $parent2 = $this->get_parent_menu($values2->parent_id);
                            $module2 = $this->get_module($values2->module_id);
                            $arr2[] = array(
                                'text' => isset($values2->name) ? $values2->name : '',
                                'icon' => isset($values2->icon) ? $values2->icon : '',
                                'href' => isset($values2->path) ? $values2->path : '',
                                'level' => isset($values2->level) ? $values2->level : '',
                                'id' => $values2->id,
                                'rank' => $values->rank,
                                'parent_id' => isset($parent2->id) ? $parent2->id : '',
                                'parent_name' => isset($parent2->name) ? $parent2->name : '',
                                'module_id' => isset($module2->id) ? $module2->id : '',
                                'module_name' => isset($module2->name) ? $module2->name : '',
                                'is_active' => (int) $values2->is_active,
                                'is_logged_in' => (int) $values2->is_logged_in,
                                'is_cms' => (int) $values2->is_cms,
                                'is_open' => (int) $values2->is_open,
                                'is_badge' => (int) $values2->is_badge,
                                'desc' => $values2->description,
                                'nodes' => $arr3
                            );
                        }
                    }
                    $module1 = $this->get_module($values->module_id);
                    $arr1[] = array(
                        'text' => $values->name,
                        'icon' => $values->icon,
                        'href' => $values->path,
                        'level' => $values->level,
                        'id' => $values->id,
                        'rank' => $values->rank,
                        'parent_id' => 0,
                        'parent_name' => '',
                        'module_id' => $module1->id,
                        'module_name' => $module1->name,
                        'is_active' => (int) $values->is_active,
                        'is_logged_in' => (int) $values->is_logged_in,
                        'is_cms' => (int) $values->is_cms,
                        'is_open' => (int) $values->is_open,
                        'is_badge' => (int) $values->is_badge,
                        'desc' => $values->description,
                        'nodes' => $arr2
                    );
                }
            }
            $res[] = array(
                'text' => 'root',
                'icon' => 'fa-contao',
                'href' => '#',
                'level' => '0',
                'id' => '0',
                'rank' => '0',
                'parent_id' => 0,
                'parent_name' => '',
                'module_id' => $id,
                'module_name' => $name,
                'is_active' => 1,
                'is_logged_in' => 1,
                'is_cms' => 1,
                'is_open' => 1,
                'is_badge' => 1,
                'desc' => '-',
                'nodes' => $arr1
            );
            if ($return == 'json') {
                if (isset($res) && !empty($res) && $res != null) {
                    return json_encode(array('status' => 200, 'message' => 'Successfully retrieving data.', 'data' => $res));
                } else {
                    return json_encode(array('status' => 201, 'message' => 'Token mismatch or expired', 'data' => null));
                }
            } elseif ($return == 'array') {
                return $res;
            }
        }
    }

    protected function get_parent_menu($id = null) {
        $res = array();
        if ($id != null) {
            $res = DB::table('tbl_menus AS a')->where([['a.is_active', 1], ['a.is_cms', 1], ['a.id', $id]])->orderBy('a.rank', 'asc')->first();
        }
        return $res;
    }

    protected function get_module($id = null) {
        $res = array();
        if ($id != null) {
            $res = DB::table('tbl_modules AS a')->where([['a.is_active', 1], ['a.id', $id]])->orderBy('a.id', 'asc')->first();
        }
        return $res;
    }

    public function load_css($class = array()) {
        if ($class) {
            View::share('load_css', $class);
        }
    }

    public function load_js($class = array()) {
        if ($class) {
            View::share('load_js', $class);
        }
    }

    public function load_ajax_var($values = array()) {
        if ($values) {
            View::share('load_ajax_var', $values);
        }
    }

}
