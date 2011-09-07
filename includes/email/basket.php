<?php

// Wrapper for interacting with the basket web service. There are
// several methods for working with newsletter subscriptions.

// See
// https://github.com/mozilla/basket/blob/master/apps/news/README
// for documentation on the API.

class BasketException extends Exception {
    public function __construct($message, $code, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}

class BasketService {

    function get($method) {
        return $this->curl($method);
    }

    function post($method, $data=NULL) {
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
        $status = curl_getinfo($_curl, CURLINFO_HTTP_CODE);

        if (!$response || $status != 200) {
            if(!$response) {
                $response = "Could not connect to basket service.";
            }
            throw new BasketException($response, $status);
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

    function delete_subscriber($token) {
        return json_decode($this->post('delete/' . $token . '/'), TRUE);
    }
}

?>