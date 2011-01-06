function whatsNewMessage() {
        // get user-agent version for firefox browsers
        var exp = /(?:Firefox|GranParadiso|Minefield|BonEcho)\/([0-9.]+(?:[ab][^ ]+|))/;
        var matches = navigator.userAgent.match(exp);

        var firefox = null;

        if (matches !== null) {
                firefox = {};
                firefox.version = matches[1];

                // normalize versions for alphas and betas
                var beta = firefox.version.match(/([0-9.]+)[ab]/);
                if (beta === null) {
                        firefox.major_version = parseInt(firefox.version.split('.')[0]);
                        firefox.is_beta       = false;
                } else {
                        var major_version = beta[1];
                        major_version = parseInt(firefox.version.split('.')[0]);
                        major_version--;
                        firefox.major_version = major_version;
                        firefox.is_beta       = true;
                }
        }

        if (firefox.version != userversion) {
                document.getElementById('main-feature-title').innerHTML = message1 + firefox.version;
                document.getElementById('main-feature-contents').innerHTML = message2;
        }
}

// Surveys for 50% of people; Bugs 449417 & 466849
YAHOO.util.Event.onDOMReady( function hideSurvey() {
    var survey = document.getElementById('survey');
    var sumo   = document.getElementById('sumo');
    if (survey) {
        var rand = Math.random();
        if (rand < 0.50) {
            if (sumo) {
                YAHOO.util.Dom.addClass(sumo, 'hide');
            }
            YAHOO.util.Dom.removeClass(survey, 'hide');
        }
    }
});
