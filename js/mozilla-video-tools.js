/**
 * Various tools for the HTML5 video element
 *
 * Meant to be used with CSS in /styles/tignish/video.css.
 *
 * This file contains Flash-detection routines adapted from SWFObject and
 * originally licensed under the MIT license.
 *
 * See http://blog.deconcept.com/flashobject/
 *
 * This file can make use of the SMILE-based subtitling routines provided
 * courtesy of Fabien Cazenave for INRIA under the BSD license. Those are
 * stored in mozilla-video-tools-addsubtitles.js
 *
 *
 * @copyright 2009 Mozilla Corporation
 * @author    Michael Gauthier <mike@silverorange.com>
 */

// create namespace
if (typeof Mozilla == 'undefined') {
    var Mozilla = {};
}

// {{{ Mozilla.VideoControl

/**
 * Initializes video controls on this page after the document has been loaded
 */
YAHOO.util.Event.onDOMReady(function()
{
    // Do nothing for browsers that don't support HTML5 video
    if (typeof HTMLMediaElement == 'undefined') {
        return;
    }

    var videos = YAHOO.util.Dom.getElementsByClassName('mozilla-video-control');

    for (var i = 0; i < videos.length; i++) {
        Mozilla.VideoControl.controls.push(
            new Mozilla.VideoControl(videos[i])
        );
    }
});

/**
 * Provides a click-to-play button for HTML5 video element content
 *
 * If the HTML5 video element is supported, the following markup will
 * automatically get the click-to-play button when the page initializes:
 * <code>
 * &lt;div class="mozilla-video-control"&gt;
 *     &lt;video ... /&gt;
 * &lt;/div&gt;
 * </code>
 *
 * @param DOMElement|String container
 */
Mozilla.VideoControl = function(container)
{
    if (typeof container == 'String') {
        container = YAHOO.util.Dom.get(container);
    }

    this.container = container;

    this.video = YAHOO.util.Dom.getFirstChildBy(
        container,
        function (e) { return (e.nodeName === 'VIDEO'); }
    );

    this.semaphore = false;
    this.animation = null;
    this.animation_target = 0;

    /*
     * Check if HTMLMediaElement exists to filter out browsers that do not
     * support the video element.
     */
    if (   typeof HTMLMediaElement != 'undefined'
        && this.video instanceof HTMLMediaElement
    ) {
        this.drawControl();
        this.video._control = this;
    }
}

Mozilla.VideoControl.controls = [];

Mozilla.VideoControl.prototype.drawControl = function()
{
    this.control = document.createElement('a');
    this.control.href = '#';
    this.control.className = 'mozilla-video-control-overlay';
    YAHOO.util.Dom.setStyle(this.control, 'opacity', 0);

    var that = this;

    // Show the click-to-play button. In the future, this may be changed
    // to show the click-to-play button based on media events like the
    // hiding is done.
    if (this.video.paused || this.video.ended) {
        this.show();
    }

    // hide click-to-play button on these events
    var hide_events = [
        'play',
        'playing',
        'seeking',
        'waiting'
    ];

    for (var i = 0; i < hide_events.length; i++) {
        (function() {
            var event_name = hide_events[i];
            YAHOO.util.Event.on(
                that.video,
                event_name,
                function (e) {
                    this.hide();
                },
                that,
                true
            );
        })();
    }

    YAHOO.util.Event.on(
        this.control,
        'mouseover',
        this.handleControlMouseOver,
        this,
        true
    );

    YAHOO.util.Event.on(
        this.control,
        'mouseout',
        this.handleControlMouseOut,
        this,
        true
    );

    YAHOO.util.Event.on(
        this.control,
        'click',
        this.handleControlClick,
        this,
        true
    );

    this.container.appendChild(this.control);
    this.onClick = new YAHOO.util.CustomEvent('click');
}

Mozilla.VideoControl.prototype.handleControlMouseOver = function(e)
{
    if (this.semaphore) {
        return;
    }
    this.prelight();
}

Mozilla.VideoControl.prototype.handleControlMouseOut = function(e)
{
    if (this.semaphore) {
        return;
    }
    this.unprelight();
}

Mozilla.VideoControl.prototype.handleControlClick = function(e)
{
    YAHOO.util.Event.preventDefault(e);

    if (this.semaphore || !this.videoCanPlay()) {
        return;
    }

    this.semaphore = true;
    // rewind the video
    if (this.video.ended) {
        this.video.currentTime = 0;
    }
    this.video.play();
    this.onClick.fire();
}

Mozilla.VideoControl.prototype.videoCanPlay = function()
{
    // check if we're using an older draft version of the readyState spec
    var current_data = (typeof HTMLMediaElement.CAN_PLAY == 'undefined') ?
        HTMLMediaElement.HAVE_CURRENT_DATA : HTMLMediaElement.CAN_PLAY;

    return (this.video.readyState >= current_data);
}

Mozilla.VideoControl.prototype._fadeIn = function(target, time, complete)
{
    var animate = true;

    // only get more opaque, this prevents fading out when we want to fade in
    if (YAHOO.util.Dom.getStyle(this.control, 'opacity') < target) {

        if (this.animation && this.animation.isAnimated()) {
            if (this.animation_target >= target) {
                // if we're already animating and the target is acceptable,
                // do nothing and let current animation finish
                animate = false;
            } else {
                // otherwise, stop current animation, and start a new one
                this.animation.stop(false);
            }
        }

        if (animate) {
            this.animation_target = target;

            this.animation = new YAHOO.util.Anim(
                this.control,
                { opacity: { to: target } },
                time
            );

            if (complete) {
                this.animation.onComplete.subscribe(complete, this, true);
            }

            this.animation.animate();
        }
    }
}

Mozilla.VideoControl.prototype._fadeOut = function(target, time, complete)
{
    var animate = true;

    // only get more opaque, this prevents fading in when we want to fade out
    if (YAHOO.util.Dom.getStyle(this.control, 'opacity') > target) {

        if (this.animation && this.animation.isAnimated()) {
            if (this.animation_target <= target) {
                // if we're already animating and the target is acceptable,
                // do nothing and let current animation finish
                animate = false;
            } else {
                // otherwise, stop current animation, and start a new one
                this.animation.stop(false);
            }
        }

        if (animate) {
            this.animation_target = target;

            this.animation = new YAHOO.util.Anim(
                this.control,
                { opacity: { to: target } },
                time
            );

            if (complete) {
                this.animation.onComplete.subscribe(complete, this, true);
            }

            this.animation.animate();
        }
    }
}

Mozilla.VideoControl.prototype.show = function()
{
    this.video.controls = false;
    this.control.style.display = 'block';
    this._fadeIn(0.7, 1.00);
}

Mozilla.VideoControl.prototype.hide = function()
{
    this._fadeOut(
        0,
        0.25,
        function()
        {
            this.semaphore = false;
            if (YAHOO.util.Dom.getStyle(this.control, 'opacity') == 0) {
                this.control.style.display = 'none';
                this.video.controls = true;
            }
        }
    );
}

Mozilla.VideoControl.prototype.prelight = function()
{
    this._fadeIn(1.0, 0.25);
}

Mozilla.VideoControl.prototype.unprelight = function()
{
    this._fadeOut(0.7, 0.25);
}

// }}}
// {{{ Mozilla.VideoScaler

/**
 * Initializes video scalers on this page after the document has been loaded
 */
YAHOO.util.Event.onDOMReady(function()
{
    var videos = YAHOO.util.Dom.getElementsByClassName('mozilla-video-scaler');

    for (var i = 0; i < videos.length; i++) {
        Mozilla.VideoScaler.scalers.push(
            new Mozilla.VideoScaler(videos[i])
        );
    }
});

/**
 * Scales a video to full size then the video's click-to-play button
 * is clicked
 *
 * If the HTML5 video element is supported, the following markup will
 * automatically get this behaviour when the page initializes:
 * <code>
 * &lt;div class="mozilla-video-scaler"&gt;
 *     &lt;div class="mozilla-video-control"&gt;
 *         &lt;video ... /&gt;
 *     &lt;/div&gt;
 * &lt;/div&gt;
 * </code>
 *
 * @param DOMElement|String container
 */
Mozilla.VideoScaler = function(container)
{
    if (typeof container == 'String') {
        container = YAHOO.util.Dom.get(container);
    }

    this.container = container;

    this.video = YAHOO.util.Dom.getFirstChildBy(
        YAHOO.util.Dom.getFirstChild(container),
        function (e) { return (e.nodeName === 'VIDEO'); }
    );

    this.animation      = null;
    this.link_animation = null;
    this.opened         = false;
    this.original_xy    = [];
    this.original_wh    = [];

    /*
     * Check if HTMLMediaElement exists to filter out browsers that do not
     * support the video element.
     */
    if (   typeof HTMLMediaElement != 'undefined'
        && this.video instanceof HTMLMediaElement
    ) {
        this.init();
        this.video._scaler = this;
    }
}

Mozilla.VideoScaler.scalers = [];
Mozilla.VideoScaler.close_text = 'Close';

Mozilla.VideoScaler.Anim = function(el, attributes, duration, method)
{
    Mozilla.VideoScaler.Anim.superclass.constructor.call(
        this,
        el,
        attributes,
        duration,
        method
    );
}

YAHOO.lang.extend(Mozilla.VideoScaler.Anim, YAHOO.util.Anim, {
    setAttribute: function(attr, val, unit) {
        if (attr == 'width' || attr == 'height') {
            val = (val > 0) ? val : 0;
            var el = YAHOO.util.Dom.getFirstChild(this.getEl());
            el.style[attr] = val + unit;
        } else {
            Mozilla.VideoScaler.Anim.superclass.setAttribute.call(
                this,
                attr,
                val,
                unit
            );
        }
    },
    getAttribute: function(attr) {
        if (attr == 'width' || attr == 'height') {
            var el = YAHOO.util.Dom.getFirstChild(this.getEl());
            var val = YAHOO.util.Dom.getStyle(el, attr);

            if (val !== 'auto' && !this.patterns.offsetUnit.test(val)) {
                return parseFloat(val);
            }

            var a = this.patterns.offsetAttribute.exec(attr) || [];
            var box = !!( a[2] ); // width or height

            // use offsets for width/height
            if (box) {
                val = el[
                      'offset'
                    + a[0].charAt(0).toUpperCase()
                    + a[0].substr(1)
                ];
            } else { // default to zero for other 'auto'
                val = 0;
            }
        } else {
            var val = Mozilla.VideoScaler.Anim.superclass.getAttribute.call(
                this,
                attr
            );
        }

        return val;
    }
});

Mozilla.VideoScaler.prototype.init = function()
{
    // reposition container absolutely so it shows in its original location
    var region = YAHOO.util.Dom.getRegion(this.container);
    var width  = region.right  - region.left;
    var height = region.bottom - region.top;

    // insert a shim of the original dimensions to keep text wrapping the same
    var shim = document.createElement('div');
    shim.className = 'mozilla-video-scaler-shim';
    shim.style.width = width + 'px';
    shim.style.height = height + 'px';
    this.container.parentNode.insertBefore(shim, this.container);

    // resposition player
    this.container.style.position = 'absolute';
    YAHOO.util.Dom.setXY(this.container, [region.left, region.top]);

    // remember original position so we can return here when closing
    this.original_xy = [
        parseFloat(YAHOO.util.Dom.getStyle(this.container, 'left')),
        parseFloat(YAHOO.util.Dom.getStyle(this.container, 'top'))
    ];

    // remember original dimensions so we can return here when closing
    var video_region = YAHOO.util.Dom.getRegion(this.video);
    this.original_wh = [
        video_region.right  - video_region.left,
        video_region.bottom - video_region.top
    ];

    // draw close link
    this.close_link = document.createElement('a');
    this.close_link.href = '#';
    this.close_link.className = 'mozilla-video-scaler-close-link';
    this.close_link.appendChild(
        document.createTextNode(
            Mozilla.VideoScaler.close_text
        )
    );

    // temp
    this.container.parentNode.insertBefore(this.close_link, this.container);

    // scale up when click-to-play control is clicked
    if (this.video._control instanceof Mozilla.VideoControl) {
        this.video._control.onClick.subscribe(this.open, this, true);
    }

    // scale down when close link is clicked
    YAHOO.util.Event.on(
        this.close_link,
        'click',
        function (e) {
            YAHOO.util.Event.preventDefault(e);
            this.close();
        },
        this,
        true
    );
}

Mozilla.VideoScaler.prototype.open = function()
{
    if (this.opened) {
        return;
    }

    this.video.controls = true;
    this.opened         = true;

    var outer_region = YAHOO.util.Dom.getRegion(this.container);
    var inner_region = YAHOO.util.Dom.getRegion(this.video);

    // get extra width from borders, margins and padding
    var border_w = (outer_region.right - outer_region.left) -
                   (inner_region.right - inner_region.left);

    // get extra height from borders, margins and padding
    var border_h = (outer_region.bottom - outer_region.top) -
                   (inner_region.bottom - inner_region.top);

    // scale to intrinsic video dimensions
    var w = this.video.videoWidth;
    var h = this.video.videoHeight;

    // all coordinates are relative to the doc element
    var parent_region = YAHOO.util.Dom.getRegion('doc');
    var parent_w      = parent_region.right - parent_region.left;

    // and center vertically in the current viewport
    var view_h        = YAHOO.util.Dom.getViewportHeight();

    // get absolute coordinates to centering scaled video
    var x = Math.round((parent_w - w - border_w) / 2);
    var y = YAHOO.util.Dom.getDocumentScrollTop() +
            Math.round((view_h - h - border_h) / 2);

    if (this.animation && this.animation.isAnimated()) {
        // suppress events here because we don't want the video to pause
        this.animation.stop(false);
    }

    this.animation = new Mozilla.VideoScaler.Anim(
        this.container,
        {
            width:  { to: w },
            height: { to: h },
            left:   { to: x },
            top:    { to: y }
        },
        1.5,
        YAHOO.util.Easing.easeOutStrong
    );

    this.animation.onComplete.subscribe(this.showCloseLink, this, true);
    this.animation.animate();
}

Mozilla.VideoScaler.prototype.close = function()
{
    if (!this.opened) {
        return;
    }

    this.opened         = false;
    this.video.controls = false;

    this.hideCloseLink();

    if (this.animation && this.animation.isAnimated()) {
        this.animation.stop(false);
    }

    this.animation = new Mozilla.VideoScaler.Anim(
        this.container,
        {
            'width':  { to: this.original_wh[0] },
            'height': { to: this.original_wh[1] },
            'left':   { to: this.original_xy[0] },
            'top':    { to: this.original_xy[1] }
        },
        0.75,
        YAHOO.util.Easing.easeOut
    );

    this.animation.onComplete.subscribe(function() {
        // check if video is ended to work around Mozilla Bug #495145
        if (!this.video.ended) {
            this.video.pause();
        }

        // If there is a click-to-play button, show it. This is a
        // workaround until events can be used instead.
        if (this.video._control instanceof Mozilla.VideoControl) {
            this.video._control.show();
        }
    }, this, true);

    this.animation.animate();
}

Mozilla.VideoScaler.prototype.showCloseLink = function()
{
    // update CSS class to un-notch corner
    YAHOO.util.Dom.addClass(this.container, 'mozilla-video-scaler-opened');

    // close link will be positioned relatively to the video control container
    var control_region = YAHOO.util.Dom.getRegion(
        YAHOO.util.Dom.getFirstChild(this.container)
    );

    // get all coordinates relative to parent element
    var parent_region = YAHOO.util.Dom.getRegion('doc');

    // show close link
    YAHOO.util.Dom.setStyle(this.close_link, 'opacity', '0');
    this.close_link.style.display = 'block';

    // get width and height of close link
    var region = YAHOO.util.Dom.getRegion(this.close_link);
    var w = region.right  - region.left;
    var h = region.bottom - region.top;

    // get position of close link
    var x = Math.round(parent_region.right - control_region.right);
    var y = Math.round(control_region.top  - h);

    // position close link
    YAHOO.util.Dom.setStyle(this.close_link, 'right', x + 'px');
    YAHOO.util.Dom.setStyle(this.close_link, 'top',  y + 'px');

    if (this.link_animation && this.link_animation.isAnimated()) {
        this.link_animation.stop(false);
    }

    this.link_animation = new YAHOO.util.Anim(
        this.close_link,
        { opacity: { from: 0, to: 1 } },
        0.25,
        YAHOO.util.Easing.easeIn
    );

    this.link_animation.animate();
}

Mozilla.VideoScaler.prototype.hideCloseLink = function()
{
    // re-notch corners
    YAHOO.util.Dom.removeClass(this.container, 'mozilla-video-scaler-opened');

    // hide close link
    this.close_link.style.display = 'none';
}

// }}}
// {{{ Mozilla.VideoPlayer

/**
 * Popup player using HTML5 video element with flash fallback
 *
 * @param String  id
 * @param Array   sources
 * @param String  flv_url
 * @param Booelan autoplay
 */
Mozilla.VideoPlayer = function(id, sources, flv_url, autoplay)
{
    this.id       = id;
    this.flv_url  = flv_url;
    this.sources  = sources;
    this.opened   = false;

    if (arguments.length > 3) {
        this.autoplay = autoplay;
    } else {
        this.autoplay = true;
    }

    YAHOO.util.Event.onDOMReady(this.init, this, true);
}

Mozilla.VideoPlayer.height = '385';
Mozilla.VideoPlayer.width  = '640';

Mozilla.VideoPlayer.close_text = 'Close';

Mozilla.VideoPlayer.fallback_text =
      'This video requires a browser with support for open video:'
    + '<ul>'
    + '<li><a href="http://www.mozilla.com/firefox/">Firefox</a> 3.5 or greater</li>'
    + '<li><a href="http://www.apple.com/safari/">Safari</a> 3.1 or greater</li>'
    + '</ul>'
    + 'or the <a href="http://www.adobe.com/go/getflashplayer">Adobe Flash '
    + 'Player</a>. Alternatively, you may use the video download links '
    + 'provided.';

Mozilla.VideoPlayer.prototype.init = function()
{
    this.overlay = document.createElement('div');
    this.overlay.className = 'mozilla-video-player-overlay';
    this.overlay.style.display = 'none';

    this.video_container = document.createElement('div');
    this.video_container.className = 'mozilla-video-player-window';
    this.video_container.style.display = 'none';

    // add overlay and preview image to document
    var body = document.getElementsByTagName('body')[0];
    body.appendChild(this.overlay);
    body.appendChild(this.video_container);

    // set video link event handler
    var video_link = document.getElementById(this.id);
    YAHOO.util.Event.on(
        video_link,
        'click',
        function(e)
        {
            YAHOO.util.Event.preventDefault(e);

            // open the player
            this.open();
        },
        this,
        true
    );

    // set video preview link event handler
    var preview_link = document.getElementById(this.id + '-preview');
    if (preview_link) {
        YAHOO.util.Event.on(
            preview_link,
            'click',
            function (e)
            {
                YAHOO.util.Event.preventDefault(e);

                // open the player
                this.open();
            },
            this,
            true
        );
    }
}

Mozilla.VideoPlayer.prototype.clearVideoPlayer = function()
{
    // remove event handlers
    YAHOO.util.Event.purgeElement(this.video_container, true, 'click');

    // workaround for FF Bug #533840, manually pause all videos
    var videos = this.video_container.getElementsByTagName('video');
    for (var i = 0; i < videos.length; i++) {
        videos[i].pause();
    }

    // remove all elements
    while (this.video_container.childNodes.length > 0) {
        this.video_container.removeChild(this.video_container.firstChild);
    }
}

Mozilla.VideoPlayer.prototype.drawVideoPlayer = function()
{
    this.clearVideoPlayer();

    var close_div = document.createElement('div');
    close_div.className = 'mozilla-video-player-close';

    var close_link = document.createElement('a');
    close_link.href = '#';

    // set up cloe link event handler
    YAHOO.util.Event.on(
        close_link,
        'click',
        function (e)
        {
            YAHOO.util.Event.preventDefault(e);
            this.close();
        },
        this,
        true
    );

    close_link.appendChild(document.createTextNode(
        Mozilla.VideoPlayer.close_text));

    close_div.appendChild(close_link);
    this.video_container.appendChild(close_div);

    var video_div = document.createElement('div');
    video_div.className = 'mozilla-video-player-content';

    // get content for player
    if (typeof HTMLMediaElement != 'undefined') {
        var content = this.getVideoPlayerContent();
    } else if (Mozilla.VideoPlayer.flash_verison.isValid([7, 0, 0])) {
        var content = this.getFlashPlayerContent();
    } else {
        var content = this.getFallbackContent();
    }

    // add download links
    content += '<div class="video-download-links"><ul>';
    for (var i = 0; i < this.sources.length; i++) {
        content +=
              '<li><a href="' + this.sources[i].url + '">'
            + this.sources[i].title
            + '</a></li>';
    }
    content += '</ul></div>';

    this.video_container.appendChild(video_div);
    video_div.innerHTML = content;
}

Mozilla.VideoPlayer.prototype.getVideoPlayerContent = function()
{
    var content =
            '<video id="htmlPlayer" width="' + Mozilla.VideoPlayer.width + '" '
          + 'height="' + Mozilla.VideoPlayer.height + '" '
          + 'controls="controls"';

    if (this.autoplay) {
        content += ' autoplay="autoplay"';
    }

    content += '>';


    for (var i = 0; i < this.sources.length; i++) {
        if (!this.sources[i].type) continue; // must have MIME type
        content +=
              '<source src="' + this.sources[i].url + '" '
            + 'type="' + this.sources[i].type + '"/>';
    }

    content += '</video>';

    return content;
}

Mozilla.VideoPlayer.prototype.getFlashPlayerContent = function()
{
    var url = '/includes/flash/playerWithControls.swf?flv=' + this.flv_url;

    if (this.autoplay) {
        url += '&autoplay=true';
    } else {
        url += '&autoplay=false';
    }

    var content =
          '<object type="application/x-shockwave-flash" style="'
        + 'width: ' + Mozilla.VideoPlayer.width + 'px; '
        + 'height: ' + Mozilla.VideoPlayer.height + 'px;" '
        + 'wmode="transparent" data="' + url + '">'
        + '<param name="movie" value="' + url + '" />'
        + '<param name="wmode" value="transparent" />'
        + '</object>';

    return content;
}

Mozilla.VideoPlayer.prototype.getFallbackContent = function()
{

    var content =
          '<div class="mozilla-video-player-no-flash">'
        + Mozilla.VideoPlayer.fallback_text
        + '</div>';

    return content;
}

Mozilla.VideoPlayer.prototype.open = function()
{
    // hide the language form because its select element won't render
    // correctly in IE6
    var hide_form = document.getElementById('lang_form');
    if (hide_form) {
        hide_form.style.display = 'none';
    }

    this.overlay.style.height = YAHOO.util.Dom.getDocumentHeight() + 'px';
    this.overlay.style.display = 'block';

    this.video_container.style.display = 'block';

    this.drawVideoPlayer();

    this.video_container.style.top =
        (YAHOO.util.Dom.getDocumentScrollTop() +
        ((YAHOO.util.Dom.getViewportHeight() - 570) / 2)) + 'px';

    this.opened = true;

    // getSubtitles() depends on mozilla-video-tools-addsubtitles.js
    if(window.getSubtitles) {
        getSubtitles(this.video_container.style.top);
    }
}

Mozilla.VideoPlayer.prototype.close = function()
{
    // hideSubtitles() depends on mozilla-video-tools-addsubtitles.js
    if(window.hideSubtitles) {
        hideSubtitles();
    }

    this.overlay.style.display = 'none';
    this.video_container.style.display = 'none';

    // clear the video content so IE will stop playing the audio
    this.clearVideoPlayer();

    // if language form was hidden, show it again
    var hide_form = document.getElementById('lang_form');
    if (hide_form) {
        hide_form.style.display = 'block';
    }

    this.opened = false;
}

Mozilla.VideoPlayer.prototype.toggle = function()
{
    if (this.opened)
        this.close();
    else
        this.open();
}

Mozilla.VideoPlayer.getFlashVersion = function()
{
    var version = new Mozilla.FlashVersion([0, 0, 0]);
    if (navigator.plugins && navigator.mimeTypes.length) {
        var x = navigator.plugins['Shockwave Flash'];
        if (x && x.description) {
            // strip text to get version number only
            version = x.description.replace(/([a-zA-Z]|\s)+/, '');

            // convert revisions and beta to dots
            version = version.replace(/(\s+r|\s+b[0-9]+)/, '.');

            // get version
            version = new Mozilla.FlashVersion(version.split('.'));
        }
    } else {
        if (navigator.userAgent && navigator.userAgent.indexOf('Windows CE') >= 0) {
            var axo = true;
            var flash_version = 3;
            while (axo) {
                // look for greatest installed version starting at 4
                try {
                    major_version++;
                    axo = new ActiveXObject('ShockwaveFlash.ShockwaveFlash.' + major_version);
                    version = new Mozilla.FlashVersion([major_version, 0, 0]);
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
                    version = new Mozilla.FlashVersion([6, 0, 21]);
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
                version = new Mozilla.FlashVersion(axo.GetVariable('$version').split(' ')[1].split(','));
            }
        }
    }
    return version;
};

Mozilla.FlashVersion = function(version)
{
    this.major = version[0] != null ? parseInt(version[0]) : 0;
    this.minor = version[1] != null ? parseInt(version[1]) : 0;
    this.rev   = version[2] != null ? parseInt(version[2]) : 0;
};

Mozilla.FlashVersion.prototype.isValid = function(version)
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

// init flash version
Mozilla.VideoPlayer.flash_verison = Mozilla.VideoPlayer.getFlashVersion();

// }}}
