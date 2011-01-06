<div id="main-content">
<?php
// JavaScript-based SurveyGizmo

switch ($lang) {
    case 'de':
        $js_src = 'http://app.sgizmo.com/s/survey_js2.php?id=1TE0GMKN8Z7JF9XRLR0B7F2P9E36JO-264090';
        $noscript_href = 'http://www.surveygizmo.com/s/264090/firefox-3-0-19-major-update-survey-de';
        break;
    case 'en-GB':
        $js_src = 'http://app.sgizmo.com/s/survey_js2.php?id=CFK48L4HTMRYW39MRC4N8JPY0IZ5CP-177507';
        $noscript_href = 'http://www.surveygizmo.com/s/177507/cfk48';
        break;
    case 'es-ES':
        $js_src = 'http://app.sgizmo.com/s/survey_js2.php?id=41076K09IEDBMPU3ILB9DGIU312Q7E-264094';
        $noscript_href = 'http://www.surveygizmo.com/s/264094/firefox-3-0-19-major-update-survey-es';
        break;
    case 'fr':
        $js_src = 'http://app.sgizmo.com/s/survey_js2.php?id=RGEV6N49QID9ZGI5TLK0EX55GJQN16-264115';
        $noscript_href = 'http://www.surveygizmo.com/s/264115/firefox-3-0-19-major-update-survey-fr';
        break;
    case 'it':
        $js_src = 'http://app.sgizmo.com/s/survey_js2.php?id=KREZXAZNVOCI24KII80RFL332SCL98-264124';
        $noscript_href = 'http://www.surveygizmo.com/s/264124/firefox-3-0-19-major-update-survey-it';
        break;
    case 'pl':
        $js_src = 'http://app.sgizmo.com/s/survey_js2.php?id=XLIHE0I8FAE7O8GDKZ6CX4DQL7W6BU-264133';
        $noscript_href = 'http://www.surveygizmo.com/s/264133/firefox-3-0-19-major-update-survey-pl';
        break;
    case 'pt-BR':
        $js_src = 'http://app.sgizmo.com/s/survey_js2.php?id=58N0542XOA3L2X4AP6GP02240A6JB4-264135';
        $noscript_href = 'http://www.surveygizmo.com/s/264135/firefox-3-0-19-major-update-survey-pt-br';
        break;
    case 'ru':
        $js_src = 'http://app.sgizmo.com/s/survey_js2.php?id=S9PN3ZB8ZKO6JDCMMOTJ1RTUK889M3-264136';
        $noscript_href = 'http://www.surveygizmo.com/s/264136/firefox-3-0-19-major-update-survey-ru';
        break;
    default:
        $js_src = 'http://app.sgizmo.com/s/survey_js2.php?id=CFK48L4HTMRYW39MRC4N8JPY0IZ5CP-177507';
        $noscript_href = 'http://www.surveygizmo.com/s/177507/cfk48';
}


$surveygizmo = array(
    'js_src'                => $js_src,
    'noscript_href'         => $noscript_href,
    'noscript_explanation'  => $noscript_explanation,
    'noscript_takesurvey'   => $noscript_takesurvey
);
?>

<script src="<?=$surveygizmo['js_src'] ?>" type="text/javascript"></script>
<noscript>
    <p>
        <?=$surveygizmo['noscript_explanation']?>
        <a href="<?=$surveygizmo['noscript_href']?>"><?=$surveygizmo['noscript_takesurvey']?></a>
    </p>
</noscript>

</div>
