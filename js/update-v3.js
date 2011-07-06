function getL10nString(variable, text) {
    if (typeof(variable) == 'undefined') {
        return text;
    } else {
        return variable;
    }
}

function sprintf(string) {
    for (var i=1; i<arguments.length; i++) {
        string = string.replace(/%s/, arguments[i]);
    }
    return string;
}

if (navigator.userAgent && document.getElementById('wrapper') && navigator.userAgent.indexOf('Firefox/3.') !== -1) {

    // these urls can be redefined per locale outside of this file
    var link1 = getL10nString(link1, '/firefox/new/');
    var link2 = getL10nString(link2, '/firefox/central/');

    // these strings are to be translated outside of this file
    var str1 = getL10nString(str1, 'Hey there! Looks like you’re using an old version of Firefox.');
    var str2 = getL10nString(str2, 'Don’t miss out on the latest technology & security features. Get the free upgrade in less than a minute.');
    var str3 = sprintf(getL10nString(str3, '<a href="%s">Update now</a> or <a href="%s">learn more</a>.'), link1, link2);

    // generate the html
    var update_wrapper = document.createElement('div');
    update_wrapper.id  = 'update-notice';
    var update_text    = '<div class="container"><h2>' + str1 + '</h2>' + '<p>' + str2 +'</p>' + '<p>' + str3 +'</p></div>';
    var update_parent  = document.getElementById('wrapper');

    // insert the html
    update_parent.insertBefore(update_wrapper, update_parent.firstChild);
    document.getElementById('update-notice').innerHTML = update_text;
}
