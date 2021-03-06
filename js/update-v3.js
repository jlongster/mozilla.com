/**
 * Firefox 3.x upgrade notice
 *
 * This code is licensed under the Mozilla Public License 1.1.
 *
 * Portions adapted from the jQuery Easing plugin written by Robert Penner and
 * used under the following license:
 *
 *   Copyright 2001 Robert Penner
 *   All rights reserved.
 *
 *   Redistribution and use in source and binary forms, with or without
 *   modification, are permitted provided that the following conditions are
 *   met:
 *
 *   - Redistributions of source code must retain the above copyright notice,
 *     this list of conditions and the following disclaimer.
 *   - Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in the
 *     documentation and/or other materials provided with the distribution.
 *   - Neither the name of the author nor the names of contributors may be
 *     used to endorse or promote products derived from this software without
 *    specific prior written permission.
 *
 *   THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 *   "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED
 *   TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR
 *   PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR
 *   CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *   EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
 *   PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
 *   PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
 *   LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *   NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 *   SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @copyright 2011 Mozilla Foundation, 2011 silverorange Inc.
 * @license   http://www.mozilla.org/MPL/MPL-1.1.html Mozilla Public License 1.1
 * @author    Michael Gauthier <mike@silverorange.com>
 */

(function() {

    var sprintf = function(str)
    {
        for (var i = 1; i < arguments.length; i++) {
            str = str.replace(/%s/, arguments[i]);
        }
        return str;
    };

    var getString = function(variable, defaultValue)
    {
        if (typeof window[variable] === 'undefined') {
            return defaultValue;
        }

        return window[variable];
    };

    var isJquery = (typeof jQuery !== 'undefined');

    // preload background
    var img = new Image();
    img.src = '/img/covehead/firefox/update-creature.png';

    if (isJquery) {
        jQuery.extend(jQuery.easing, {
            'slideOut':  function (x, t, b, c, d) {
                return c * (t /= d) * t + b;
            },
            'slideIn': function (x, t, b, c, d) {
                return -c * (t /= d) * (t - 2) + b;
            }
        });
    }

    var positionCookieName = 'updateV3Position';
    var hideCookieName = 'updateV3Hide';

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

    var position = getCookie(positionCookieName);
    if (position === null || (position != 'top' && position != 'bottom')) {
        position = (Math.floor(Math.random() * 2) == 0) ? 'top' : 'bottom';
        setCookie(positionCookieName, position, '/', 30);
    } else {
        setCookie(positionCookieName, position, '/', 30);
    }

    var hide = getCookie(hideCookieName);
    hide = (hide == '1') ? true : false;

    var updateWrapper;
    var updateContainer;

    var initNotice = function()
    {
        updateWrapper = document.createElement('div');
        updateWrapper.id = 'update-notice';
        if (position == 'top') {
            updateWrapper.className = 'top';
        } else {
            updateWrapper.className = 'bottom';
        }

        var updateHeading       = document.createElement('h2');
        updateHeading.innerHTML = getString(
            'v3UpdateHeading',
            'Hey there! Looks like you’re using an old version of Firefox.'
        );

        var updateP1       = document.createElement('p');
        updateP1.innerHTML = getString(
            'v3UpdateP1',
            'Don’t miss out on the latest technology & security features.' +
            '<br />Get the free upgrade in less than a minute.'
        );

        var updateP2       = document.createElement('p');
        updateP2.className = 'action';
        updateP2.innerHTML = sprintf(
            getString(
                'v3UpdateP2',
                '<a href="%s" class="button">Update now</a> ' +
                '<span>or <a href="%s">learn more</a>.</span>'
            ),
            getString('v3UpdateLink', '/firefox/new/'),
            getString('v3UpdateLearnLink', '/firefox/central/')
        );

        var dismissLink       = document.createElement('a');
        dismissLink.href      = '#close';
        dismissLink.className = 'close';
        dismissLink.title     = getString('v3CloseText', 'Close');
        dismissLink.innerHTML = getString('v3CloseText', 'Close');

        // not using jQuery in case it's not available
        dismissLink.addEventListener('click', function(e) {
            e.preventDefault();
            hideNotice();
        }, false);

        var updateMessage = document.createElement('div');
        updateMessage.className = 'message';
        updateMessage.appendChild(updateHeading);
        updateMessage.appendChild(updateP1);

        updateContainer = document.createElement('div');
        updateContainer.className = 'container';
        updateContainer.appendChild(updateMessage);
        updateContainer.appendChild(updateP2);
        updateContainer.appendChild(dismissLink);

        updateWrapper.appendChild(updateContainer);

        var updateParent = document.getElementById('wrapper');
        if (position == 'top') {
            updateParent.insertBefore(updateWrapper, updateParent.firstChild);
        } else {
            updateParent.appendChild(updateWrapper);
        }

        // add tracking codes
        var links = updateWrapper.getElementsByTagName('a');
        for (var i = 0; i < links.length; i++) {
            if (links[i].className.indexOf('button') !== -1) {
                // download link
                if (position === 'top') {
                    links[i].href += '?WT.mc_id=upgradetop';
                } else {
                    links[i].href += '?WT.mc_id=upgradebottom';
                }
            } else if (links[i].className.indexOf('close') === -1) {
                // learn more link
                if (position === 'top') {
                    links[i].href += '?WT.mc_id=upgradetoplm';
                } else {
                    links[i].href += '?WT.mc_id=upgradebottomlm';
                }
            }
        }

        showNotice();
    };

    var hideNotice = function()
    {
        if (position == 'top') {
            hideNoticeTop();
        } else {
            hideNoticeBottom();
        }

        setCookie(hideCookieName, '1', '/', 30);
    };

    var hideNoticeTop = function()
    {
        if (isJquery) {
            var speed = 150;
            var easing = 'slideOut';

            var $container = $(updateContainer);
            var $wrapper = $(updateWrapper);
            $wrapper.css('overflow', 'hidden');

            var height = $container.height() + 30;

            $wrapper.animate(
                { 'height' : 0 }, speed, easing,
                function() {
                    $wrapper.css('display', 'none');
                }
            );
            $container.animate({ 'top' : -height }, speed, easing);
        } else {
            updateWrapper.style.display = 'none';
        }
    };

    var hideNoticeBottom = function()
    {
        if (isJquery) {
            var speed = 150;
            var easing = 'slideOut';

            var $wrapper = $(updateWrapper);
            $wrapper.animate(
                { 'height' : 0 }, speed, easing,
                function() {
                    $wrapper.css('display', 'none');
                }
            );
        } else {
            updateWrapper.style.display = 'none';
        }
    };

    var showNotice = function()
    {
        if (position == 'top') {
            showNoticeTop();
        } else {
            showNoticeBottom();
        }
    };

    var showNoticeTop = function()
    {
        if (isJquery) {
            var speed = 500;
            var easing = 'slideIn';

            var $container = $(updateContainer);
            $container.css('visibility', 'hidden');

            var $wrapper = $(updateWrapper);
            $wrapper
                .css('height', '0')
                .css('overflow', 'visible')
                .css('display', 'block');

            var height = $container.height() + 30;
            $wrapper.css('overflow', 'hidden');
            $container
                .css('top', -height + 'px')
                .css('visibility', 'visible');

            $wrapper.animate(
                { 'height' : height }, speed, easing,
                function() {
                    $wrapper.css('height', 'auto');
                }
            );
            $container.animate({ 'top' : 0 }, speed, easing);
        } else {
            updateWrapper.style.display = 'block';
        }
    };

    var showNoticeBottom = function()
    {
        if (isJquery) {
            var speed = 500;
            var easing = 'slideIn';

            var $container = $(updateContainer);
            $container.css('visibility', 'hidden');

            var $wrapper = $(updateWrapper);
            $wrapper
                .css('height', '0')
                .css('overflow', 'visible')
                .css('display', 'block');

            var height = $container.height() + 30;
            $wrapper.css('overflow', 'hidden');
            $container.css('visibility', 'visible');

            $wrapper.animate(
                { 'height' : height }, speed, easing,
                function() {
                    $wrapper.css('height', 'auto');
                }
            );
        } else {
            updateWrapper.style.display = 'block';
        }
    };

    if (!hide) {
        setTimeout(function() {
            if (document.getElementById('wrapper')) {
                initNotice();
            }
        }, 1500);
    }

})();
