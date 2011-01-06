<?php
define("NO_BINARY", -2);
define("SIZE_UNKNOWN", -1);
define("ABSOLUTE_URL", 0);


class Product
{
    var $name;
    var $lang;
    var $version;
    var $releaseNotes;
    var $baseDownload;
    var $downloads = array();

    function Product($lang)
    {
        $this->lang = $lang;
    }

    function hasPlatformBinary($platform)
    {
        return array_key_exists($platform, $this->downloads) &&
               (!empty($this->downloads[$platform]['link']) &&
                $this->downloads[$platform]['size'] != NO_BINARY);
    }

    function getVersion()
    {
        return $this->version;
    }

    function getVersionTranslated()
    {
        return is_num($this->version) ? $this->version : ___($this->version);
    }

    function printVersion($lang = false)
    {
        echo $this->getVersionTranslated();
        if ($lang)
           echo ' (' . $this->getLangPretty() . ')';
    }

    function printName()
    {
        echo $this->name;
    }

    function printFullName()
    {
        echo $this->name;
        echo ' ';
        echo $this->getVersionTranslated();
    }

    function getLang()
    {
        return $this->lang;
    }

    function printLang()
    {
        echo $this->getLang();
    }

    function getLangPretty()
    {
        if (isset($GLOBALS['_native_languages']) &&
            array_key_exists($this->lang, $GLOBALS['_native_languages'])) {
            return ___($GLOBALS['_native_languages'][$this->lang]);
        }
        return $this->lang;
    }

    function getDownloadLink($platform, $displaySize, $displayVersionLang)
    {
        $platforms = array('win32' => 'Windows',
                           'linux' => 'Linux',
                           'macosx' => 'Mac&nbsp;OS&nbsp;X',
                           'contrib' => ___('Other operating systems'));
        $_platform = ___('Unknown'); # default to unknown

        $nativeLang = $this->getLangPretty();
        $res = '<a href="' . $this->getCompleteURL($platform) . '" ' .
               'title="' . $this->getVersionTranslated() . ', ' . $nativeLang . '">';
        if (!empty($platform) && array_key_exists($platform, $platforms))
            $_platform = $platforms[$platform];
        $res .= $_platform . '</a>';
        $displaySuffix = '';
        if ($displayVersionLang)
            $displaySuffix = $this->getVersionTranslated() . ', ' . $nativeLang;
        if ($displaySize && $this->getDownloadSizePretty($platform) != '') {
            if ($displayVersionLang)
                $displaySuffix .=  ', ';
            $displaySuffix .= $this->getDownloadSizePretty($platform);
        }
        if (!empty($displaySuffix))
            $res .= ' (' . $displaySuffix . ')';
        return $res;
    }

    function printDownloadLink($platform, $displaySize = true, $displayVersionLang = false)
    {
        echo $this->getDownloadLink($platform, $displaySize, $displayVersionLang);
    }

    function printDownloadLinksInternal($tag, $platform)
    {
        if ($this->hasPlatformBinary($platform)) {
            echo '<' . $tag . ' class="'.$platform.'">';
            echo $this->getDownloadLink($platform, true, false);
            echo '</' . $tag . '>';
        }
    }

    function printDownloadLinks($tag)
    {
        $this->printDownloadLinksInternal($tag, 'win32');
        $this->printDownloadLinksInternal($tag, 'macosx');
        $this->printDownloadLinksInternal($tag, 'linux');
        $this->printDownloadLinksInternal($tag, 'contrib');
    }

    function getDownloadSize($platform)
    {
        $res = 0;
        if ($this->hasPlatformBinary($platform)) {
            $res = $this->downloads[$platform]['size'];
        }
        return $res;
    }

    function getDownloadSizePretty($platform)
    {
        $res = $this->getDownloadSize($platform);

        return $res <= 0 ? '' : round($res / 1024 / 1024, 1) . ___('MB');
    }

    function printDownloadSize($platform)
    {
        echo getDownloadSizePretty($platform);
    }

    function getCompleteURL($platform)
    {
        $res = $this->baseDownload;
        if ($this->hasPlatformBinary($platform)) {
            if ($this->downloads[$platform]['size'] == ABSOLUTE_URL)
                $res = $this->downloads[$platform]['link'];
            else
                $res .= $this->downloads[$platform]['link'];
        }
        return $res;
    }

    function printCompleteURL($platform)
    {
        echo $this->getCompleteURL($platform);
    }

    function getReleaseNotesURL()
    {
        return $this->releaseNotes;
    }

    function printReleaseNotesURL()
    {
        echo $this->getReleaseNotesURL();
    }
}
	
?>
