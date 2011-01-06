<?php
/*
 * commodity functions for the Firefox 4 beta pages
 */


function noCachingRedirect($url) {
    header('Date: '.gmdate('D, d M Y H:i:s \G\M\T', time()));
    header('Expires: Fri, 01 Jan 1990 00:00:00 GMT');
    header('Pragma: no-cache');
    header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0, private');
    header('Vary: *');
    header("Location: $url");
    exit;
}


function getVideoSubtitles($videoname, $subfile, $dynamic = false) {
    global $lang;
    global $config;
    ob_start();
    echo '
    <div id="'.$videoname.'" class="htmlPlayer subtitles">
        <div id="'.$videoname.'Description">'."\n";

    if (file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$lang.'/'.$subfile)) {
        include $config['file_root'].'/'.$lang.'/'.$subfile;
    } else {
        include $config['file_root'].'/en-GB/'.$subfile;
    }

    if ($dynamic){
        include $config['file_root'].'/'.$subfile;
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

    if(isset($_GET['comparesubs'])) {
        echo '<style> .hideme { display:block; position:absolute; left:0; margin-top: -3.5em; background-color: rgba(0,0,200,0.5); width:100%; height:3em;}</style>'."\n";
        foreach ($original as $key => $str) {
            $blank = empty($str[0]) ? ' data-special="blank"' : '';
            echo '<div data-start="'.$str[1].'"'.$blank.'><span class="hideme" dir="ltr">'.$str[0].'</span>'.$str[2].'</div>'."\n\n";
        }
    } else {
        foreach ($original as $key => $str) {
            $blank = empty($str[0]) ? ' data-special="blank"' : '';
            echo '<div data-start="'.$str[1].'"'.$blank.'>'.$str[2].'</div>'."\n\n";
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

?>