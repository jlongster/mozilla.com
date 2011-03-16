/**
 * Various tools for the HTML5 video element
 *
 * Meant to be used with CSS in /styles/tignish/video-player.css.
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
$(document).ready(function() {
  $('.mozilla-video-control').each(function() {
    Mozilla.VideoControl.controls.push(
      new Mozilla.VideoControl($(this))
    )
  });
});

/**
 * Provides a click-to-play button for HTML5 video element content
 *
 * If the HTML5 video element is supported, the following markup will
 * automatically get the click-to-play button when the page initializes:
 * <code>
 * &lt;div class="mozilla-video-control"&gt;
 *   &lt;video ... /&gt;
 * &lt;/div&gt;
 * </code>
 *
 * @param jQuery|String container
 */
Mozilla.VideoControl = function(container)
{
  if (typeof container == 'String') {
    container = $('#' + container);
  }

  this.container = container;

  // Retrieve jQuery object and the corresponding DOM element
  var video = container.find('video:first');

  // If there is not preload attribute set, set it to metadata
  // because this library depends on preloading
  var preload = video.attr('preload');
  if(!preload || preload == 'none') {
      video.attr('preload', 'metadata');
  }

  this.video = video;
  this._video = this.video[0];

  this.semaphore = false;

  /*
   * Check if HTMLMediaElement exists to filter out browsers that do not
   * support the video element.
   */
  if (   typeof HTMLMediaElement != 'undefined'
    && this._video instanceof HTMLMediaElement
  ) {
    this.drawControl();
    this._video._control = this;
  }
}

Mozilla.VideoControl.controls = [];

Mozilla.VideoControl.prototype.drawControl = function()
{
  this.control = $('<a href="#" class="mozilla-video-control-overlay" style="opacity: 0" />');

  // Show the click-to-play button. In the future, this may be changed
  // to show the click-to-play button based on media events like the
  // hiding is done.
  if (this._video.paused || this._video.ended) {
    this.show();
  }

  var that = this;

  // hide click-to-play button on these events
  this.video.bind('play playing seeking waiting', function(event) {
    that.hide();
  });

  this.control.mouseover(function(event) {
    if (!that.semaphore) {
      that.prelight();
    }
  });

  this.control.mouseout(function(event) {
    if (!that.semaphore) {
      that.unprelight();
    }
  });

  this.control.click(function(event) {
    event.preventDefault();

    if (that.semaphore || !that.videoCanPlay()) {
      return;
    }

    that.semaphore = true;
    // rewind the video
    if (that._video.ended) {
      that._video.currentTime = 0;
    }
    that._video.play();
  });

  this.container.append(this.control);
}

Mozilla.VideoControl.prototype.videoCanPlay = function()
{
  // check if we're using an older draft version of the readyState spec
  var current_data = (typeof HTMLMediaElement.CAN_PLAY == 'undefined') ?
    HTMLMediaElement.HAVE_CURRENT_DATA : HTMLMediaElement.CAN_PLAY;

  return (this._video.readyState >= current_data);
}

Mozilla.VideoControl.prototype.show = function()
{
  var that = this;

  this._video.controls = false;
  // FIXME : Does not work on http://mozilla.local/en-US/firefox/video/
  // this.control.show();
  this.control.css('display', 'block');
  this.control.stop(true).fadeTo('slow', 0.7, function() {
    that.semaphore = false;
  });
}

Mozilla.VideoControl.prototype.hide = function()
{
  var that = this;

  this.control.stop(true).fadeTo('fast', 0, function() {
    $(this).hide();
    that._video.controls = true;
  });
}

Mozilla.VideoControl.prototype.prelight = function()
{
  this.control.stop(true).fadeTo('fast', 1);
}

Mozilla.VideoControl.prototype.unprelight = function()
{
  this.control.stop(true).fadeTo('fast', 0.7);
}

// }}}
// {{{ Mozilla.VideoScaler

/**
 * Initializes video scalers on this page after the document has been loaded
 */
$(document).ready(function() {
  $('.mozilla-video-scaler').each(function() {
    Mozilla.VideoScaler.scalers.push(
      new Mozilla.VideoScaler($(this))
    )
  });
});

/**
 * Scales a video to full size then the video's click-to-play button
 * is clicked
 *
 * If the HTML5 video element is supported, the following markup will
 * automatically get this behaviour when the page initializes:
 * <code>
 * &lt;div class="mozilla-video-scaler"&gt;
 *   &lt;div class="mozilla-video-control"&gt;
 *     &lt;video ... /&gt;
 *   &lt;/div&gt;
 * &lt;/div&gt;
 * </code>
 *
 * @param jQuery|String container
 */
Mozilla.VideoScaler = function(container)
{
  if (typeof container == 'String') {
    container = $('#' + container);
  }

  this.container = container;
  this.video = container.find('video:first');
  this._video = this.video[0];
  this.opened = false;

  /*
   * Check if HTMLMediaElement exists to filter out browsers that do not
   * support the video element.
   */
  if (   typeof HTMLMediaElement != 'undefined'
    && this._video instanceof HTMLMediaElement
  ) {
    this.init();
    this._video._scaler = this;
  }
}

Mozilla.VideoScaler.scalers = [];
Mozilla.VideoScaler.close_text = 'Close';

Mozilla.VideoScaler.prototype.init = function()
{
  var width = this.container.width()
  var height = this.container.height()

  this.original_position = {
    top: parseInt(this.container.position().top) + parseInt(this.container.css('marginTop')),
    left: parseInt(this.container.position().left) + parseInt(this.container.css('marginLeft')),
    width: width,
    height: height,
  }

  // insert a shim of the original dimensions to keep text wrapping the same
  $('<div class="mozilla-video-scaler-shim" />').css({
    width: width,
    height: height
  }).insertBefore(this.container);

  // reposition container absolutely so it shows in its original location
  this.container.css(this.original_position).css({
    position: 'absolute',
    margin: 0
  });

  var that = this;

  // scale up when click-to-play control is clicked
  if (this._video._control instanceof Mozilla.VideoControl) {
    this.container.click(function() {
      if (that._video._control.videoCanPlay()) {
        that.open();
      }
    });
  }

  // draw close link
  this.close_link = $('<a href="#" class="mozilla-video-scaler-close-link" />')
    .text(Mozilla.VideoScaler.close_text).insertBefore(this.container)
    .click(function(event) {
      // scale down when close link is clicked
      event.preventDefault();
      that.close();
    });
}

Mozilla.VideoScaler.prototype.open = function()
{
  if (this.opened) {
    return;
  }

  this._video.controls = true;
  this.opened = true;

  // get extra width from borders, margins and padding
  var border_w = this.container.width() - this.video.width();

  // get extra height from borders, margins and padding
  var border_h = this.container.height() - this.video.height();

  // scale to intrinsic video dimensions
  var w = this._video.videoWidth + border_w;
  var h = this._video.videoHeight + border_h;

  // get absolute coordinates to centering scaled video
  var x = Math.round(($('#doc').width() - w) / 2);
  var y = $(window).scrollTop() + Math.round(($(window).height() - h) / 2);

  // reset the dimensions of the mozilla-video-control to enable it to be resized
  this.container.children().css({
    width: 'auto',
    height: 'auto'
  });

  var that = this;

  this.container.stop(true).animate({
    width: w, 
    height: h, 
    top: y, 
    left: x
  }, 1000, 'swing', function() {
    that.showCloseLink();
  });
}

Mozilla.VideoScaler.prototype.close = function()
{
  if (!this.opened) {
    return;
  }

  this.opened = false;
  this._video.controls = false;

  this.hideCloseLink();

  var that = this;

  this.container.stop(true).animate(this.original_position, 750, 'swing', function() {
    // check if video is ended to work around Mozilla Bug #495145
    if (!that._video.ended) {
      that._video.pause();
    }

    // If there is a click-to-play button, show it. that is a
    // workaround until events can be used instead.
    if (that._video._control instanceof Mozilla.VideoControl) {
      that._video._control.show();
    }
  });
}

Mozilla.VideoScaler.prototype.showCloseLink = function()
{
  // close link will be positioned relatively to the video scaler container
  var control = this.container;

  // update CSS class to un-notch corner
  control.addClass('mozilla-video-scaler-opened');

  // position close link
  this.close_link.css({
    top: control.position().top - this.close_link.innerHeight(),
    right: $("#doc").width() - (control.position().left + control.width())
  }).stop(true).fadeIn('fast');
}

Mozilla.VideoScaler.prototype.hideCloseLink = function()
{
  // re-notch corners
  this.container.removeClass('mozilla-video-scaler-opened');

  // hide close link
  this.close_link.hide();
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
  this.id = id;
  this.flv_url = flv_url;
  this.sources = sources;
  this.opened = false;

  if (arguments.length > 3) {
    this.autoplay = autoplay;
  } else {
    this.autoplay = true;
  }

  var that = this;

  $(document).ready(function() {
    that.init();
  });
}

Mozilla.VideoPlayer.height = 385;
Mozilla.VideoPlayer.width = 640;

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
  var that = this;

  // add overlay and preview image to document
  this.overlay = $('<div class="mozilla-video-player-overlay" />').hide().appendTo('body');
  this.video_container = $('<div class="mozilla-video-player-window" />').hide().appendTo('body');

  // set video link and video preview link event handler
  $('#' + this.id + ', #' + this.id + '-preview').click(function(event) {
    event.preventDefault();
    that.open();
  });
}

Mozilla.VideoPlayer.prototype.clearVideoPlayer = function()
{
  // remove event handlers
  this.video_container.unbind('click');

  // workaround for FF Bug #533840, manually pause all videos
  this.video_container.find('video').each(function() {
    $(this)[0].pause();
  });

  // remove all elements
  this.video_container.empty();
}

Mozilla.VideoPlayer.prototype.drawVideoPlayer = function()
{
  var that = this;

  this.clearVideoPlayer();

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
  $.each(this.sources, function(index, source) {
    content += '<li><a href="' + source.url + '">' + source.title + '</a></li>';
  });
  content += '</ul></div>';

  this.video_container.append(
    $('<div class="mozilla-video-player-close" />').append(
      $('<a href="#" />').click(function(event) {
        event.preventDefault();
        that.close();
      }).text(Mozilla.VideoPlayer.close_text)
    )
  ).append(
    $('<div class="mozilla-video-player-content" />').html(content)
  );
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

  $.each(this.sources, function(index, source) {
    if (!source.type) return; // must have MIME type
    content += '<source src="' + source.url + '" ' 
        + 'type="' + source.type + '"/>';
  });

  content += '</video>';

  return content;
}

Mozilla.VideoPlayer.prototype.getFlashPlayerContent = function()
{
  var url = '/includes/flash/playerWithControls.swf?flv=' + this.flv_url
    + '&amp;autoplay=';
  url+= (this.autoplay) ? 'true' : 'false';

  var content =
      '<object type="application/x-shockwave-flash" style="'
    + 'width: ' + Mozilla.VideoPlayer.width + 'px; '
    + 'height: ' + Mozilla.VideoPlayer.height + 'px;" '
    + 'wmode="transparent" data="' + url + '">'
    + '<param name="movie" value="' + url + '">'
    + '<param name="wmode" value="transparent">'
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
  $('#lang_form').hide();

  this.drawVideoPlayer();

  this.overlay.height($(window).height()).fadeIn();
  this.video_container.css('top', $(window).scrollTop() + ($(window).height() - 570) / 2).fadeIn();

  this.opened = true;

  // getSubtitles() depends on mozilla-video-tools-addsubtitles.js
  if(window.getSubtitles) {
    getSubtitles(this.video_container.css('top'));
  }
}

Mozilla.VideoPlayer.prototype.close = function()
{
  // hideSubtitles() depends on mozilla-video-tools-addsubtitles.js
  if(window.hideSubtitles) {
    hideSubtitles();
  }

  this.overlay.fadeOut();
  this.video_container.fadeOut();

  // clear the video content so IE will stop playing the audio
  this.clearVideoPlayer();

  // if language form was hidden, show it again
  $('#lang_form').show();

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
