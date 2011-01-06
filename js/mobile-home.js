$(document).ready(function() {
    $('#sync-why-link a').toggle(function(e) {
        e.preventDefault();
        $('#sync-why').hide()
            .css('position', 'static')
            .slideDown();
    }, function(e) {
        e.preventDefault();
        $('#sync-why').slideUp();
    });
});
