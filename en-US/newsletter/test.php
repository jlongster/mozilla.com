<?php

try {
    // Test for SoapClient support
    $cl = new SoapClient("http://responsys.com/webservices/services/ResponsysWSService");
    $cl->login(array("username" => "user",
                     "password" => "12345"));

    var_dump($cl->__getLastRequestHeaders());
}
catch(Exception $e) {
    var_dump($e);
}

?>