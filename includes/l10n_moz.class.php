<?php
# ***** BEGIN LICENSE BLOCK *****
# Version: MPL 1.1/GPL 2.0/LGPL 2.1
#
# The contents of this file are subject to the Mozilla Public License Version
# 1.1 (the "License"); you may not use this file except in compliance with
# the License. You may obtain a copy of the License at
# http://www.mozilla.org/MPL/
#
# Software distributed under the License is distributed on an "AS IS" basis,
# WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License
# for the specific language governing rights and limitations under the
# License.
#
# The Original Code is DotClear Weblog.
#
# The Initial Developer of the Original Code is
# Olivier Meunier.
# Portions created by the Initial Developer are Copyright (C) 2003
# the Initial Developer. All Rights Reserved.
#
# Contributor(s): Pascal Chevrel (Mozilla)
#                 Wil Clouser    (Mozilla)
#
# Alternatively, the contents of this file may be used under the terms of
# either the GNU General Public License Version 2 or later (the "GPL"), or
# the GNU Lesser General Public License Version 2.1 or later (the "LGPL"),
# in which case the provisions of the GPL or the LGPL are applicable instead
# of those above. If you wish to allow use of your version of this file only
# under the terms of either the GPL or the LGPL, and not to allow others to
# use your version of this file under the terms of the MPL, indicate your
# decision by deleting the provisions above and replace them with the notice
# and other provisions required by the GPL or the LGPL. If you do not delete
# the provisions above, a recipient may use your version of this file under
# the terms of any one of the MPL, the GPL or the LGPL.
#
# ***** END LICENSE BLOCK *****

class l10n_moz
{
    function __construct()
    {
        $GLOBALS['__l10n_moz'] = array();
        $GLOBALS['__l10n_moz_files'] = array();
    }


    /**
     *  method mostly used in contexts where we can't male a call to ___()
     *  such ad heredoc blocks where we can only include variables called from
     *  the class
     */
    public function get($key)
    {
        if (array_key_exists($key, $GLOBALS['__l10n_moz']) && !empty($GLOBALS['__l10n_moz'][$key])) {
            return $GLOBALS['__l10n_moz'][$key];
        } else {
            return $key;
        }
    }


    /**
     * Reads in a file of strings into a global array.  File format is:
        ;String in english
        translated string

        ;Another string
        another translated string

     */
    static function load($file, $type = 'lang')
    {
        if (!file_exists($file)) {
            return false;
        }

        $f = file($file);

        if ($type == 'lang') {
            #Remove BOM in the created array for .lang files added by Windows text editors.
            #Reason: this invisible character prevents parsing the file correctly.
            $f[0] = trim($f[0], "\xEF\xBB\xBF");

            $GLOBALS['__l10n_moz_files'][] = $file;
            $lines = count($f);

            for ($i=0; $i<$lines; $i++) {
                if (substr($f[$i],0,1) == ';' && !empty($f[$i+1])) {
                    $GLOBALS['__l10n_moz'][trim(substr($f[$i],1))] = trim($f[$i+1]);
                    $i++;
                }
            }

        } elseif ($type == 'po') {
            $tmp = l10n_moz::getPoFile($file);
            $GLOBALS['__l10n_moz_files'][] = $file;
            $GLOBALS['__l10n_moz'] = array_merge($GLOBALS['__l10n_moz'], $tmp);
        } else {
            return false;
        }
    }


    /**
     * Gettext import file function
     */
    static function getPoFile($file)
    {
        if (!file_exists($file)) {
            return false;
        }

        $fc      = implode('', file($file));
        $res     = array();
        $matched = preg_match_all('/(msgid\s+("([^"]|\\\\")*?"\s*)+)\s+'.
        '(msgstr\s+("([^"]|\\\\")*?"\s*)+)/',
        $fc, $matches);

        if (!$matched) {
            return false;
        }

        for ($i=0; $i<$matched; $i++)
        {
            $msgid  = preg_replace('/\s*msgid\s*"(.*)"\s*/s','\\1',  $matches[1][$i]);
            $msgstr = preg_replace('/\s*msgstr\s*"(.*)"\s*/s','\\1', $matches[4][$i]);
            $res[l10n_moz::poString($msgid)] = l10n_moz::poString($msgstr);
        }

        if (!empty($res[''])) {
            $meta = $res[''];
            unset($res['']);
        }

        return $res;
    }

    /**
     * Gettext import string function
     */
    static function poString($string,$reverse=false)
    {
        if ($reverse) {
            $smap = array('"', "\n", "\t", "\r");
            $rmap = array('\\"', '\\n"' . "\n" . '"', '\\t', '\\r');
            return (string) str_replace($smap, $rmap, $string);
        } else {
            $smap = array('/"\s+"/', '/\\\\n/', '/\\\\r/', '/\\\\t/', '/\\"/');
            $rmap = array('', "\n", "\r", "\t", '"');
            return (string) preg_replace($smap, $rmap, $string);
        }
    }
}
