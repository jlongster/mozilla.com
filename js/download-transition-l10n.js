<script type="text/javascript" src="/js/download.js"></script>
<script type="text/javascript">// <![CDATA[

    /**
     * Over-ride this function that's originally setup in /js/download.js
     * We don't want to spawn the pop-up download hack if we're already
     * on the download page, since it will result in two downloads (the
     * href is already a direct link).
     *
     */
    function init_download() {
    }

    function parseGETVars()
    {
        // validate query according to RFC 3986
        var qs = location.search.substring(1);
        if (qs.match(/[^a-zA-Z0-9\-\._~%!$&'()*+,;=:@\/\?]/))
            return false;

        var nv = qs.split('&');
        var url = {};
        for(i = 0; i < nv.length; i++) {
            var eq = nv[i].indexOf('=');
            url[nv[i].substring(0,eq).toLowerCase()] = unescape(nv[i].substring(eq + 1));
        }

        return url;
    }

    function validateDownloadVar(value)
    {
        // validate download vars to prevent XSS
        if (value.match(/[^\-\.A-Za-z0-9]/))
            return false;

        return true;
    }

    var download_url = '';

    function initDownload()
    {
        // 1. Grab vars from URL (PRODUCT, OS, and LANG)
        var get = parseGETVars();

        var product = (get['product']) ? get['product'] : null;
        var os      = (get['os'])      ? get['os']      : null;
        var lang    = (get['lang'])    ? get['lang']    : null;

        var div = document.getElementById('download-message');

        if (   !product || !os || !lang
            || !validateDownloadVar(product)
            || !validateDownloadVar(os)
            || !validateDownloadVar(lang)
        ) {
            // No vars were specified, we do nothing on the l10n version because we redirect such cases by php.
            return;
        }

        var product_split = product.split('-');
        var product_name = product_split[0];
        var product_version = product_split[1];
        var product_title = '';
        var promotion_msg = '';

        switch (product_name) {
            case 'firefox' :
                product_title = 'Firefox';

                // Check for known unsupported platforms and redirect to the
                // unsupported platform page.
                if (gPlatformUnsupported) {
                    var uri = location.protocol + '//' + location.host + '/firefox/unsupported-systems.html' + location.search;
                    window.location = uri;
                    return;
                }

                switch (os) {
                    case 'win' :
                        var at_least_xp = /Windows NT (5\.[1-9]|[6-9]\.|[1-9][0-9]+\.)/.test(navigator.userAgent);
                        if (YAHOO.env.ua.ie && at_least_xp) {
                            promotion_msg = '';
                        } else {
                            document.body.className += ' default-download';
                        }
                        break;
                    case 'osx' :
                        promotion_msg = '';
                            break;
                    default:
                            document.body.className += ' default-download';
                    }
                break;
            default:
                product_title = '';
                promotion_msg = '';
        }

        // 2. Build download.mozilla.org URL out of those vars.
        download_url = "http://download.mozilla.org/?product=";
        download_url += product + '&os=' + os + '&lang=' + lang;

        // 3. display the download URL as a manual fall-back link
        var msg = '<div id="main-feature" class="main-feature-' + product_name + '">';
        msg += '<h2>Thanks for choosing ' + product_title + '!</h2>';

        // 4. display a promotional box with content based on the PRODUCT variable
        msg += '<p class="manual-download">Your download should automatically begin in a few seconds, but if not, ';
        var link_text = 'click here';
        msg += link_text.link(download_url) + '.</p>';
        msg += '</div>';
        msg += '<div id="content">';
        msg += promotion_msg;
        msg += '</div>';

        //div.innerHTML = msg;
    }

    initDownload();

    function downloadURL() {
        // Only start the download if we're not in IE.
        if (download_url.length != 0 && navigator.appVersion.indexOf('MSIE') == -1) {
            // 5. automatically start the download of the file at the constructed download.mozilla.org URL
            window.location = download_url;
        }
    }

    // If we're in Safari, call via setTimeout() otherwise use onload.
    if ( navigator.appVersion.indexOf('Safari') != -1 ) {
        window.setTimeout(downloadURL, 2500);
    } else {
        window.onload = downloadURL;
    }

// ]]></script>