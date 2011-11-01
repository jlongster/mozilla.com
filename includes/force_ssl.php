<?php
if(in_array($config['server_name'], array('www-dev.allizom.org',
                                          'www.allizom.org',
                                          'www.mozilla.org',
                                          'mozilla.org'))) {
    if($config['url_scheme'] != 'https') {
        // Force the page to use SSL
        header("Location: https://{$config['server_name']}{$_SERVER['REQUEST_URI']}");
        exit;
    }
    else {
        // Implement HTTP Strict Transport Security 
        // http://tools.ietf.org/html/draft-hodges-strict-transport-sec-02
        // Set max-age to 3 days
        header('Strict-Transport-Security: max-age=259200; includeSubDomains');
    }
}


?>