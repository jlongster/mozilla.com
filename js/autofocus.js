$(document).ready(function() {
    if (!("autofocus" in document.createElement("input"))) {
        $("input[autofocus]").focus();
    }
});
