if (navigator.userAgent && document.getElementById('wrapper') && navigator.userAgent.indexOf('Firefox/3.') !== -1) {

    var update_wrapper = document.createElement('div');
    update_wrapper.id = 'update-notice';

    var update_container = document.createElement('div');
    update_container.className = 'container';

    var update_heading = document.createElement('h2');
    var update_p1      = document.createElement('p');
    var update_p2      = document.createElement('p');
    var update_a1      = document.createElement('a');
    var update_a2      = document.createElement('a');

    update_heading.innerHTML = 'Hey there! Looks like you’re using an old version of Firefox.';
    update_p1.innerHTML = 'Don’t miss out on the latest technology & security features. Get the free upgrade in less than a minute.';

    update_a1.innerHTML = 'Update now';
    update_a1.href = '/firefox/new/';

    update_a2.innerHTML = 'learn more';
    update_a2.href = '/firefox/central/';

    var update_text1 = document.createTextNode(' or ');
    var update_text2 = document.createTextNode('.');

    var update_parent = document.getElementById('wrapper');

    update_parent.insertBefore(update_wrapper, update_parent.firstChild);

    update_wrapper.appendChild(update_container);

    update_container.appendChild(update_heading);
    update_container.appendChild(update_p1);
    update_container.appendChild(update_p2);

    update_p2.appendChild(update_a1);
    update_p2.appendChild(update_text1);
    update_p2.appendChild(update_a2);
    update_p2.appendChild(update_text2);

}
