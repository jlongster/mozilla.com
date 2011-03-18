<?php

/*
 * format numbers according to national conventions ans localizers preferences
 *
 */

function localeNumberFormat($val) {
    if(UI_LANG == 'en') {
        $val = number_format($val, 0, '.', ',');
    } else if(UI_LANG == 'fi') {
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

function goToEnglishPage() {
    global $config;
    $requested = explode('/', $_SERVER['REDIRECT_URL']);
    if (strstr(end($requested), '.html') || strstr(end($requested), '.php')) {
        array_pop($requested);
        $requested = implode('/', $requested).'/';
    }

    noCachingRedirect('http://'.$config['server_name'].'/en-US'.$requested);
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
        $image_template.= ' />';

        // build platform-specific image tags
        $filename_exp = explode('.', $filename);
        $extension = array_pop($filename_exp);
        $base = implode('.', $filename_exp);
        foreach ($platforms as $platform) {
            $platform_filename = $base . '-' . $platform . '.' . $extension;
            // if a linux or mac localized screenshot does not exist, we want to fallback to en-US screenshot
            if(!file_exists($_SERVER['DOCUMENT_ROOT'].$platform_filename)) {
                $platform_filename = str_replace('/'.UI_LANG.'/', '/en-US/', $platform_filename);
            }

            $platform_image[$platform] = sprintf($image_template, $platform_filename);
        }

        // if a windows localized screenshot does not exist, we want to fallback to en-US screenshot
        if(!file_exists($_SERVER['DOCUMENT_ROOT'].$filename)) {
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
