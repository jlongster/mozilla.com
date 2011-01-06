<?php
/**
 * Form data validation functions
 */
class Validation
{

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
    public static function email_rfc($email)
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

}
