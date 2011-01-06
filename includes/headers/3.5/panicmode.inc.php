<?php

/**
 * These changes are applied to whatsnew/firstrun if we have too much video load
 *
 * $mode values:
 * 0 display dailymotion version of the page
 * 1 display CDN version of the page
 * 2 don't include video, hide the video column, redo styling
 */


$mode = 1;

if (isset($_GET['mode'])) { $mode = intval($_GET['mode']); }


$cssfix = <<<FIX_CSS

<style type="text/css">
div#open-video {
    display:none !important;;
}

#main-content
{
    background: none !important;
}

#main-content .sub-feature h3 {
    background:transparent url(/img/tignish/whatsnew/sub-feature-top.png) no-repeat scroll left top !important;
    padding:20px 25px 0 5px !important;
}

#main-content #sub-features {
    background: none !important;
}

#main-content .sub-feature {
    background:transparent url(/img/tignish/whatsnew/sub-feature-bottom.png) no-repeat scroll left bottom !important;
    padding-left:0 !important;
}

#main-content #sumo * , #main-content #addons * {
    margin-right:0 !important;
    padding-right:0 !important;
}

#main-content #sumo p {
    margin-top: 0px;
}


#follow {
    text-align: left !important;
    margin-left: 90px !important;
}

</style>
FIX_CSS;

switch ($mode) {

    case 0:
        $video_block = true;
        $video_url = 'http://videos-cdn.mozilla.net/firefox/3.5/thankyou/thankyou.ogv';
        $dailymotion  = '';
        $autobuffer = '';
        break;

    case 1:
        $video_block = true;
        $video_url = 'http://videos-cdn.mozilla.net/firefox/3.6/fx35_thankyou.ogv';
        $dailymotion  = '';
        $autobuffer = ' autobuffer="autobuffer"';
        break;

    case 2:
        $extra_headers .= $cssfix;
        $video_block = false;
        $video_url = '';
        $dailymotion  = '';
        $autobuffer = '';
        break;

    default:
        $cssfix = '';
        $video_block = true;
        $video_url = 'http://www.dailymotion.com/cdn/OGG-320x240/video/x9euyb?auth=1269605698_a8b629faf0d043e1b538971997ff9ba5';
        $dailymotion  = '<div id="thanks">'.str_replace('%s', 'http://openvideo.dailymotion.com/', ___('This video brought to you by <a href="%s">Dailymotion</a>, proud supporters of open video.')).'</div>';
        $autobuffer = '';
        break;

}


if ($video_block) {
$video = <<<VIDEO
        <div class="mozilla-video-scaler">
            <div class="mozilla-video-control">
                 <video id="video" src="{$video_url}"{$autobuffer}></video>
            </div>
        </div>
VIDEO;
}
else
{
$video = '';
}

?>
