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

        if(isset($data['country'])) {
            if(!preg_match('/^\w{2}$/', $data['country'])) {
                throw new NewsletterValidationException('country');
            }
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

        if (!isset($data['aurora']) && !isset($data['beta']) && !isset($data['general'])) {
            throw new NewsletterValidationException('channel');
        }

        if (!array_key_exists('privacy', $data)) {
            throw new NewsletterValidationException('privacy');
        }

        if(isset($data['country'])) {
            if(!preg_match('/^\w{2}$/', $data['country'])) {
                throw new NewsletterValidationException('country');
            }
        }
        
        return true;
    }

    function subscribe() {
        $data = $this->data;

        if(isset($data['aurora'])) {
            Responsys::subscribe($this->campaigns[0], $this->data);
        }

        if(isset($data['beta'])) {
            Responsys::subscribe($this->campaigns[1], $this->data);
        }

        if(isset($data['general'])) {
            Responsys::subscribe($this->campaigns[2], $this->data);
        }

    }
}

class ChannelsPrivacyForm extends ChannelsForm {
    function validate() {
        parent::validate();

        if (!array_key_exists('privacy', $this->data)) {
            throw new NewsletterValidationException('privacy');
        }
        
        return true;
    }
}

class LocalizedNewsletterForm extends NewsletterForm {
    var $optin;

    function __construct($campaign, $data, $optin = TRUE) {
        $this->campaign = $campaign;
        $this->data = $data;
        $this->optin = $optin;
    }

    function subscribe() {
        $now = date('Y-m-d');
        $data = $this->data;

        $data = array('EMAIL_ADDRESS_' => $data['email'],
                      'LANGUAGE_ISO2' => $data['lang'],
                      'COUNTRY_' => $data['country'],
                      'EMAIL_FORMAT_' => getattr($data, 'format', 'H'));

        $data[$this->campaign . '_FLG'] = $this->optin ? 'Y' : 'N';
        $data[$this->campaign . '_DATE'] = $now;

        if(!$this->optin) {
            $data['EMAIL_PERMISSION_STATUS_'] = 'O';
        }

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

class DrumbeatNewsletterForm extends NewsletterForm {
    function subscribe() {
        // transform some data, to match what Responsys is expecting
        $this->data['FIRST_NAME'] = $this->data['firstname'];
        $this->data['LAST_NAME'] = $this->data['lastname'];
        parent::subscribe();
    }
}
