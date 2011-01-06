<?php
/**
 * Firefox uninstall survey.
 */

// Survey URLs (as provided by SurveyGizmo)
$survey_js = 'http://app.sgizmo.com/s/survey_js2.php?id=3I1B8LC4DRAE48N2W3L3LD58K4RYVQ-112010';
$survey_noscript_href = 'http://www.surveygizmo.com/s/112010/3i1b8';

// preserve specific GET variables
$getvariables = array();
$getstring = '';
foreach (array('application', 'ua', 'version', 'lang') as $var) {
    if (!empty($_GET[$var])) {
        $getvariables[] = "{$var}=".urlencode($_GET[$var]);
    }
}
if (!empty($getvariables)) {
    $getstring = implode('&', $getvariables);
    $survey_js .= '&'.$getstring;
    $survey_noscript_href .= '?'.$getstring;
}

?>
<script src="<?=$survey_js?>" type="text/javascript"></script>
<noscript>
    <p>
        <?=$uninstall_survey_options['noscript_explanation']?>
        <a href="<?=$survey_noscript_href?>"><?=$uninstall_survey_options['noscript_takesurvey']?></a>
    </p>
</noscript>
