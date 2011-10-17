<?php
# Make sure the page is on HTTPS, for some reason the %{HTTPS}
# Apache variable does not work!
if(in_array($config['server_name'], array('www-dev.allizom.org',
                                          'www.allizom.org',
                                          'www.mozilla.org',
                                          'mozilla.org')) &&
   $config['url_scheme'] != 'https') {
        header("Location: https://{$config['server_name']}{$_SERVER['REQUEST_URI']}");
        exit;
}
?>