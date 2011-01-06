<?php

/**
 * Extra HTML header content for the "Fastest Firefox" page
 *
 * CSS and JavaScript should be included here as long as they are not
 * language-specific.
 */

// The $body_* variables are for compatibility with pre-existing css
$body_id    = 'fastest';
$html5      = true;

include_once $_SERVER['DOCUMENT_ROOT']."/includes/l10n/class.novadownload.php";

$firefoxDetailsl10n = new firefoxDetailsL10n();

$smalldownloadbox  = "\n".'<!-- generated box -->'."\n";
$smalldownloadbox .= "\n".'<script type="text/javascript">//<![CDATA['."\n";
$smalldownloadbox .= file_get_contents($_SERVER['DOCUMENT_ROOT'].'/js/download.js');
$smalldownloadbox .= "\n".'//]]>></script>'."\n";
$smalldownloadbox .= "\n".'<div  id="download" class="top-right">'."\n";
$options['download_parent_override'] = 'download';
$options['layout'] = 'smallbox';
$smalldownloadbox .= $firefoxDetailsl10n->getLocaleBoxHome($lang, $options);
$smalldownloadbox .= "\n".'</div>'."\n";
$smalldownloadbox .= "\n".'<!-- end generated box -->'."\n";

unset($firefoxDetailsl10n);

$extra_headers = <<<EXTRA_HEADERS

<script src="/includes/yui/2.5.1/animation/animation-min.js"></script>
<script src="/js/mozilla-video-tools.js"></script>
<link rel="stylesheet" href="{$config['static_prefix']}/style/covehead/fastest.css" media="screen" />
<style>
#main-feature p {
    margin-right: 347px;
}

</style>
<script>
// <![CDATA[
        Mozilla.VideoPlayer.close_text = '{$l10n->get('Close')}';
        Mozilla.VideoScaler.close_text = '{$l10n->get('Close')}';
// ]]>
</script>
EXTRA_HEADERS;

$nb_video = 3;

$video_player1 = <<<VIDEO_PLAYER
            <script>
            // <![CDATA[
            var player_french = new Mozilla.VideoPlayer(
                'video-french',
                [
                    {
                        url:   'http://videos-cdn.mozilla.net/firefox/3.5/fastest/4/fastest-clapper.ogv',
                        type:  'video/ogg; codecs=&quot;theora, vorbis&quot;',
                        title: '{$download_ogg}'
                    },
                    {
                        url:   'http://videos-cdn.mozilla.net/firefox/3.5/fastest/1/fastest-clapper.mp4',
                        type:  'video/mp4',
                        title: '{$download_mp4}'
                    }
                ],
                'firefox/3.5/fastest/1/fastest-clapper.mp4'
            );
            // ]]>
            </script>
VIDEO_PLAYER;

$video_player2 = <<<VIDEO_PLAYER
            <script>
            // <![CDATA[
            var player_purugganan = new Mozilla.VideoPlayer(
                'video-purugganan',
                [
                    {
                        url:   'http://videos-cdn.mozilla.net/firefox/3.5/fastest/3/fastest-cupstacker.ogv',
                        type:  'video/ogg; codecs=&quot;theora, vorbis&quot;',
                        title: '{$download_ogg}'
                    },
                    {
                        url:   'http://videos-cdn.mozilla.net/firefox/3.5/fastest/2/fastest-cupstacker.mp4',
                        type:  'video/mp4',
                        title: '{$download_mp4}'
                    }
                ],
                'firefox/3.5/fastest/2/fastest-cupstacker.mp4'
            );
            // ]]>
            </script>
VIDEO_PLAYER;

$video_player3 = <<<VIDEO_PLAYER
            <script>
            // <![CDATA[
            var player_taylor = new Mozilla.VideoPlayer(
                'video-taylor',
                [
                    {
                        url:   'http://videos-cdn.mozilla.net/firefox/3.5/fastest/5/fastest-banjo.ogv',
                        type:  'video/ogg; codecs=&quot;theora, vorbis&quot;',
                        title: '{$download_ogg}'
                    },
                    {
                        url:   'http://videos-cdn.mozilla.net/firefox/3.5/fastest/6/fastest-banjo.mp4',
                        type:  'video/mp4',
                        title: '{$download_mp4}'
                    }
                ],
                'firefox/3.5/fastest/6/fastest-banjo.mp4'
            );
            // ]]>
            </script>
VIDEO_PLAYER;

$launch_date = strftime(___('%Y-%m-%d'), strtotime('2009-06-28'));

$coming_soon_video1 = <<<COMING_SOON
<div class="video" id="coming-soon-1">
    <div class="thumbnail"><img src="/img/tignish/firefox/fastest/preview-coming-soon.jpg" alt="" height="140" width="198" /></div>
    <p>{$check_back}</p>
</div>
COMING_SOON;

$coming_soon_video2 = <<<COMING_SOON
<div class="video video-last" id="coming-soon-2">
    <div class="thumbnail"><img src="/img/tignish/firefox/fastest/preview-coming-soon.jpg" alt="" height="140" width="198" /></div>
    <p>{$check_back}</p>
</div>
<div class="clear"></div>
COMING_SOON;

$extra_footers = <<<EXTRA_FOOTERS
<!-- script src="/js/mozilla-platform-images.js"></script> -->
EXTRA_FOOTERS;

$fx_prerelease_file = "all-beta.html";

$primary_video = <<<PRIMARY_VIDEO
    <div id="primary-video">
        <div id="video-player" class="mozilla-video-control">
            <video
                id="video"
                width="640"
                height="360"
                controls="controls" autobuffer="autobuffer">

                <source src="http://videos-cdn.mozilla.net/firefox/3.5/fastest/fastest-users.ogv" type="video/ogg; codecs=&quot;theora, vorbis&quot;" />
                <source src="http://videos-cdn.mozilla.net/firefox/3.5/fastest/fastest-users.m4v" type="video/mp4" />

                <object type="application/x-shockwave-flash"
                    style="width: 640px; height: 428px;"
                    data="/includes/flash/playerWithControls.swf?flv=firefox/3.5/fastest/fastest-users.m4v
&amp;autoplay=false&amp;msg={$play}">

                    <param name="movie" value="/includes/flash/playerWithControls.swf?flv=firefox/3.5/fastest/fastest-users.m4v
&amp;autoplay=false&amp;msg={$play}" />
                    <param name="wmode" value="transparent" />

                    <div class="video-player-no-flash">
                    {$fallback_l1}
                    <ul>
                    <li>{$fallback_l2}</li>
                    <li>{$fallback_l3}</li>
                    </ul>
                    {$fallback_l4}</a>.
                    </div>
                </object>
            </video>
        </div>
    </div>
PRIMARY_VIDEO;
?>
