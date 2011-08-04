<?php

require_once("basket.php");

class EmailPrefs {

    function __construct($data, $token=FALSE) {
        $this->data = $data;
        $this->errors = array();
        $this->token = $token;
    }

    function get($field) {
        return isset($this->data[$field]) ? $this->data[$field] : NULL;
    }

    function submitted() {
        return array_key_exists('submit', $this->data);
    }

    function has_error($field=FALSE) {
        if($field) {
            return in_array($field, $this->errors);
        }
        return count($this->errors) > 0;
    }

    function has_non_field_error() {
        return !empty($this->non_field_error);
    }

    function validate() {
        $data = $this->data;

        if (!isset($data['email']) || !preg_match('/^([\w\-.+])+@([\w\-.])+\.[A-Za-z]{2,4}$/', $data['email'])) {
            $this->errors[] = 'email';
        }

        if(isset($data['country']) &&
           !preg_match('/^\w{2}$/', $data['country'])) {
            $this->errors[] = 'country';
        }

        return count($this->errors) == 0;
    }

    function reset() {
        $this->errors = array();
    }

    function get_newsletters() {
        $lst = array();
        $other_fields = array('email', 'format', 'country', 'lang');

        foreach($this->data as $key => $val) {
            if(!in_array($key, $other_fields) && $val == 'Y') {
                $lst[] = $key;
            }
        }

        return join($lst, ',');
    }

    function save_new() {
        $this->reset();

        if($this->submitted() && $this->validate()) {
            $data = $this->data;
            $newsletters = $this->get_newsletters();

            if(!empty($newsletters)) {
                $serv = new BasketService();
                $ret = $serv->subscribe(array('email' => $data['email'],
                                              'format' => $data['format'] == 'html' ? 'H' : 'T',
                                              'country' => $data['country'],
                                              'lang' => $data['lang'],
                                              'newsletters' => $newsletters));
                if($res['status'] != 'ok') {
                    $this->non_field_error = $res['desc'];
                }
            }
        }

        return FALSE;
    }

    function get_user() {
        $serv = new BasketService();
        $this->data = $serv->get_subscriber($this->token);

        if($this->data) {
            foreach($this->data['newsletters'] as $nl) {
                $this->data[$nl] = 'Y';
            }
        }

        $this->data['format'] = $this->data['format'] == 'H' ? 'html' : 'text';
    }

    function save_user() {
        $this->reset();

        if($this->submitted() && $this->validate()) {
            $data = $this->data;
            $newsletters = array_join($this->get_newsletters(), ',');

            if(!empty($newsletters)) {
                $serv = new BasketService();
                $ret = $serv->update($this->token,
                                     array('email' => $data['email'],
                                           'format' => $data['format'] == 'html' ? 'H' : 'T',
                                           'country' => $data['country'],
                                           'lang' => $data['lang'],
                                           'newsletters' => $newsletters,
                                           'only_these' => 'Y'));

                if($res['status'] != 'ok') {
                    $this->non_field_error = $res['desc'];
                }
            }                
        }

        return FALSE;
    }

}

?>