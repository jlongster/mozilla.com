/**
 * JS enhancements for /en-US/mobile/beta/index.html and subpages
 */
window.Mozilla_Mobile_Beta = (function() {

    var $this = {

        init: function () {
            $(document).ready($this.onready);
            $(window).load($this.onload);
            return this;
        },

        onready: function () {
            // HACK: MSIE 6 seems to hate <button>, since this should be
            // default behavior anyway...
            $('#beta-spread-the-word').find('button').click(function () {
                $(this).parents('form').submit();
                return false;
            });
        },

        onload: function() {
            $('body#firefox-beta-mobile').each(function () {
                $this.video_player = new Mozilla.VideoPlayer(
                    'gomobile-video',
                    [
                        {
                            url:   'http://videos-cdn.mozilla.net/serv/mobile/meetFFXmobile2-640x360.webm',
                            type:  'video/webm',
                            title: 'Download in WebM format'
                        },
                        {
                            url:   'http://videos-cdn.mozilla.net/serv/mobile/meetFFXmobile2-640x360.theora.ogv',
                            type:  'video/ogg; codecs=&quot;theora, vorbis&quot;',
                            title: 'Open Video format (Ogg&nbsp;Theora)'
                        },
                        {
                            url:   'http://videos-cdn.mozilla.net/serv/mobile/meetFFXmobile2-640x360.mp4',
                            type:  'video/mp4',
                            title: 'MPEG-4 format'
                        }
                    ],
                    'serv/mobile/meetFFXmobile2-640x360.mp4'
                );
            });
        },

        EOF:null

    };
    return $this.init();
})();
