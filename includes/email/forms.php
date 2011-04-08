<?php
require_once dirname(__FILE__) ."/responsys.php";
require_once dirname(__FILE__) ."/../validation.php";

class NewsletterValidationException extends Exception {
    function __construct($code = '') {
        $this->code = $code;
    }
}

class NewsletterForm {
    var $campaign;
    var $data;
    var $error;

    function __construct($campaign, $data) {
        $this->campaign = $campaign;
        $this->data = $data;
    }

    function submitted() {
        return array_key_exists('submit', $this->data);
    }

    function validate() {
        $data = $this->data;

        if (!isset($data['email']) || !preg_match('/^([\w\-.+])+@([\w\-.])+\.[A-Za-z]{2,4}$/', $data['email'])) {
            throw new NewsletterValidationException('email');
        }
        if (!array_key_exists('privacy', $data)) {
            throw new NewsletterValidationException('privacy');
        }
        return true;
    }

    function subscribe() {
        Responsys::subscribe($this->campaign, $this->data);
    }

    function save() {
        if ($this->submitted()) {
            try {
                $this->validate();
                $this->subscribe();
                return true;
            } catch (NewsletterValidationException $e) {
                $this->error = $e->getCode();
            }
        }
        return false;
    }

    function get($key, $default = '', $clean = true) {
        if (array_key_exists($key, $this->data)) {
            $val = $this->data[$key];
            return $clean ? htmlentities($val) : $val;
        }
        return $default;
    }

}

class ChannelsForm extends NewsletterForm {
    function __construct($campaigns, $data) {
        $this->campaigns = $campaigns;
        $this->data = $data;
    }

    function validate() {
        $data = $this->data;
        
        if (!isset($data['email']) || !preg_match('/^([\w\-.+])+@([\w\-.])+\.[A-Za-z]{2,4}$/', $data['email'])) {
            throw new NewsletterValidationException('email');
        }

        return true;
    }

    function subscribe() {
        $data = $this->data;

        if(isset($data['aurora'])) {
            Responsys::subscribe($this->campaign[0], $this->data);
        }

        if(isset($data['beta'])) {
            Responsys::subscribe($this->campaign[1], $this->data);
        }

        if(isset($data['release'])) {
            Responsys::subscribe($this->campaign[2], $this->data);
        }

    }}

class GermanNewsletterForm extends NewsletterForm {
    function subscribe() {
        $now = date('Y-m-d');

        $data = array('EMAIL_ADDRESS_' => $this->data['email'],
                      'LANGUAGE_ISO2' => $this->data['lang'],
                      'COUNTRY_' => $this->data['country']);

        $data[$this->campaign . "_FLG"] = 'Y';
        $data[$this->campaign . "_DATE"] = $now;

        Responsys::post($data);
    }
}

class ExtraNewsletterForm extends NewsletterForm {
    function subscribe() {
        parent::subscribe();
        if (array_key_exists('extra_news', $this->data)) {
            Responsys::subscribe('MOZILLA_AND_YOU', $this->data);
        }
    }
}

class MobileNewsletterForm extends NewsletterForm {
    function validate() {
        parent::validate();

        if (empty($this->data['role'])) {
            throw new NewsletterValidationException('role');
        }
        return true;
    }

    function subscribe() {
        // transform some data, to match what Responsys is expecting
        $this->data['MOBILE_SEGMENT'] = $this->data['role'];
        $this->data['FIRST_NAME'] = $this->data['firstname'];
        $this->data['LAST_NAME'] = $this->data['lastname'];
        $this->data['MOBILE_COMMENTS'] = $this->data['other'];
        parent::subscribe();
    }
}

class DrumbeatNewsletterForm extends NewsletterForm {
    function subscribe() {
        // transform some data, to match what Responsys is expecting
        $this->data['FIRST_NAME'] = $this->data['firstname'];
        $this->data['LAST_NAME'] = $this->data['lastname'];
        parent::subscribe();
    }
}
