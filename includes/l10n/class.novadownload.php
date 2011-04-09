<?php

class firefoxDetailsL10n extends firefoxDetails
{

    function getLocaleBoxHome($locale, $options=array()) {
        $_include_js               = array_key_exists('include_js', $options)               ? $options['include_js']                : true;
        $_blockclass               = array_key_exists('blockclass', $options)               ? $options['blockclass']                : 'home-download';
        $_js_replace_links         = array_key_exists('js_replace_links', $options)         ? $options['js_replace_links']          : false;
        $_include_ancillary_links  = array_key_exists('ancillary_links', $options)          ? $options['ancillary_links']           : true;
        $_download_parent_override = array_key_exists('download_parent_override', $options) ? $options['download_parent_override']  : 'main-feature';
        $_bouncer_js               = array_key_exists('bouncer_js', $options)               ? $options['bouncer_js']                : false;
        $_extra_link_attr          = array_key_exists('extra_link_attr', $options)          ? $options['extra_link_attr']           : false;
        $_channel                  = array_key_exists('channel', $options)                  ? $options['channel']                   : 'stable';

        switch ($_channel) {
            case 'older':
                $_current_version    = $this->getOldestVersionForLocaleFromBuildArray($locale, $this->primary_builds);
                $_betalocale_version = $this->getOldestVersionForLocaleFromBuildArray($locale, $this->beta_builds);
                $_targetted_version  = $option['version'] = LATEST_FIREFOX_OLDER_VERSION;
                break;

            case 'beta':
                $_current_version    = $this->getDevelVersionForLocaleFromBuildArray($locale, $this->primary_builds);
                $_betalocale_version = $this->getDevelVersionForLocaleFromBuildArray($locale, $this->beta_builds);
                $_targetted_version  = $option['version'] = LATEST_FIREFOX_DEVEL_VERSION;
                break;

            case 'aurora':
                $_current_version    = $this->getAuroraVersionForLocaleFromBuildArray($locale, $this->primary_builds);
                $_betalocale_version = $this->getAuroraVersionForLocaleFromBuildArray($locale, $this->beta_builds);
                $_targetted_version  = $option['version'] = FIREFOX_AURORA;
                break;

            case 'stable':
            default:
                $_current_version    = $this->getNewestVersionForLocaleFromBuildArray($locale, $this->primary_builds);
                $_betalocale_version = $this->getNewestVersionForLocaleFromBuildArray($locale, $this->beta_builds);
                $_targetted_version  = LATEST_FIREFOX_RELEASED_VERSION;
                break;
        }


        // if we have no builds at all, let's default to en-US so as to display download boxes on pages
        if(!in_array($_targetted_version, array($_current_version, $_betalocale_version))) {
            $locale           = 'en-US';
            $_current_version = $this->getNewestVersionForLocaleFromBuildArray($locale, $this->primary_builds);
        } elseif ($_current_version == '') {
            $_current_version              = $_betalocale_version;
            $_blockclass                  .= ' betalocale';
            $options['betalocale_status']  = true;
        }

        $_locale_link_override = array_key_exists('locale_link_override', $options) ? $options['locale_link_override'] : $locale;
        $_ancillary_links      = $_include_ancillary_links ? $this->getAncillaryLinksForLocaleDiv($_locale_link_override, $options) : '';

        $options['version'] = $_current_version;

        $_in_primary = empty($this->primary_builds[$locale][$_current_version]) ? array('') : $this->primary_builds[$locale][$_current_version];
        $_in_beta    = empty($this->beta_builds[$locale][$_current_version])    ? array('') : $this->beta_builds[$locale][$_current_version];
        $_platforms  = array('Windows', 'Linux', 'OS X');

        foreach ($_platforms as $_os_var) {

            if (array_key_exists($_os_var, $_in_primary) && !isset($_in_primary[$_os_var]['unavailable']) ) {
                $_os_support[$_os_var] = true;
            } elseif (array_key_exists($_os_var, $_in_beta) && !isset($_in_beta[$_os_var]['unavailable']) ) {
                $_os_support[$_os_var] = true;
            } else {
                $_os_support[$_os_var] = false;
            }

            if ($_os_support[$_os_var] == true) {
                // Special case for OS X and Japanese...
                $_t_locale = ($locale == 'ja') ? 'ja-JP-mac' : $locale;
                $_temp[$_os_var] = $this->_getDownloadBlockListHtmlForLocaleAndPlatform2($_t_locale, $_os_var, $options);
            } else {
                $_temp[$_os_var] = $this->_getDownloadBlockListHtmlForLocaleAndPlatform2('en-US', $_os_var, $options);
            }
        }

        $_li_windows = $_temp['Windows'];
        $_li_linux   = $_temp['Linux'];
        $_li_osx     = $_temp['OS X'];


        if ($_include_js) {
            $_js_replace_links = $_js_replace_links ? 'true' : 'false';
            $_js_include = <<<JS_INCLUDE
            <script type="text/javascript">// <![CDATA[
                // If they haven't overridden this variable, set it to the default

                if (!download_parent_override) {
                    var download_parent_override = '{$_download_parent_override}';
                }

                if ({$_js_replace_links} && ('function' == typeof window.replaceDownloadLinksForId)) {
                    replaceDownloadLinksForId(download_parent_override);
                }
                if ('function' == typeof window.offerBestDownloadLink) {
                    offerBestDownloadLink(download_parent_override);
                }
                // unset download_parent_override otherwise you can't have 2 boxes on the same page !
                download_parent_override = '';

            /**
             * Will set the download class to the input.  Used for hiding links to download for
             * other platforms.
             *
             * @param object the parent class for the download's <ul>
             * @param string class to add
             */

            // ]]></script>

JS_INCLUDE;

        } else {
            $_js_include = '';
        }


        $_return = <<<HTML_RETURN

        <ul class="{$_blockclass}">
{$_li_windows}
{$_li_linux}
{$_li_osx}
        </ul>

{$_ancillary_links}

{$_js_include}
HTML_RETURN;

        return $this->tweakString($_return, $options);
    }


    function _getDownloadBlockListHtmlForLocaleAndPlatform2($locale, $platform, $options=array()) {
        $_product                     = array_key_exists('product', $options) ?  $options['product'] : 'firefox';
        $_extra_link_attr             = array_key_exists('extra_link_attr', $options) ? $options['extra_link_attr'] : '';
        $_layout                      = array_key_exists('layout', $options) ? $options['layout'] : '';
        $_current_version             = array_key_exists('version', $options) ? $options['version'] : $this->getNewestVersionForLocale($locale);
        $_bouncer_js                  = array_key_exists('bouncer_js', $options) ? $options['bouncer_js'] : false;
        $_download_product            = array_key_exists('download_product', $options) ?  ___($options['download_product']) : ___('Free Download');
        $_wording                     = array_key_exists('wording', $options) ?  ___($options['wording']) : 'Firefox';
        $_release_notes               = ___('Release Notes');
        $_other_systems_and_languages = ___('Other Systems and Languages');
        $_language_name               = $this->localeDetails->getNativeNameForLocale($locale);
        $_windows_name                = ___('Windows');
        $_linux_name                  = ___('Linux');
        $_osx_name                    = ___('Mac OS X');
        $_mb                          = ___('MB');
        $_megabytes                   = ___('MegaBytes');
        $_betalocale_status           = array_key_exists('betalocale_status', $options) ?  $options['betalocale_status'] : false;

        if (in_array($locale, $this->has_transition_download_page)) {
           $_download_base_url = $this->download_base_url_transition;
        } else {
           $_download_base_url = $this->download_base_url_direct;
        }

        if($_betalocale_status) {
            $_betalocaletext = '<em style="color:orange; text-align:right;float:right; font-size:90%; padding: 0 5px;">beta language</em>';
        } else {
            $_betalocaletext = '';
        }

        switch ($platform) {
            case 'Windows':
                $_os_class     = 'os_windows';
                $_os_shortname = 'win';
                $_os_name      = ___('Windows');
                $_os_file_ext  = 'win32.installer.exe';
                break;
            case 'Linux':
                $_os_class     = 'os_linux';
                $_os_shortname = 'linux';
                $_os_name      = ___('Linux');
                $_os_file_ext  = 'linux-i686.tar.bz2';
                break;
            case 'OS X':
                $_os_class     = 'os_osx';
                $_os_shortname = 'osx';
                $_os_name      = ___('Mac OS X');
                $_os_file_ext  = 'en-US.mac.dmg';
                break;
            default:
                return;
        }

        // include the onclick js needed to go through IE6 popup blocker
        if ($_bouncer_js) {
            $_extra_link_attr .= 'onclick="javascript:do_download(\''."http://download.mozilla.org/?product={$_product}-{$_current_version}&amp;os={$_os_shortname}&amp;lang={$locale}".'\');"';
        }



        // fix a display bug in the download box if there is an english string in it
        global $lang;
        if(in_array($lang, array('ar', 'fa', 'he'))) {
            $extra_dl_info = "<em>$_os_name - <span dir=\"ltr\">$_language_name</span></em>";
        } else {
            $extra_dl_info = "<em>$_os_name - $_language_name</em>";
        }

        switch ($_layout) {
            case 'linksonly':

                $_return = <<<LI_SIDEBAR
                <li class="{$_os_class}"><a class="download-{$_product}" href="{$_download_base_url}?product={$_product}-{$_current_version}&amp;os={$_os_shortname}&amp;lang={$locale}" {$_extra_link_attr}>{$_download_product}</a>
                </li>
LI_SIDEBAR;
                break;

            case 'smallbox':

                $_return = <<<LI_SIDEBAR
                <li class="{$_os_class}"><a class="download-link download-{$_product}" href="{$_download_base_url}?product={$_product}-{$_current_version}&amp;os={$_os_shortname}&amp;lang={$locale}" {$_extra_link_attr}><span class="download-content"><span class="download-title">{$_wording}</span>{$_download_product}</span></a></li>
LI_SIDEBAR;
                break;

            case 'betabox':

                $_return = <<<LI_SIDEBAR
                <li class="{$_os_class}"><a class="download-link" href="{$_download_base_url}?product={$_product}-{$_current_version}&amp;os={$_os_shortname}&amp;lang={$locale}" {$_extra_link_attr}><span>{$_download_product}</span></a>{$extra_dl_info}
                </li>
LI_SIDEBAR;
                break;

            case 'aurora':

                $_return = <<<LI_SIDEBAR
                <li class="{$_os_class}">
                <a class="download" href="http://ftp.mozilla.org/pub/mozilla.org/firefox/nightly/latest-mozilla-aurora/{$_product}-{$_current_version}.{$locale}.{$_os_file_ext}"><span><strong>{$_download_product}</strong> Mozilla Firefox Aurora</span>{$extra_dl_info}</a>
                </li>
LI_SIDEBAR;
                break;

            case 'simple':

                $_return = <<<LI_SIDEBAR
                <li class="{$_os_class}">
                <a class="download" href="{$_download_base_url}?product={$_product}-{$_current_version}&amp;os={$_os_shortname}&amp;lang={$locale}"><span><strong>{$_download_product}</strong> Mozilla Firefox 4</span>{$extra_dl_info}</a>
                </li>
LI_SIDEBAR;
                break;

            case 'main':
            default:
                $_return = <<<LI_MAIN
                <li class="{$_os_class}">
                    <a class="download-link download-{$_product}" href="{$_download_base_url}?product={$_product}-{$_current_version}&amp;os={$_os_shortname}&amp;lang={$locale}" {$_extra_link_attr}>
                        <span class="download-content">
                            <span class="download-title">{$_wording} <img class="download-arrow" alt="" src="/img/home/download-arrow.png"></span>
                            {$_download_product}
                            <span class="download-info">{$_os_name} &middot; {$_current_version} &middot; {$_language_name}</span>
                            {$_betalocaletext}
                        </span>
                    </a>
                </li>
LI_MAIN;
                break;
        }

        return $_return;
    }

    function getAncillaryLinksForLocaleDiv($locale, $options=array()) {
        $_devel_version = array_key_exists('devel_version', $options) ? $options['devel_version'] : false;

        if ($_devel_version) {
            $_current_version = $this->getDevelVersionForLocaleFromBuildArray($locale, $this->primary_builds);
            $_all_page_link = 'all-beta.html';
        } else {
            $_current_version = $this->getNewestVersionForLocale($locale);
            $_all_page_link = 'all.html';
        }

        $_release_notes               = ___('Release Notes');
        $_other_systems_and_languages = ___('Other Systems and Languages');
        $_privacy_policy              = ___('Privacy Policy');

        $_return = <<<HTML_RETURN
        <div class="download-other">
            <a class="ancillaryLink" href="/{$locale}/firefox/{$_current_version}/releasenotes/">{$_release_notes}</a> -
            <a class="ancillaryLink" href="http://www.mozilla.com/{$locale}/legal/privacy/">{$_privacy_policy}</a> -
            <a class="ancillaryLink" href="http://www.mozilla.com/{$locale}/firefox/all.html">{$_other_systems_and_languages}</a>
        </div>
HTML_RETURN;

        return $_return;
    }

}

?>
