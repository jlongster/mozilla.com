<?php

$survey_url = array(
    'de'    => 'http://www.surveygizmo.com/s3/iframe/707494/3bb997015b19',
    'es-AR' => 'http://www.surveygizmo.com/s3/iframe/723855/bc6e39e0e62f',
    'es-ES' => 'http://www.surveygizmo.com/s3/iframe/707370/843445dbed79',
    'fr'    => 'http://www.surveygizmo.com/s3/iframe/707025/62964b80c226',
    'it'    => 'http://www.surveygizmo.com/s3/iframe/707358/0e8d68114df5',
    'pl'    => 'http://www.surveygizmo.com/s3/iframe/707383/bf65f6986203',
    'pt-BR' => 'http://www.surveygizmo.com/s3/iframe/723849/d557cac80bdd',
//    'ru'    => '',
);

$survey_msg = array(
    'de'    => 'Haben Sie einen Moment Zeit? <span>Helfen Sie uns.</span>',
    'es-AR' => '¿Tenés un segundo? <span>¡Ayudanos!</span>',
    'es-ES' => '¿Tienes un segundo? <span>Ayúdanos.</span>',
    'fr'    => 'Vous avez une seconde&nbsp;? <span>Donnez-nous un coup de main&nbsp;!</span>',
    'it'    => 'Hai un momento libero? <span>Aiutaci.</span>',
    'pl'    => 'Masz chwilę? <span>Pomóż nam.</span>',
    'pt-BR' => 'Tem um minuto? <span>Da Uma Força!</span>',
//    'ru'    => 'Have a second? <span>Help Us Out</span>',
);

if( array_key_exists($lang, $survey_url) ) {

$extracontent2 = <<<EXTRA

<script>// <![CDATA[

$(document).ready(function() {

        var cookieName = 'Firefox8WhatsNewSurvey';
        var cookieDays = 30;

        var surveyProbability = 0.1;

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

        var showSurvey = getCookie(cookieName);

        if (showSurvey === null) {

            // no cookie set, show survey with probability
            showSurvey = (Math.random() < surveyProbability) ? 'yes' : 'no';
            // survey is only ever displayed once, set cookie to hide it
            setCookie(cookieName, 'no', '/', cookieDays);
        } else {
            // make sure it stays hidden even if you edit the cookie value
            showSurvey = 'no';
            setCookie(cookieName, 'no', '/', cookieDays);
        }


        if (showSurvey == 'yes') {
            var \$survey = $('<div id="survey-box"><h3>{$survey_msg[$lang]}</h3>'
                + '<iframe src="{$survey_url[$lang]}" frameborder="0" width="700" height="300" style="overflow:hidden" ALLOWTRANSPARENCY="true"></iframe>'
                + '<style>#download-sidebar { display: none; }</style>'
                + '</div>'
                + '<div style="clear:both;"></div>'
            );

            var \$footer = $('#download-footer');
            var \$promo  = $('{$target_id}');

            if (\$promo.length) {
                \$promo.before(\$survey);
            } else {
                \$footer.before(\$survey);
            }
        }
    });

// ]]></script>

EXTRA;
}
