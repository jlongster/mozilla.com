<?php

class HTML {
    static function inline_script($paths) {
        $script = self::_get_contents($paths);
        return "<script type='text/javascript'>{$script}</script>";
    }

    static function inline_style($paths) {
        $style = self::_get_contents($paths);
        return "<style>{$style}</style>";
    }

    static function _get_contents($paths) {
        require dirname(__FILE__) .'/config.inc.php';

        if (!is_array($paths))
            $paths = array($paths);
        
        $out = '';
        foreach ($paths as $p)
            $out .= file_get_contents($config['file_root'] .'/'. $p);

        return $out;
    }

    static function script($src) {
        return "<script src='{$src}' type='text/javascript'></script>";
    }

    static function style($href) {
        return "<link href='{$href}' rel='stylesheet'>";
    }
}
