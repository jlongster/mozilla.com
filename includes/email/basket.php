<?php

// Wrapper for interacting with the basket web service. There are
// several methods for working with newsletter subscriptions.

// See
// https://github.com/mozilla/basket/blob/master/apps/news/README
// for documentation on the API.

class BasketService {

    function get($method) {
        return $this->curl($method);
    }

    function post($method, $data) {
        return $this->curl($method, $data);
    }

    function curl($method, $data=NULL) {
        global $config;

        $_curl = curl_init("{$config['basket_url']}/news/" . $method);
        curl_setopt($_curl, CURLOPT_FOLLOWLOCATION, true);  
        curl_setopt($_curl, CURLOPT_RETURNTRANSFER, true);

        if($data) {
            curl_setopt($_curl, CURLOPT_POST, true);
            curl_setopt($_curl, CURLOPT_POSTFIELDS, http_build_query($data));
        }

        $response = curl_exec($_curl);
        if (!$response) {
            $response = curl_error($_curl);
        }
        
        return $response;
    }

    function subscribe($data) {
        return json_decode($this->post('subscribe/', $data), TRUE);
    }

    function unsubscribe($token, $data) {
        return json_decode($this->post('unsubscribe/' . $token . '/', $data), TRUE);
    }

    function update_subscriber($token, $data) {
        return json_decode($this->post('user/' . $token . '/', $data), TRUE);
    }

    function get_subscriber($token) {
        return json_decode($this->get('user/' . $token . '/'), TRUE);
    }
}

?>