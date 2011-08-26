(function() {

    var getString = function(variable, defaultValue)
    {
        if (typeof window[variable] === 'undefined') {
            return defaultValue;
        }

        return window[variable];
    };

    var setCookie = function(name, value, path, expire, domain)
    {
        if (expire) {
            expire = ';expires=' + expire.toUTCString();
        } else {
            expire = '';
        }

        if (path) {
            path = ';path=' + path;
        } else {
            path = '';
        }

        if (domain) {
            domain = ';domain=' + domain;
        } else {
            domain = '';
        }

        document.cookie = name + '=' + escape(value) + expire + path + domain;
    };

    var getCookie = function(name)
    {
        if (document.cookie.length === 0) {
            return null;
        }

        var start = document.cookie.indexOf(name + '=');

        if (start === -1) {
            return null;
        }

        start += name.length + 1;
        end    = document.cookie.indexOf(';', start);
        if (end === -1) {
            end = document.cookie.length;
        }

        return unescape(document.cookie.substring(start, end));
    };

    var clearCookie = function(name, path, domain)
    {
        var thePast = new Date();
        thePast.setTime(0);
        if (getCookie(name)) {
            setCookie(name, '', path, thePast, domain);
        }
    };

    var advertisingCookie = 'ID';
    var advertisingDomain = '.mozilla.org';

    var $advertisingStatus = $('<span class="out-out-status"></span>');

    var $advertisingButton = $('<input type="button" />')
        .click(function() { advertisingToggle(); });

    var advertisingStatus = function()
    {
        return (getCookie(advertisingCookie) == 'OPT_OUT');
    };

    var advertisingOptOut = function()
    {
        var expiry = new Date();
        var ms = expiry.getTime();
        // roughly ten years, doesn't have to be precise
        ms += 10 * 365 * 24 * 60 * 60 * 1000;
        expiry.setTime(ms);

        setCookie(
            advertisingCookie,
            'OPT_OUT',
            '/',
            expiry,
            advertisingDomain
        );
    };

    var advertisingOptIn = function()
    {
        clearCookie(
            advertisingCookie,
            '/',
            advertisingDomain
        );
    };

    var advertisingUpdateDisplay = function()
    {
        if (advertisingStatus()) {
            $advertisingButton.attr(
                'value',
                getString(
                    'advertisingButtonOptOutString',
                    'Opt-in to advertising tracking now'
                )
            );
            $advertisingStatus.text(
                getString(
                    'advertisingStatusOptOutString',
                    'You have opted-out of advertising tracking.'
                )
            );
            if ($advertisingStatus.hasClass('status-in')) {
                $advertisingStatus.removeClass('status-in');
            }
            $advertisingStatus.addClass('status-out');
        } else {
            $advertisingButton.attr(
                'value',
                getString(
                    'advertisingButtonOptInString',
                    'Opt-out of advertising tracking now'
                )
            );
            $advertisingStatus.text(
                getString(
                    'advertisingStatusOptInString',
                    'You have not opted-out of advertising tracking.'
                )
            );
            if ($advertisingStatus.hasClass('status-out')) {
                $advertisingStatus.removeClass('status-out');
            }
            $advertisingStatus.addClass('status-in');
        }
    };

    var advertisingToggle = function()
    {
        if (advertisingStatus()) {
            advertisingOptIn();
        } else {
            advertisingOptOut();
        }

        advertisingUpdateDisplay();
    };

    $(document).ready(function() {
        var $advertisingWidget = $('#advertising_opt_out');
        $advertisingWidget
            .append($advertisingStatus)
            .append($advertisingButton);

        advertisingUpdateDisplay();

        var interval = setInterval(function() {
            advertisingUpdateDisplay();
        }, 1000);
    });

})();
