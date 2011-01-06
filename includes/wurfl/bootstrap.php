<?php

header("Vary: User-Agent");

require_once "WURFL/WURFLManagerProvider.php";
require_once "product-details/mobileDetails.class.php";

$wurfl_config = dirname(__FILE__) ."/config.php";
$wurfl_manager = WURFL_WURFLManagerProvider::getWURFLManager($wurfl_config);
$wurfl_device = $wurfl_manager->getDeviceForHttpRequest($_SERVER);

$nokia = array('nokia_n810', 'nokia_n900');
$android = array('android');
$wurfl_supported_devices = array(
    'nokia_n810' => mobileDetails::maemo,
    'nokia_n900' => mobileDetails::maemo,
    'android' => mobileDetails::android,
);

$wurfl_device_supported = false;
$mobile_platform = mobileDetails::android;
$ua_string = $_SERVER['HTTP_USER_AGENT'];

if (stripos($ua_string, 'android 2') !== false) {
    $wurfl_device_supported = true;
    $mobile_platform = mobileDetails::android;

} else if (stripos($ua_string, 'maemo browser') !== false ||
           stripos($ua_string, 'tablet browser') !== false) {
    $wurfl_device_supported = true;
    $mobile_platform = mobileDetails::maemo;

# sorry, using error suppression here to avoid stupid PHP notices from WURFL
} else if (@$wurfl_device->id) {
    foreach ($wurfl_supported_devices as $pattern => $platform) {
        if (stripos($wurfl_device->id, $pattern) !== false) {
            $wurfl_device_supported = true;
            $mobile_platform = $platform;
        }
    }
}
