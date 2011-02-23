<?php

Responsys::$lang = $lang;

class Responsys {

    static $lang = '';

    static function subscribe($campaign, $data = array()) {  
        $data['EMAIL_ADDRESS_'] = $data['email'];
        if (isset($data['country'])) {
            $data['COUNTRY_'] = $data['country'];
        }
        $data['EMAIL_FORMAT_'] = 'H';
        if (isset($data['format']) && strtolower($data['format']) == 'text') {
            $data['EMAIL_FORMAT_'] = 'T';
        }

        $data[$campaign .'_FLG'] = 'Y';
        $data[$campaign .'_DATE'] = date('Y-m-d');

        return Responsys::post($data);
    }

    static function post($data) {
        require dirname(__FILE__) .'/../config.inc.php';

        $data['LANG_LOCALE'] = self::$lang;
        $data['SOURCE_URL'] = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        $data['_ri_'] = isset($config['responsys_id']) ? $config['responsys_id'] : 'X0Gzc2X%3DUQpglLjHJlTQTtQyTQ3qQ0OQQzgQvQviRVwjpnpgHlpgneHmgJoXX0Gzc2X%3DUQpglLjHJlTQTtQyTQ3qQ0NQQGQvQvH3';

        $_curl = curl_init('http://awesomeness.mozilla.org/pub/rf');  
        curl_setopt($_curl, CURLOPT_FOLLOWLOCATION, true);  
        
        curl_setopt($_curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($_curl, CURLOPT_POST, true);
        // not sure why, but responsys + curl doesn't work unless we build the query string ourselves :(
        curl_setopt($_curl, CURLOPT_POSTFIELDS, http_build_query($data));

        $response = curl_exec($_curl);  
        if (!$response) {  
            $response = curl_error($_curl);  
        }  
        $code = curl_getinfo($_curl, CURLINFO_HTTP_CODE);
        return $response;  
    }
}
