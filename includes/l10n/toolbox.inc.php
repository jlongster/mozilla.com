<?php

/*
 * format numbers according to national conventions ans localizers preferences
 *
 */

function localeNumberFormat($val) {
    if (UI_LANG == 'en') {
        $val = number_format($val, 0, '.', ',');
    } elseif (UI_LANG == 'fi') {
        $val = number_format($val, 0, ',', ' ');
    } else {
        $val = number_format($val, 0, ',', '.');
    }

    return $val;
}


// dummy function to avoid error in code borrowed from mozilla-europe
function localeConvert($lang) {
    return $lang;
}


function goToLocale($locale) {
    global $config;
    $requested = explode('/', $_SERVER['REDIRECT_URL']);
    $requested = secureText($requested);

    if (strstr(end($requested), 'index.html') || strstr(end($requested), 'index.php')) {
        array_pop($requested);
        $requested = implode('/', $requested) . '/';
    } else {
        $requested = implode('/', $requested);
    }

    noCachingRedirect('http://' . $config['server_name'] . '/' . $locale . $requested);
    exit;
}

/* this is a wrapper for the old goToEnglishPage() function still used on the site */
function goToEnglishPage() {
    goToLocale('en-US');
}

function noCachingRedirect($url) {
    header('Status: 302 Moved Temporarily', false, 302);
    header('Date: ' . gmdate('D, d M Y H:i:s \G\M\T', time()));
    header('Expires: Fri, 01 Jan 1990 00:00:00 GMT');
    header('Pragma: no-cache');
    header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0, private');
    header('Vary: *');
    header("Location: $url");
    exit;
}


function permanentRedirect($url) {
    header('Status: 301 Moved Permanently', false, 301);
    header('Date: ' . gmdate('D, d M Y H:i:s \G\M\T', time()));
    header('Expires: Fri, 01 Jan 1990 00:00:00 GMT');
    header('Vary: *');
    header("Location: $url");
    exit;
}

/*
 *  fork of buildPlatformImage() used on features page but l10n friendly
 */

function buildPlatformImageL10n($filename, $alt, $width = null, $height = null,
                                $class = null, $platforms = array('mac')) {
        if($platforms == null) { $platforms = array('');}
        $valid_platforms = array('mac', 'linux', 'xp');
        $platforms = array_intersect($valid_platforms, $platforms);
        // reindex array, we expect ordinal indexing later
        $platforms = array_values($platforms);

        // maps platforms to JavaScript boolean expressions
        $platform_conditional = array(
                'mac'     => 'gPlatform == PLATFORM_MACOSX',
                'linux'   => 'gPlatform == PLATFORM_LINUX',
                'xp'      => '!gPlatformVista',
        );

        $filename = minimizeEntities($filename);
        $filename = escapeForJavaScript($filename);

        $alt = minimizeEntities($alt);
        $alt = escapeForJavaScript($alt);
        $alt = str_replace('%', '%%', $alt);

        // build image tag template
        $image_template = '<img src="%s" alt="' . $alt .'"';
        if (is_int($width)) {
                $image_template.= ' width="' . $width . '"';
        }
        if (is_int($height)) {
                $image_template.= ' height="' . $height . '"';
        }
        if (is_string($class)) {
                $class = minimizeEntities($class);
                $class = escapeForJavaScript($class);
                $class = str_replace('%', '%%', $class);
                $image_template.= ' class="' . $class . '"';
        }

        $image_template .= ' />';

        // build platform-specific image tags
        $filename_exp = explode('.', $filename);
        $extension = array_pop($filename_exp);
        $base = implode('.', $filename_exp);
        foreach ($platforms as $platform) {
            $platform_filename = $base . '-' . $platform . '.' . $extension;
            // if a linux or mac localized screenshot does not exist, we want to fallback to en-US screenshot
            if(!file_exists($_SERVER['DOCUMENT_ROOT'] . $platform_filename)) {
                $platform_filename = str_replace('/' . UI_LANG . '/', '/en-US/', $platform_filename);
            }

            $platform_image[$platform] = sprintf($image_template, $platform_filename);
        }

        // if a windows localized screenshot does not exist, we want to fallback to en-US screenshot
        if(!file_exists($_SERVER['DOCUMENT_ROOT'] . $filename)) {
            $filename = str_replace('/'.UI_LANG.'/', '/en-US/', $filename);
        }
        $default_image = sprintf($image_template, $filename);

        ob_start();

        if (count($platforms) === 0) {
                echo $default_image;
        } else {
                echo '<script type="text/javascript">// <![CDATA[', "\n";

                foreach ($platforms as $index => $platform) {
                        if ($index == 0) {
                                printf("if (%s) {\n\tdocument.write('%s');\n",
                                        $platform_conditional[$platform],
                                        $platform_image[$platform]);
                        } else {
                                printf("} else if (%s) {\n\tdocument.write('%s');\n",
                                        $platform_conditional[$platform],
                                        $platform_image[$platform]);
                        }
                }

                printf("} else {\n\tdocument.write('%s');\n}\n",
                        $default_image);

                echo '// ]]></script><noscript><div style="display: inline;">',
                        $default_image,
                        "</div></noscript>";
        }

        return ob_get_clean();
}

function checkProductionQuality($lang, $productionQuality, $host = 'www.mozilla.com') {
    if (!in_array($lang, $productionQuality) && $_SERVER['HTTP_HOST'] ==  $host) {
        $requested = explode('/', $_SERVER['REDIRECT_URL']);
        if (strstr(end($requested), '.html') || strstr(end($requested), '.php')) {
            array_pop($requested);
            $requested = implode('/', $requested) . '/';
        }
        goToEnglishPage();
        exit;
    }

    return false;
}

function getVideoSubtitles($videoname, $subfile, $dynamic = false) {
    global $lang;
    global $config;
    ob_start();
    echo '
    <div id="' . $videoname . '" class="htmlPlayer subtitles">
        <div id="' . $videoname . 'Description">'."\n";

    if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $lang . '/' . $subfile)) {
        include $config['file_root'] . '/' . $lang . '/' . $subfile;
    } else {
        include $config['file_root'] . '/en-GB/' . $subfile;
    }

    if ($dynamic){
        include $config['file_root'] . '/' . $subfile;
        outputSubtitles($sub, $refsubs);
    }


    echo '
        </div>
    </div>';
    $subtitles = ob_get_contents();
    ob_clean();

    return $subtitles;
}


function outputSubtitles($subarray, $original) {

    foreach ($subarray as $key => $str) {
        $original[$key][2] = $str;
    }

    if (isset($_GET['comparesubs'])) {
        echo '<style> .hideme { display:block; position:absolute; left:0; margin-top: -3.5em; background-color: rgba(0,0,200,0.5); width:100%; height:3em;}</style>'."\n";
        foreach ($original as $key => $str) {
            $blank = empty($str[0]) ? ' data-special="blank"' : '';
            echo '<div data-start="' . $str[1] . '"' . $blank . '><span class="hideme" dir="ltr">' . $str[0] . '</span>' . $str[2] . '</div>'."\n\n";
        }
    } else {
        foreach ($original as $key => $str) {
            $blank = empty($str[0]) ? ' data-special="blank"' : '';
            echo '<div data-start="' . $str[1] . '"' . $blank.'>' . $str[2] . '</div>'."\n\n";
        }
    }
}


function get_include_contents($filename) {
    if (is_file($filename)) {
        ob_start();
        include_once $filename;
        $contents = ob_get_contents();
        ob_end_clean();
        return $contents;
    }

    return false;
}


/**
 * Function sanitizing a string or an array of strings.
 * Returns a string or an array, depending on the input
 *
 */

function secureText($var, $tablo = true) {
    if (!is_array($var)) {
        $var   = array($var);
        $tablo = false;
    }

    foreach ($var as $item => $value) {
        // CRLF XSS
        $item  = str_replace('%0D', '', $item);
        $item  = str_replace('%0A', '', $item);
        $value = str_replace('%0D', '', $value);
        $value = str_replace('%0A', '', $value);

        // Remove html tags and ASCII characters below 32
        // Deactivated filter since we are still on PHP <5.2 on mozilla.com...
/*
        $value = filter_var(
            $value,
            FILTER_SANITIZE_STRING,
            FILTER_FLAG_STRIP_LOW
        );
*/
        //

        $item  = strip_tags($item);
        $value = strip_tags($value);

        // Repopulate value
        $var2[$item] = $value;
    }

    return ($tablo == true) ? $var2 : $var2[0];
}
