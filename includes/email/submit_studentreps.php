<?php
/**
 * Main driver, process the form and send the subscription request if data is 
 * valid.
 */
function form_main($fields_def) {
    $sent = FALSE;
    if ('POST' != $_SERVER['REQUEST_METHOD']) {
        list( $f_data, $hf_data, $r_data, $f_errors ) = 
            prepopulate_form($fields_def, $_GET);
    } else {
        list( $f_data, $hf_data, $r_data, $f_errors ) = 
            validate_form($fields_def, $_POST);
        if (empty($f_errors)) {
            $lang = isset($r_data['lang']) ? $r_data['lang'] : 'en';
            require_once dirname(__FILE__) ."/responsys.php";

            if(empty($r_data['STUDENTS_LEVEL'])) {
                $r_data['STUDENTS_LEVEL'] = $r_data['STUDENTS_LEVEL_OTHER'];
            }

            if(empty($r_data['STUDENTS_ALLOW_SHARE'])) {
                $r_data['STUDENTS_ALLOW_SHARE'] = 'N';
            }
            else {
                $r_data['STUDENTS_ALLOW_SHARE'] = 'Y';
            }
            
            Responsys::subscribe($r_data['CAMPAIGN'], $r_data);
            $sent = TRUE;
        }
    }
    return array($f_data, $hf_data, $r_data, $f_errors, $sent);
}

/**
 * Prepopulate the form with defaults, or at least empty fields.
 */
function prepopulate_form($fields_def, $g_data) {
    list( $f_data, $hf_data, $r_data, $f_errors ) = 
        array( array(), array(), array(), array() );

    foreach ($fields_def as $f_name=>$f_def) {

        $is_list = !empty($f_def['rules']) && 
            in_array('list',$f_def['rules']);

        if (!empty($f_def['default'])) {
            $f_val = $f_def['default'];
        } else {
            $f_val = $is_list ? array() : '';
        }

        $f_data[$f_name] = $f_val;
        $hf_data[$f_name] = 
            htmlspecialchars($is_list ? join(', ', $f_val) : $f_val);

    }

    return array($f_data, $hf_data, $r_data, $f_errors);
}

/**
 * Validate form data based on field definitions.
 */
function validate_form($fields_def, $p_data) {
    list( $f_data, $hf_data, $r_data, $f_errors ) = 
        array( array(), array(), array(), array() );

    foreach ($fields_def as $f_name=>$f_def) {
        
        $f_val   = !empty($p_data[$f_name]) ? $p_data[$f_name] : NULL;
        $errors  = array();
        $is_list = FALSE;

        if (!empty($f_def['rules'])) {
            foreach ($f_def['rules'] as $rule) {
                switch ($rule) {
                    case 'list':
                        $is_list = TRUE;
                        if (NULL == $f_val) { $f_val = array(); }
                        break;
                    case 'required': 
                        if (empty($f_val)) { $errors[]='required'; }
                        break;
                    case 'email':
                        if (!email_rfc($f_val)) { $errors[]='email'; }
                        break;
                }
            }
        }
        
        if (!empty($errors)) $f_errors[$f_name] = $errors;
        
        $f_data[$f_name] = $f_val;
        
        $hf_data[$f_name] = 
            htmlspecialchars($is_list ? join(', ', $f_val) : $f_val);

        $r_name = (!empty($f_def['rname'])) ?  $f_def['rname'] : $f_name;
        $r_data[$r_name] =
            htmlspecialchars($is_list ? join(', ', $f_val) : $f_val);

    }

    return array($f_data, $hf_data, $r_data, $f_errors);
}

/**
 * Validate email, RFC compliant version
 *
 * @see  Originally by Cal Henderson, modified to fit Kohana syntax standards:
 * @see  http://www.iamcal.com/publish/articles/php/parsing_email/
 * @see  http://www.w3.org/Protocols/rfc822/
 *
 * @param   string   email address
 * @return  boolean
 */
function email_rfc($email)
{
    $qtext = '[^\\x0d\\x22\\x5c\\x80-\\xff]';
    $dtext = '[^\\x0d\\x5b-\\x5d\\x80-\\xff]';
    $atom  = '[^\\x00-\\x20\\x22\\x28\\x29\\x2c\\x2e\\x3a-\\x3c\\x3e\\x40\\x5b-\\x5d\\x7f-\\xff]+';
    $pair  = '\\x5c[\\x00-\\x7f]';

    $domain_literal = "\\x5b($dtext|$pair)*\\x5d";
    $quoted_string  = "\\x22($qtext|$pair)*\\x22";
    $sub_domain     = "($atom|$domain_literal)";
    $word           = "($atom|$quoted_string)";
    $domain         = "$sub_domain(\\x2e$sub_domain)*";
    $local_part     = "$word(\\x2e$word)*";
    $addr_spec      = "$local_part\\x40$domain";

    return (bool) preg_match('/^'.$addr_spec.'$/D', (string) $email);
}
