(function($) {
    
    /* Set the facebook async callback handler */
    window.fbAsyncInit = function() {
        /* Do something here if we want specific facebook stuff */
        FB.Canvas.setAutoResize();
    }
    
    /* Set a handler on the badge post onload */
    /* Need to handle translations here as well? */
    $(function() {
        var v = $("#downloadButton").click(function() {
            top.location = "http://www.mozilla.com/?WT.mc_id=b15&WT.mc_ev=click";
            return;
            /* Leaving this here just incase we want to switch back */
            var os = false;
                os = (navigator.appVersion.indexOf("Windows") != -1) ? "win" : os;
                os = (navigator.appVersion.indexOf("Linux") != -1) ? "linux" : os;
                os = (navigator.appVersion.indexOf("Mac") != -1) ? "osx" : os;
                os = (navigator.appVersion.indexOf("Linux") != -1 && navigator.userAgent.indexof("_64") != -1) ? "linux64" : os;
            if(os) {
                var url = "http://www.mozilla.com/products/download.html?product=firefox-4.0rc1";
                    url += "&os=" + os;
                    url += "&lang=" + navigator.language;
                top.location =  url;
            } else {
                top.location = "http://www.mozilla.com/";
            }
        }).find("#buttonVersion");
        
        var os = false;
                os = (navigator.appVersion.indexOf("Windows") != -1) ? "Window" : os;
                os = (navigator.appVersion.indexOf("Linux") != -1) ? "Linux" : os;
                os = (navigator.appVersion.indexOf("Mac") != -1) ? "Max OSX" : os;
                os = (navigator.appVersion.indexOf("Linux") != -1 && navigator.userAgent.indexof("_64") != -1) ? "Linux" : os;

        v.text(v.text().replace("%OS_VERSION%", os));
        
        $(".badge").hover(function() {
            $(this).stop().animate({"margin-top": -5}, "fast");
        }, function() {
            $(this).stop().animate({"margin-top": 0}, "fast");
        });
        
        $("#tweet").click(function() {
            top.location = "http://twitterparty.mozilla.org"; 
        });
    });

})(jQuery);