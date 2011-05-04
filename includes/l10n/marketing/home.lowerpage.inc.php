
<div style="margin-top: 0;" id="main-content">

    <div id="sub-customize" class="sub-feature first">
        <h3><?php e__('Personalize'); ?></h3>
        <p><?php e__('One size doesn’t fit all.'); ?></p>
        <a href="/<?=$lang;?>/firefox/features/#powerfulpersonalization">
          <?php e__('Learn More'); ?>&nbsp;<span>»</span>
        </a>
    </div>

    <div id="sub-performance" class="sub-feature">
        <h3><?php e__('Go Fast'); ?></h3>
        <p><?php e__('Accelerate the way you use the web.'); ?></p>
        <a href="/<?=$lang;?>/firefox/features/#highperformance">
          <?php e__('Learn More'); ?>&nbsp;<span>»</span>
        </a>
    </div>

    <div id="sub-security" class="sub-feature">
        <h3><?php e__('Stay Safe'); ?></h3>
        <p><?php e__('We’ve got your back.'); ?></p>
        <a href="/<?=$lang;?>/firefox/features/#advancedsecurity">
          <?php e__('Learn More'); ?>&nbsp;<span>»</span>
        </a>
    </div>

</div>

<!-- Please do not ever remove this comment. -->

<script>
// Includes jquery and then nav-main.js after onload
(function () {
    var head = document.head || document.getElementsByTagName("head")[0];

    function init_video()
    {
        Mozilla.VideoPlayer.width = 640;
        Mozilla.VideoPlayer.height = 360;
        var player = new Mozilla.VideoPlayer(
            'video-link',
            [
                {
                    url:   'http://videos-cdn.mozilla.net/serv/marketing/firefox4/FF4_Jess3Features_VO_1.webm',
                    type:  'video/webm; codecs=&quot;vp8, vorbis&quot;',
                    title: 'WebM format'
                },
                {
                    url:   'http://videos-cdn.mozilla.net/serv/marketing/firefox4/FF4_Jess3Features_VO_1.theora.ogv',
                    type:  'video/ogg; codecs=&quot;theora, vorbis&quot;',
                    title: 'Ogg&nbsp;Theora format'
                },
                {
                    url:   'http://videos-cdn.mozilla.net/serv/marketing/firefox4/FF4_Jess3Features_VO_1.mp4',
                    type:  'video/mp4',
                    title: 'MPEG-4 format'
                }
            ],
            'serv/marketing/firefox4/FF4_Jess3Features_VO_1.mp4',
            true
        );
    }

    function load_video()
    {
        var scriptElem = document.createElement("script");
        var scriptDone = false;
        scriptElem.onload = scriptElem.onreadystatechange = function () {
            if ((scriptElem.readyState && scriptElem.readyState !== "complete" && scriptElem.readyState !== "loaded") || scriptDone) {
                return false;
            }
            scriptElem.onload = scriptElem.onreadystatechange = null;
            scriptDone = true;
            init_video();
        };
        scriptElem.src = "<?php echo $config['static_prefix'];?>/js/mozilla-video-tools.js";
        head.insertBefore(scriptElem, head.firstChild);
    }

    function load_nav_main()
    {
        var scriptElem = document.createElement("script");
        scriptElem.src = "<?php echo $config['static_prefix'];?>/js/nav-main.js";
        head.insertBefore(scriptElem, head.firstChild);
    }

    function init_crossfade()
    {
        $(document).ready(function() {
            var $images = $('#main-feature img.screenshot');
            var currentImage = $images.length - 1;
            var interval = setInterval(function() {
                var nextImage = currentImage + 1;
                if (nextImage == $images.length) {
                    nextImage = 0;
                }

                $from = $($images.get(currentImage));
                $to   = $($images.get(nextImage));

                $from.animate( { opacity: 0 }, 1000);
                $to.animate( { opacity: 1 }, 1000);

                currentImage = nextImage;

            }, 8000);
        });
    }

    function load_jquery ()
    {
        var scriptElem = document.createElement("script");
        var scriptDone = false;
        scriptElem.onload = scriptElem.onreadystatechange = function () {
            if ((scriptElem.readyState && scriptElem.readyState !== "complete" && scriptElem.readyState !== "loaded") || scriptDone) {
                return false;
            }
            scriptElem.onload = scriptElem.onreadystatechange = null;
            scriptDone = true;
            load_nav_main();
            <?php if (isset($target) && $target == 'socialmedia'): ?>
            init_crossfade();
            <?php endif; ?>
            load_video();
        };
        scriptElem.src = "<?php echo $config['static_prefix'];?>/js/jquery/jquery.min.js";
        head.insertBefore(scriptElem, head.firstChild);
    };

    var old_onload = window.onload;
    if (old_onload) {
        window.onload = function() { old_onload(); load_jquery(); };
    } else {
        window.onload = load_jquery;
    }

})();
</script>


