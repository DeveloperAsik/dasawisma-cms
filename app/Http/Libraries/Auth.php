<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Libraries;

use App\Http\Libraries\Session_Library AS SesLibrary;
use App\Http\Libraries\HttpRequest_Library AS HttpReqLibrary;
use App\Http\Libraries\Variables_Library AS VLibrary;

/**
 * Description of Auth
 *
 * @author root
 */
class Auth {

    //put your code here

    public static function set_token_access() {
        if (SesLibrary::_get('_uuid') || SesLibrary::_get('_uuid') == null) {
            $uri = VLibrary::init()['PATH']['_config_api_base_url'] . '/api/generate-token-access';
            $data = array('device_id' => SesLibrary::_get('_uuid'));
            $method = 'POST';
            $token = HttpReqLibrary::run($uri, $data, $method);
            debug($token);
        }
    }

}
