<?php
/**
 * Kampyle Feedback button / form.
 * 
 * You'll need to add the CSS with,
 * <link rel="stylesheet" type="text/css" media="screen" href="/style/kampyle/k_button.css" /> 
 */


 $kampyle_param_pieces = '';
 foreach ($kampyle_params as $n => $p) {
     $kampyle_param_pieces[] = $n .'='. $p;
 }
 $kampyle_param_str = implode('&', $kampyle_param_pieces);
 $kampyle_param_str = htmlentities($kampyle_param_str);

?>
<!--Start Kampyle Feedback Form Button-->
<div id="k_close_button"
     class="k_float kc_bottom kc_right"></div>

<div><a href="https://www.kampyle.com/feedback_form/ff-feedback-form.php?<?= $kampyle_param_str ?>"  
        target="kampyleWindow" 
        id="kampylink"
        class="k_float k_bottom k_right"
        onclick="javascript:k_button.open_ff('<?= $kampyle_param_str ?>');return false;"><img src="/img/kampyle/en-orange-corner-low-right.gif" alt="Feedback Form"/></a>
        </div>
<script src="/js/kampyle/k_button.js" type="text/javascript"></script>
<!--End Kampyle Feedback Form Button-->

<?php
  unset($kampyle_param_str);
  unset($kampyle_param_pieces);
?>
