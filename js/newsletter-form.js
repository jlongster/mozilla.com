$(document).ready(function() {
  $('#open-pane').click(function(e) {
    e.preventDefault();
    $(this).hide();
    $('#form-pane').fadeIn();
    $('#form-pane input[name=email]').focus();

    var uri = $(this).attr('data-wt_uri');
    var ti = $(this).attr('data-wt_ti');
    dcsMultiTrack('DCS.dcsuri', uri, 'WT.ti', ti);
  });
});
