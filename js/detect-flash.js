/**
 * Adobe Flash Player version check for the What's New page
 *
 * @copyright 2011 Mozilla Inc.
 */
$(document).ready(function() {

    var requiredFlashVersion = '10.3.181.26';

    function getFlashVersion()
    {
        var plugin = navigator.plugins['Shockwave Flash'];

        if (!plugin) {
            // No Flash plugin detected
            return -1;
        }

        var detectedVersion = plugin.version;

        if (detectedVersion === '') {
            // Linux doesn't support Plugin.version properly
            var matches = plugin.description.match(/([0-9]+)\.([0-9]+) r([0-9]+)$/);
            if (matches.length === 0) {
                // Could not parse the plugin description
                return -1;
            }
            detectedVersion = matches[1] + '.' + matches[2] + '.' + matches[3];
        }

        if (!detectedVersion) {
            // Maybe an unsupported browser
            return -1;
        }

        var detected = detectedVersion.split('.');

        if (detected.length < 3) {
            // Unknown Flash version detected
            return -1;
        }

        return detectedVersion;
    }

    function verifyFlashVersion()
    {
        var detectedVersion = getFlashVersion();

        if (detectedVersion === -1) {
            // No Flash plugin detected
            return -1;
        }

        var detected = detectedVersion.split('.');
        var required = requiredFlashVersion.split('.');

        if (Number(detected[0]) > Number(required[0])) {
            // major version is greater than required version
            return true;
        }

        if (Number(detected[0]) === Number(required[0])) {
            if (Number(detected[1]) > Number(required[1])) {
                // minor version is greater than required version
                return true;
            }

            if (Number(detected[1]) === Number(required[1])) {
                if (detected.length < 4) {
                    if (Number(detected[2]) >= Number(required[2])) {
                        // revision is greater than required version
                        return true;
                    }
                } else {
                    if (Number(detected[2]) > Number(required[2])) {
                        // revision is greater than required version
                        return true;
                    }

                    if (Number(detected[2]) === Number(required[2])) {
                        if (Number(detected[3]) >= Number(required[3])) {
                            // build number is greater than required version
                            return true;
                        }
                    }
                }
            }
        }

        return false;
    }

    // Don't show a message for Mac OS PPC or Windows CE because they are not
    // supported anymore by Adobe.
    var isWinCE   = (navigator.appVersion.indexOf('WindowsCE') > -1);
    var isPPCMac  = (navigator.userAgent.indexOf('PPC Mac') > -1);
    var isWindows = (navigator.appVersion.indexOf('Windows') > -1 && !isWinCE);

    var $featureSection = $('#main-feature');

    if ($featureSection && !isWinCE && !isPPCMac) {
        var $body = $('body');
        var hasRequiredVersion = verifyFlashVersion();
        if (!hasRequiredVersion && hasRequiredVersion !== -1) {

            if (typeof(FlashAlertTitle) == 'undefined') {
                FlashAlertTitle = 'Your Flash Player is out of date. Never ' +
                'fear, we can help.';
            }

            if (typeof(FlashAlertText) == 'undefined') {
                FlashAlertText = 'To keep you as safe as possible, we ' +
                'recommend you upgrade your Flash Player. Without it, ' +
                'your browser could be less stable and less secure. So ' +
                '<a href="http://get.adobe.com/flashplayer/" onclick="dcsMultiTrack(\'DCS.dcssip\', \'get.adobe.com\', \'DCS.dcsuri\', \'/flashplayer/\', \'WT.ti\', \'Adobe&20-%20Adobe%20Flash%20Player\');">get the free update now</a> ' +
                'or <a href="http://support.mozilla.com/kb/Managing+the+Flash+plugin#w_updating-flash">learn more</a>.';
            }

            if ($body.attr('id') == 'whatsnew') {
                $body.addClass('flash-warning');
                $('#main-content').before(
                    '<div id="flash-warning">' +
                    '<h2>' + FlashAlertTitle + '</h2>' +
                    '<p>' + FlashAlertText + '</p>' +
                    '<a href="#" id="flash-close">✖</a></div>'
                );
            }
        }

        if (!isWindows) {
            // track old Flash versions on non-Windows platforms
            var version = getFlashVersion();
            if (version !== -1) {
                $body.append('<img src="/img/blank.gif?version=' + version + '">');
            }
        }

    }
});

$(function () {
    $('#flash-close').live('click',function () {
        $(this).parent().remove();
    });
});
