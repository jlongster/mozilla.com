<?php

// commodity functions for localized pages
require_once $config['file_root'].'/includes/l10n/toolbox.inc.php';

// temporary include to parallelize webdev and l10n- webdev work on the project
require_once $config['file_root'].'/includes/l10n/firefoxlive-helper.inc.php';

$link = array(
    0 => 'http://knoxville-zoo.org/about-the-zoo/support-the-zoo/make-a-donation.html',
    1 => "/$lang/firefox/new/?WT.mc_id=fxlive2",
    2 => 'http://www.mozilla.org/about/mission.html',
);


$extra_headers .= <<<EXTRA_HEADERS
    <link rel="stylesheet" href="{$config['static_prefix']}/style/covehead/firefoxlive.css" media="screen" />
EXTRA_HEADERS;


// RTL support for Mozilla.com
if ($textdir == 'rtl') {
    $extra_headers  = <<<EXTRA_HEADERS
    {$extra_headers}
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/covehead/rtl.css" media="screen" />
EXTRA_HEADERS;
}

// no italic for Chineses
if ($lang == 'zh-CN' || $lang == 'zh-TW') {
    $extra_headers  = <<<EXTRA_HEADERS
    {$extra_headers}
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/l10n/covehead/chinese-mod.css" media="screen" />
EXTRA_HEADERS;
}

// no uppercasing for Greek
if ($lang == 'el') {
    $extra_headers  = <<<EXTRA_HEADERS
    {$extra_headers}
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/l10n/covehead/greek-mod.css" media="screen" />
EXTRA_HEADERS;
}


$body_id    = '';


$share_facebook = '<a href="http://www.facebook.com/share.php?u=http://www.mozilla.org/' . $lang . '/firefoxlive/?WT.mc_id=fxl_fbmsg&WT.mc_ev=click" class="button share_facebook">' . ___('Share on Facebook »') . '</a>';

$share_twitter  = '<a class="button share_twitter" href="https://twitter.com/intent/tweet';
$share_twitter .= '?url=http://mzl.la/sPo5yu&amp;text=';
$share_twitter .= str_replace(' ', '+', str_replace('http://mzl.la/sPo5yu', '', ___('What is more endearing? Firefox’s non-profit mission or a live feed of their animal mascot? Find out http://mzl.la/sPo5yu')));
$share_twitter .= '&amp;via=firefox">'. ___('Share on Twitter »'). '</a>';

$share_social_networks = $share_facebook . $share_twitter;

$overlay_twitter = '<div id="overlay-twitter"><a href="https://twitter.com/intent/user?screen_name=cubcaretaker">' . str_replace('@cubcaretaker', '@firefox', ___('Follow @cubcaretaker')) . '</a></div>';
$overlay_facebook = '<div id="overlay-facebook">'.$share_facebook.'</div>';

$overlay_social_networks = $overlay_twitter . $overlay_facebook;

$overlay_image = '<img src="'.$config['static_prefix'].'/img/covehead/firefoxlive/overlay-facebook.png" alt="" />';

$button_firefox = '<a href="' . $link[2] .'"><img src="'.$config['static_prefix'].'/img/covehead/firefoxlive/logo-firefox.png" alt="" />' . ___('Learn More') . ' »</a>';
$button_zoo     = '<img src="'.$config['static_prefix'].'/img/covehead/firefoxlive/logo-zoo.png" alt="" />';

$learn_link = '<a id="learn-link" href="' . $link[1] .'">' . ___('Learn More') . ' »</a>';

$video_code =  <<<VIDEO_CODE
<div id="video">
<script src="http://player.ooyala.com/player.js?callback=receiveOoyalaEvent&playerId=fxliveplayer&width=444&height=334&wmode=opaque&hide=sharing,info,embed&embedCode=k1Y3l0MToHj6WmLwarsNsFnKZAP6lMTh"></script>
<script>
function receiveOoyalaEvent(playerId, eventName, eventArgs) {
}
</script>
<div id="video-controls">
    <h4>{$l10n->get('Cameras')}</h4>
    <ul>
        <li><a href="#" onclick="document.getElementById('fxliveplayer').setQueryStringParameters({embedCode:'k1Y3l0MToHj6WmLwarsNsFnKZAP6lMTh',autoplay:'1',hide:'sharing,info,embed'})">{$l10n->get('360° view')}</a></li>
        <li><a href="#" onclick="document.getElementById('fxliveplayer').setQueryStringParameters({embedCode:'Exc3l0MTqbmMg9v6572B62bfY60ye-io',autoplay:'1',hide:'sharing,info,embed'})">{$l10n->get('Camera 1')}</a></li>
        <li><a href="#" onclick="document.getElementById('fxliveplayer').setQueryStringParameters({embedCode:'czc3l0MTpIThFhErTzHGqzVoeb_y7trW',autoplay:'1',hide:'sharing,info,embed'})">{$l10n->get('Camera 2')}</a></li>
        <li><a href="#faq" id="overlay-open-faq">{$l10n->get('Video help')}</a></li>
    </ul>
</div>
</div>
VIDEO_CODE;

// Header

?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:og="http://ogp.me/ns#"
      xmlns:fb="http://www.facebook.com/2008/fbml"
      lang="<?=$lang?>"
      dir="<?=$textdir?>">
<head>
    <meta charset="utf-8">
    <title><?=$page_title?></title>

    <meta property="og:title" content="<?=$page_title?>"/>
    <meta property="og:type" content="non_profit"/>
    <meta property="og:url" content="<?=$host_l10n?>/firefoxlive/?WT.mc_id=fxl_fbmsg&WT.mc_ev=click"/><?php /* stage: http://mzl.la/sXvbnu - prod: http://mzl.la/s2x11b */ ?>
    <meta property="og:image" content="http://www.mozilla.org/img/covehead/firefoxlive/facebook.jpg"/>
    <meta property="og:site_name" content="<?=$page_title?>"/>
    <meta property="og:locale" content="<?=$fb_locale?>" />
    <meta property="og:description"
          content="<?=$l10n->get("Do you like baby animals? Mozilla Firefox is streaming video of their 3 adopted red panda babies. Spread the word and 'share' with your friends.")?>"/>
    <meta name="Description"
          content="<?=$l10n->get("Do you like baby animals? Mozilla Firefox is streaming video of their 3 adopted red panda babies. Spread the word and 'share' with your friends.")?>"/>

    <style>
    /* MetaWebPro font family licensed from fontshop.com. WOFF-FTW! */
    @font-face {
        font-family: 'MetaBlack';
        src: url('<?=$config['static_prefix']?>/img/fonts/MetaWebPro-Black.eot');
        src: local('☺'), url('<?=$config['static_prefix']?>/img/fonts/MetaWebPro-Black.woff') format('woff');
        font-weight: bold;
    }
    </style>

    <link href="<?=$config['static_prefix']?>/includes/min/min.css?g=css" rel="stylesheet">
    <script src="<?=$config['static_prefix']?>/includes/min/min.js?g=js"></script>
<!--[if lte IE 9]>
<script src="<?=$config['static_prefix']?>/js/html5.js"></script>
<![endif]-->
    <? if ($lang == 'en-US') { ?>
    <script src="<?=$config['static_prefix']?>/js/jquery/jquery.tweet.js"></script>
    <script type='text/javascript'>
        jQuery(function($){
            $("#tweet").tweet({
                count: 2,
                username: 'cubcaretaker',
                template: "{text} {time}"
            });
        });
    (function() {
      if (window.__twitterIntentHandler) return;
      var intentRegex = /twitter\.com(\:\d{2,4})?\/intent\/(\w+)/,
          windowOptions = 'scrollbars=yes,resizable=yes,toolbar=no,location=yes',
          width = 550,
          height = 420,
          winHeight = screen.height,
          winWidth = screen.width;

      function handleIntent(e) {
        e = e || window.event;
        var target = e.target || e.srcElement,
            m, left, top;

        while (target && target.nodeName.toLowerCase() !== 'a') {
          target = target.parentNode;
        }

        if (target && target.nodeName.toLowerCase() === 'a' && target.href) {
          m = target.href.match(intentRegex);
          if (m) {
            left = Math.round((winWidth / 2) - (width / 2));
            top = 0;

            if (winHeight > height) {
              top = Math.round((winHeight / 2) - (height / 2));
            }

            window.open(target.href, 'intent', windowOptions + ',width=' + width +
                                               ',height=' + height + ',left=' + left + ',top=' + top);
            e.returnValue = false;
            e.preventDefault && e.preventDefault();
          }
        }
      }

      if (document.addEventListener) {
        document.addEventListener('click', handleIntent, false);
      } else if (document.attachEvent) {
        document.attachEvent('onclick', handleIntent);
      }
      window.__twitterIntentHandler = true;
    }());
</script>
    <? } ?>
    <?=$extra_headers?>

</head>

<body id="<?=$body_id?>" class="<?=$body_class?> locale-<?=$lang?>  <?=$textdir?>">

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/<?=$fb_locale?>/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="wrapper">
<div id="doc">

    <header id="branding">
        <div id="nav-mozilla">
            <a href="http://www.mozilla.org/" class="mozilla" title="<?=str_replace('.com', '.org', $l10n->get('Visit Mozilla.com'));?>">Mozilla</a>
        </div>

        <h1 id="site-title"><img src="<?=$config['static_prefix']?>/img/covehead/firefoxlive/title-logo.png" height="94" alt="" /><img src="<?=$config['static_prefix']?>/img/covehead/firefoxlive/title-en-US.png" height="94" alt="<?=$l10n->get('Firefox Live')?>" /></h1>

    </header>

    <section id="content-main">
    <? require_once $config['file_root'].'/'.$lang.'/firefoxlive/content.inc.html'; ?>
    <? if ($lang == 'en-US') { ?>
    <section id="tweet-container">
        <h4>Follow us <a href="http://www.twitter.com/cubcaretaker/">@cubcaretaker</a></h4>
        <div id="tweet"></div>
        <a class="tweet-more" href="http://www.twitter.com/cubcaretaker/"><?=$l10n->get('View more tweets')?>
        <a class="tweet-follow" href="https://twitter.com/intent/user?screen_name=cubcaretaker">Follow @cubcaretaker</a>
    </section>
    <? } ?>
    </section><!-- end #content-main -->


    </div><!-- end #doc -->
    </div><!-- end #wrapper -->

    <footer id="footer">
    <div class="section">

        <div id="copyright">
            <p id="footer-links"><a href="/<?=$lang?>/privacy-policy.html"><?=$l10n->get('Privacy Policy')?></a> &nbsp;|&nbsp;
            <a href="/<?=$lang?>/about/legal.html"><?=$l10n->get('Legal Notices')?></a> &nbsp;|&nbsp;
                        <a href="/<?=$lang?>/legal/fraud-report/index.html"><?=$l10n->get('Report Trademark Abuse')?></a></p>
            <p><?=$creative_commons?></p>
        </div>

        <form id="lang_form" class="languages"  dir="<?=$textdir?>" method="get" action="<?=$host_root?>includes/l10n/langswitcher.inc.php"><div>
            <label for="flang"><?=$l10n->get('Other languages:')?></label>
            <?=$lang_list?>
            <noscript>
                <div><input type="submit" id="lang_submit" value="<?=$l10n->get('Go')?>" /></div>
            </noscript>
        </div></form>

    </div>
    </footer>
    <!-- end #footer -->
    <?=$extra_footers?>

    <script>
    // <![CDATA[

    var isIE6 = ($.browser.msie && parseInt($.browser.version, 10) <= 6);
    var isFirefox = (/\sFirefox/.test(window.navigator.userAgent));

    var close_text = '<?=$l10n->get('Close')?>';

    var setCookie = function(name, value, path, expire)
    {
        if (expire) {
            var expdate = new Date();
            expdate.setDate(expdate.getDate() + expire);
            expire = ';expires=' + expdate.toUTCString();
        } else {
            expire = '';
        }

        if (path) {
            path = ';path=' + path;
        } else {
            path = '';
        }

        document.cookie = name + '=' + escape(value) + expire + path;
    };

    var getCookie = function(name)
    {
        if (document.cookie.length === 0) {
            return null;
        }

        var start = document.cookie.indexOf(name + '=');

        if (start === -1) {
            return null;
        }

        start += name.length + 1;
        end    = document.cookie.indexOf(';', start);
        if (end === -1) {
            end = document.cookie.length;
        }

        return unescape(document.cookie.substring(start, end));
    };

    var Overlay = function(selector)
    {
        var that = this;
        this.selector = selector;
        this.opened = false;
        $(document).ready(function() {
            that.init();
        });
        Overlay.overlays.push(this);
    };

    Overlay.overlays = [];
    Overlay.openCount = 0;

    Overlay.prototype.init = function()
    {
        var that = this;

        this.$overlay = $('<a class="overlay" href="#close" />')
            .hide()
            .appendTo('body')
            .click(function(e) { e.preventDefault(); that.close(); });

        this.$el = $('<div class="overlay-window"></div>')
            .appendTo('body');

        var $content = $(this.selector);
        $content
            .appendTo(this.$el)
            .css('display', 'block');

        this.$el.append(
            $('<div class="overlay-close" />').append(
                $('<a href="#close" />').click(function(e) {
                    e.preventDefault();
                    that.close();
                }).append(
                    $('<img src="/img/covehead/video/clothes-lol.png" height="25" width="25" alt="' + close_text + '" />')
                )
            )
        );
            //console.log('inited' + this.selector);
    };

    Overlay.prototype.open = function()
    {
        // hide the language form because its select element won't render
        // correctly in IE6
        $('#lang_form').hide();

        if (isIE6) {
            this.$el.css('position', 'absolute');
            this.$overlay.css('position', 'absolute');
        }

        var that = this;
        this.resizeHandler = function(e) {
            that.resize();
        };

        $(window).resize(this.resizeHandler);

        if (isIE6) {
            $(window).scroll(this.resizeHandler);
        }

        this.$el
            .css('visibility', 'hidden')
            .show();

        this.height = this.$el.height();

        this.resize();

        this.$el
            .hide()
            .css('visibility', 'visible');

        this.$overlay.fadeTo(400, 0.75);
        this.$el.fadeIn();

        this.opened = true;
        Overlay.openCount++;
        Slideshow.pause();
    };

    Overlay.prototype.resize = function()
    {
        var width  = this.$el.width();
        var height = this.$el.height();

        if (isIE6) {
            var scrollTop = $(window).scrollTop();
            var docHeight = $(document).height();
            var winHeight = $(window).height();
            var bottom = scrollTop + (winHeight + height) / 2;
            if (bottom > docHeight) {
                // this prevents infinite scroll
                this.$el.css('top', docHeight - height - 10);
            } else {
                this.$el.css('top', scrollTop + (winHeight - height) / 2);
            }
            this.$el.css('margin-left', -(width / 2));
            this.$overlay.height(docHeight);
        } else {

            this.$el
                .css('top', ($(window).height() - height) / 2)
                .css('margin-left', -(width / 2));

            this.$overlay.height($(window).height());
        }
    };

    Overlay.prototype.close = function()
    {
        this.$overlay.fadeOut();
        this.$el.fadeOut();

        // if language form was hidden, show it again
        $('#lang_form').show();

        $(window).unbind('resize', this.resizeHandler);

        this.opened = false;
        Overlay.openCount--;
        if (Overlay.openCount == 0) {
            Slideshow.resume();
        }
    };

    Overlay.prototype.toggle = function()
    {
        if (this.opened) {
            this.close();
        } else {
            this.open();
        }
    };

    var Slideshow = function(selector)
    {
        var that = this;
        this.selector = selector;
        this.index = 0;
        this.opened = false;
        $(document).ready(function() {
            that.init();
        });
        Slideshow.slideshows.push(this);
    };

    Slideshow.slideshows = [];

    Slideshow.pause = function()
    {
        for (var i = 0; i < Slideshow.slideshows.length; i++) {
            Slideshow.slideshows[i].stopInterval();
        }
    };

    Slideshow.resume = function()
    {
        for (var i = 0; i < Slideshow.slideshows.length; i++) {
            Slideshow.slideshows[i].startInterval();
        }
    };

    Slideshow.prototype.init = function()
    {
        this.$el = $(this.selector);
        this.height = this.$el.height();
        this.$pages = this.$el.children();
        this.$pages.hide();
        this.$currentPage = $(this.$pages.get(this.index));
        this.$currentPage.show();
        this.startInterval();
    };

    Slideshow.prototype.nextPage = function()
    {
        var that = this;
        this.$currentPage.animate(
            { left: 70, opacity: 0 },
            200,
            'linear',
            function() {
                that.$currentPage.css('display', 'none');
                that.index++;
                if (that.index < that.$pages.length) {
                    that.$currentPage = $(that.$pages.get(that.index));
                    that.$currentPage
                        .css('opacity', 0)
                        .css('display', 'block')
                        .css('left', 30);

                    var height = that.$currentPage.height();
                    that.$currentPage.css('top', (that.height - height) / 2);

                    that.$currentPage.animate(
                        { left: 50, opacity: 1 },
                        200,
                        'linear',
                        function() {
                            if ($.browser.msie) {
                                this.style.removeAttribute('filter');
                            }
                        }
                    );
                } else {
                    that.close();
                }
            }
        );
    };

    Slideshow.prototype.open = function()
    {
        this.$el.show();
        var height = this.$currentPage.height();
        this.$currentPage.css('top', (this.height - height) / 2);
        this.opened = true;
    };

    Slideshow.prototype.close = function()
    {
        if (this.opened) {
            var that = this;
            this.stopInterval();
            this.$el.fadeOut(100, function() {
                that.$el.trigger('close');
            });
            this.opened = false;
        }
    };

    Slideshow.prototype.startInterval = function()
    {
        if (this.index < this.$pages.length) {
            var that = this;
            this.interval = setInterval(
                function() {
                    that.nextPage();
                }, 4000
            );
        }
    };

    Slideshow.prototype.stopInterval = function()
    {
        if (this.interval !== null) {
            clearInterval(this.interval);
            this.intereval = null;
        }
    };

    var returning = new Overlay('#overlay-returning');
    var nonfx     = new Overlay('#overlay-nonfx');
    var faq       = new Overlay('#overlay-faq');

    var slideshow = new Slideshow('#intro');

    /**
     * This file contains Flash-detection routines adapted from SWFObject and
     * originally licensed under the MIT license.
     *
     * See http://blog.deconcept.com/flashobject/
     */

    var FlashVersion = function(version)
    {
        this.major = version[0] != null ? parseInt(version[0], 10) : 0;
        this.minor = version[1] != null ? parseInt(version[1], 10) : 0;
        this.rev   = version[2] != null ? parseInt(version[2], 10) : 0;
    };

    FlashVersion.prototype.isValid = function(version)
    {
        if (version instanceof Array) {
            version = new Mozilla.FlashVersion(version);
        }

        if (this.major < version.major) {
            return false;
        }
        if (this.major > version.major) {
            return true;
        }
        if (this.minor < version.minor) {
            return false;
        }
        if (this.minor > version.minor) {
            return true;
        }
        if (this.rev < version.rev) {
            return false;
        }
        return true;
    };

    var flash = (function()
    {
        var version = new FlashVersion([0, 0, 0]);
        if (navigator.plugins && navigator.mimeTypes.length) {
            var x = navigator.plugins['Shockwave Flash'];
            if (x && x.description) {
                // strip text to get version number only
                version = x.description.replace(/([a-zA-Z]|\s)+/, '');

                // convert revisions and beta to dots
                version = version.replace(/(\s+r|\s+b[0-9]+)/, '.');

                // get version
                version = new FlashVersion(version.split('.'));
            }
        } else {
            if (navigator.userAgent && navigator.userAgent.indexOf('Windows CE') >= 0) {
                var axo = true;
                var majorVersion = 3;
                while (axo) {
                    // look for greatest installed version starting at 4
                    try {
                        majorVersion++;
                        axo = new ActiveXObject('ShockwaveFlash.ShockwaveFlash.' + majorVersion);
                        version = new FlashVersion([majorVersion, 0, 0]);
                    } catch (e) {
                        axo = null;
                    }
                }
            } else {
                try {
                    var axo = new ActiveXObject('ShockwaveFlash.ShockwaveFlash.7');
                } catch (e) {
                    try {
                        var axo = new ActiveXObject('ShockwaveFlash.ShockwaveFlash.6');
                        version = new FlashVersion([6, 0, 21]);
                        axo.AllowScriptAccess = 'always';
                    } catch (e) {
                        if (version.major == 6) {
                            return version;
                        }
                    }
                    try {
                        axo = new ActiveXObject('ShockwaveFlash.ShockwaveFlash');
                    } catch (e) {}
                }
                if (axo != null) {
                    version = new FlashVersion(axo.GetVariable('$version').split(' ')[1].split(','));
                }
            }
        }
        return version;
    })();

    $(document).ready(function() {
        $('#overlay-open-faq').click(function(e) {
            e.preventDefault();
            faq.open();
        });

        $('#cute').click(function(e) {
            e.preventDefault();
            nonfx.close();
        });

        var $video = $('#video');

        var historyCookieName = 'FirefoxLiveHistory';
        var history = getCookie(historyCookieName);
        history = parseInt(history, 10);
        if (isNaN(history)) {
            history = 0;
        }
        setCookie(historyCookieName, history + 1, '/', 31 * 24 * 60 * 60);

        if (flash.major == 0 && (typeof HTMLMediaElement != 'undefined')) {
            var sources = [
                {
                    src:  'http://videos.mozilla.org/serv/firefoxlive/Webcam%20Highlight%20Reel%20Final.webm',
                    type: 'video/webm'
                },
                {
                    src:  'http://videos.mozilla.org/serv/firefoxlive/Webcam%20Highlight%20Reel%20Final.mp4',
                    type: 'video/mp4'
                },
                {
                    src:  'http://videos.mozilla.org/serv/firefoxlive/Webcam%20Highlight%20Reel%20Final.ogv',
                    type: 'video/ogg'
                },
            ];

            var poster = '/img/covehead/firefoxlive/fallback-poster.jpg';

            var content = '<video controls width="444" height="334" poster="' + poster + '">';

            for (var i = 0; i < sources.length; i++) {
                content += '<source src="' + sources[i].src + '" type="' + sources[i].type + '"></source>';
            }

            content += '</video>';

            var $fallback = $(content);
            $video
                .empty()
                .append($fallback);
        }

        if (history > 0 && history < 3) {
            returning.open();
        } else if (history < 3) {
            $video.hide();
            slideshow.open();
            slideshow.$el.bind('close', function() {
                $video.show();
            });
            if (!isFirefox) {
                var $detected    = $('#detected');
                var $notdetected = $('#notdetected');

                var isSafari = /Safari/.test(window.navigator.userAgent);
                var isChrome = /Chrome/.test(window.navigator.userAgent);
                var isIE     = /MSIE/.test(window.navigator.userAgent);

                if (isChrome) {
                    $detected.text(
                        $detected.text().replace(/%BROWSER%/, 'Google Chrome')
                    );
                    $notdetected.hide();
                } else if (isSafari) {
                    $detected.text(
                        $detected.text().replace(/%BROWSER%/, 'Safari')
                    );
                    $notdetected.hide();
                } else if (isIE) {
                    $detected.text(
                        $detected.text().replace(/%BROWSER%/, 'Internet Explorer')
                    );
                    $notdetected.hide();
                } else {
                    $detected.hide();
                }

                nonfx.open();
            }
        }
    });


    // ]]>
    </script>

<?
// Webtrends stats, see bug 556384
require "{$config['file_root']}/includes/js_stats.inc.php";
echo $stats_js;
?>

</body>
</html>
