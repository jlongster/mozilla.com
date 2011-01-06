/**
 * JS enhancements for /en-US/mobile/beta/gomobile/index.html
 */
window.Mozilla_Mobile_Beta_GoMobile = (function() {

    var $this = {

        video_player: null,
        share_url: null,
        short_share_url: null,

        init: function () {
            $(document).ready($this.onready);
            $(window).load($this.onload);
            return this;
        },

        onready: function () {
            $('#firefox-gomobile').each(function () {
                $this.wireUpShareOverlay();
                $this.wireUpPostcardChoices();
                $this.wireUpPreviewButton();
            });
        },

        onload: function() {
            $('body#firefox-gomobile').each(function () {
                $this.video_player = new Mozilla.VideoPlayer(
                    'gomobile-video',
                    [
                        {
                            url:   'http://videos-cdn.mozilla.net/serv/mobile/Firefox_Android_invite2.webm',
                            type:  'video/webm',
                            title: 'Download in WebM format'
                        },
                        {
                            url:   'http://videos-cdn.mozilla.net/serv/mobile/Firefox_Android_invite2.theora.ogv',
                            type:  'video/ogg; codecs=&quot;theora, vorbis&quot;',
                            title: 'Open Video format (Ogg&nbsp;Theora)'
                        },
                        {
                            url:   'http://videos-cdn.mozilla.net/serv/mobile/Firefox_Android_invite2.mp4',
                            type:  'video/mp4',
                            title: 'MPEG-4 format'
                        }
                    ],
                    'serv/mobile/Firefox_Android_invite2.mp4'
                );
                if ($this.video_player && window.location.href.indexOf('showvideo') !== -1) {
                    // HACK: If ?showvideo is appended to URL, open the video on page ready
                    // MSIE seems to get cranky if there's no delay
                    window.setTimeout(function () {
                        $this.video_player.open();
                    }, 150);
                }
            });
        },

        wireUpShareOverlay: function () {

            $('#share-the-video').click(function () {
                $('#share-overlay').show(); return false;
            });
            $('#close-share-overlay').click(function () {
                $('#share-overlay').hide(); return false;
            });
            $('#share-url input').click(function () {
                $(this).focus().select();
            });
            // HACK: MSIE 6 seems to hate <button>, since this should be
            // default behavior anyway...
            $('#share-overlay button').click(function () {
                $(this).parents('form').submit();
                return false;
            });
            
            $this.share_url = $('#share-url input').val();
            $this.short_share_url = $('#share-short-url input').val();

            $('#share-short-url input')
                .attr('checked','')
                .click(function () {
                    var state = !!($(this).attr('checked'));
                    $('#share-url input').val(state ?
                        $this.short_share_url : $this.share_url)
                    });
        },

        wireUpPostcardChoices: function () {
            $('#postcards .postcard-choices label').click(function (ev) {
                $('#postcards form .postcard-choices li').removeClass('selected');
                $(this).parent().addClass('selected');
                $(this).parent().find('input').attr('checked','checked');
            });
            $('#postcards .postcard-choices input[type=radio]').click(function (ev) {
                $('#postcards form .postcard-choices li').removeClass('selected');
                $(this).parent().addClass('selected');
            });
        },

        wireUpPreviewButton: function () {
            $('#postcards button.preview').click(function () {
                $('#preview_lightbox').hide();
                $(this).parents('form')
                    .find('input[name=mode]').val('preview').end()
                    .submit();
                return false;
            });
            $('#postcards button.send').click(function () {
                $('#preview_lightbox').hide();
                $(this).parents('form')
                    .find('input[name=mode]').val('send').end()
                    .submit();
                return false;
            });
            $('#postcards .preview_close').click(function () {
                $('#preview_lightbox').hide();
                return false;
            });
        },

        flagPostcardFormErrors: function (errors) {
            $('#postcards .fields li').removeClass('error');
            $.each(errors, function (idx, error) {
                $('#postcards .fields li input[name='+error[0]+']')
                    .parents('li').addClass('error');
            });
            Recaptcha.reload();
            window.alert('Problems in your postcard submission '+
                'have been highlighted.');
        },

        revealPreview: function () {
            $('#preview_lightbox').show();
        },

        notifyPostcardError: function () {
            Recaptcha.reload();
            window.alert('There was an unexpected problem sending your ' + 
                'postcard, please try again.');
        },

        notifyPostcardSent: function () {
            $('#postcards .fields li').removeClass('error');
            $('#postcards .fields li input,textarea').val('');
            Recaptcha.reload();
            window.alert('Your postcard has been sent!');
        },

        EOF:null

    };
    return $this.init();
})();
