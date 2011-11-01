<?php

require_once("basket.php");

class EmailPrefs {

    var $languages = array(
        'en' => array('English', array('mozilla-and-you', 'mobile', 'beta')),
        'fr' => array('French', array('mozilla-and-you', 'mobile')),
        'de' => array('German', array('mozilla-and-you', 'mobile')),
        'pt-BR' => array('Portugese', array('mozilla-and-you', 'mobile')),
        'es' => array('Spanish', array('mozilla-and-you', 'mobile'))
    );

    var $newsletters = array(
        'mozilla-and-you' => array('title' => 'Firefox & You',
                                   'desc' => 'Get the latest tips and tricks for getting the most out of your favorite browser.'),
        'mobile' => array('title' => 'Firefox Mobile',
                          'desc' => 'Learn about the hottest new add-ons and features for Firefox mobile.'),
        'beta' => array('title' => 'Beta News',
                        'desc' => 'Read about the latest features for Firefox desktop and mobile before the final release.')
    );

    var $general_error = 'Something is amiss with our system, sorry! Please try again later.';
    var $auth_error = 'The supplied link has expired. You will receive a new one in the next newsletter.';

    function __construct($data=NULL, $token=FALSE) {
        $this->data = $data;
        $this->errors = array();
        $this->non_field_error = NULL;
    }

    function get($field) {
        return isset($this->data[$field]) ? $this->data[$field] : NULL;
    }

    function available_langs() {
        return $this->languages;
    }

    function available_newsletters() {
        return $this->newsletters;
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

    function is_unsubscribing() {
        return $this->data && isset($this->data['remove-all']);
    }

    function handle_exception($e) {
        if($e->getCode() == 403) {
            $this->non_field_error = $this->auth_error;
        }
        else {
            $this->non_field_error = $this->general_error;
            $this->non_field_error = $e->getMessage();
        }
    }

    function validate($required_fields=NULL) {
        $data = $this->data;
        
        if(!$required_fields) {
            $required_fields = array('email');
        }

        if(in_array('email', $required_fields) &&
           !isset($data['email']) ||
           !preg_match('/^([\w\-.+])+@([\w\-.])+\.[A-Za-z]{2,4}$/', $data['email'])) {
            $this->errors[] = 'email';
        }

        if(in_array('country', $required_fields) &&
           !preg_match('/^\w{2}$/', $data['country'])) {
            $this->errors[] = 'country';
        }

        if(in_array('privacy', $required_fields) && !isset($data['privacy'])) {
            $this->errors[] = 'privacy';
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

    function save_new(/* required fields */) {
        global $lang;

        $this->reset();
        $required_fields = func_get_args();
        $opts = array();

        if(is_array($required_fields[0])) {
            $opts = $required_fields[0];
            $required_fields = array_slice($required_fields, 1);
        }

        if($this->submitted() && $this->validate($required_fields)) {
            $data = $this->data;
            $newsletters = $this->get_newsletters();

            if(!empty($newsletters)) {
                $serv = new BasketService();

                try {
                    $trigger = isset($opts['trigger_welcome']) ? $opts['trigger_welcome'] : TRUE;

                    $ret = $serv->subscribe(array('email' => $data['email'],
                                                  'format' => $data['format'] == 'html' ? 'H' : 'T',
                                                  'country' => $data['country'],
                                                  'lang' => $data['lang'],
                                                  'locale' => $lang,
                                                  'trigger_welcome' => $trigger ? 'Y' : 'N',
                                                  'newsletters' => $newsletters));
                    return $ret['token'];
                }
                catch(BasketException $e) {
                    $this->handle_exception($e);
                }
            }
            else {
                $this->non_field_error = "No newsletter selected";
            }
        }

        return FALSE;
    }

    function get_user($token) {
        $this->token = $token;

        // If we already have data, we don't need the user
        if(!empty($this->data))
            return TRUE;

        if(!$token) {
            $this->non_field_error = $this->auth_error;
            return FALSE;
        }

        $serv = new BasketService();

        try {
            $this->data = $serv->get_subscriber($this->token);

            // Digest for our forms
            foreach($this->data['newsletters'] as $nl) {
                $this->data[$nl] = 'Y';
            }

            $this->data['format'] = $this->data['format'] == 'H' ? 'html' : 'text';
            return TRUE;
        }
        catch(BasketException $e) {
            $this->data = array();
            $this->handle_exception($e);
        }

        return FALSE;
    }

    function save_user(/* required fields */) {
        global $lang;

        $this->reset();
        $required_fields = func_get_args();

        if($this->submitted() && $this->validate($required_fields)) {
            $data = $this->data;
            $serv = new BasketService();

            if(isset($data['remove-all'])) {
                try {
                    $serv->unsubscribe($this->token,
                                       array('email' => $data['email'],
                                             'optout' => 'Y'));
                    return TRUE;
                }
                catch(BasketException $e) {
                    $this->handle_exception($e);
                }
            }
            else {
                $newsletters = $this->get_newsletters();

                try {
                    $serv->update_subscriber($this->token,
                                             array('email' => $data['email'],
                                                   'format' => $data['format'] == 'html' ? 'H' : 'T',
                                                   'country' => $data['country'],
                                                   'lang' => $data['lang'],
                                                   'locale' => $lang,
                                                   'newsletters' => $newsletters));
                    return TRUE;
                }
                catch(BasketException $e) {
                    $this->handle_exception($e);
                }
            }
        }

        return FALSE;
    }

}

?>