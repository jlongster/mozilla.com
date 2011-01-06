if (typeof Mozilla === 'undefined') {
    var Mozilla = {};
}

if (typeof Mozilla.SMSForm === 'undefined') {
    Mozilla.SMSForm = {};
}

// error messages are outside of the function because we want to be able to
// redefine them for locales
Mozilla.SMSForm.errorMessages = {
    'phone-required':   'Enter your SMS number so we can send you the ' +
                        'download link.',
    'phone-error':      'We\'re sorry, we could not send an SMS message to ' +
                        'the number you provided. Please check the number ' +
                        'you entered and try again.',
    'recaptcha-failed': 'Please make sure you entered the two words correctly.'
};

// set up sms download widget
$(document).ready(function() {

    var pages = $(
          '#mobile-promo-intro,'
        + '#mobile-promo-form,'
        + '#mobile-promo-success'
    );

    var pagesById = {
        'intro':     $('#mobile-promo-intro'),
        'form':      $('#mobile-promo-form'),
        'thank-you': $('#mobile-promo-success')
    };

    var $error = $('p.form-error');
    $error
        .removeClass('form-error-visible')
        .css('opacity', '0');

    var parentNode = $(pagesById['form'].get(0).parentNode);
    var fadePeriod = 100;
    var resizePeriod = 200;
    var errorFadePeriod = 400;
    var errorResizePeriod = 200;
    var errorShowPeriod = 250;
    var errorHidePeriod = 300;

    $phone   = $('#mobile-phone');
    $prefix  = $('#mobile-prefix');
    $submit  = $('#mobile-send');
    $captcha = $('#recaptcha_container');

    $phone.focus(function(e) {
        e.preventDefault();
        selectPhone();
        return false;
    });

    $shim = $('<div></div>')
        .css('display', 'none')
        .css('position', 'absolute')
        .css('top', '0')
        .css('left', '0')
        .appendTo($captcha);

    $prefix.change(function(e) {
        var code = $(this).val();
        updatePhone(code, true);
    });

    function focusPhone()
    {
        $phone.focus();
        selectPhone();
    }

    function selectPhone()
    {
        var match;
        var code = $prefix.val();

        if (code) {
            var exp = new RegExp(
                '^(\\s*' + code.replace(/\+/, '\\+') + '\\s*)'
            );
            match = exp.exec($phone.val());
        } else {
            match = null;
        }

        if (match === null) {
            $phone.select();
        } else {
            $phone.attr('selectionStart', match[1].length);
            $phone.attr('selectionEnd', $phone.val().length);
        }
    }

    function updatePhone(code, focus) {
        if (code == '') {
            $phone.val('');
            setSensitivity(false);
        } else {
            setSensitivity(true);
            var val = $phone.val().replace(/^\s+i/, '').replace(/\s+$/, '');
            if (val.indexOf(code) != 0) {
                $phone.val(code + ' ');
            }
            if (focus) {
                focusPhone();
            }
        }
    }

    function setSensitivity(sensitivity)
    {
        var from = (sensitivity) ? 'insensitive' : 'sensitive';
        var to   = (sensitivity) ? 'sensitive'   : 'insensitive';

        $phone.parent()
            .removeClass(from)
            .addClass(to);

        $submit.parent()
            .removeClass(from)
            .addClass(to);

        $captcha
            .removeClass(from)
            .addClass(to);

        if (sensitivity) {
            $shim.css('display', 'none');
        } else {
            $shim
                .css('width', $captcha.width())
                .css('height', $captcha.height())
                .css('display', 'block');
        }

        $phone.attr('disabled',  !sensitivity);
        $submit.attr('disabled', !sensitivity);
        $('#recaptcha_response_field').attr('disabled', !sensitivity);
    }


    function flip(parentNode, page1, page2)
    {
        page1.animate({ 'opacity': '0' }, fadePeriod, 'linear', function()
        {
            var height = page1.height();

            parentNode
                .css('overflow', 'hidden')
                .css('height', (height + 2) + 'px');

            page2
                .css('opacity', '0')
                .css('display', 'block')
                .css('margin', '0');

            page1.css('display', 'none');

            height = page2.height();

            // initialize phone
            if (page2 === pagesById['form']) {
                updatePhone($prefix.val(), true);
            }

            parentNode.animate({ 'height': height + 2 }, resizePeriod, 'linear', function()
            {
                parentNode.css('height', 'auto');
                page2.animate({'opacity': '1'}, fadePeriod, 'linear');
            });
        });
    }

    function showError(message)
    {
        $error
            .empty()
            .append(message)
            .wrapInner('<span />')
            .addClass('form-error-visible');

        var height = $error.children().height();

        $error.animate(
            { 'height': height + 20 },
            errorResizePeriod,
            'linear',
            function() {
                $error.animate({ 'opacity': '1' }, errorFadePeriod, 'linear');
            }
        );
    }

    function hideError()
    {
        $error.animate({ 'opacity': '0' }, errorHidePeriod, 'linear', function()
        {
            $error.removeClass('form-error-visible')
        });
    }

    function validateEmail(email)
    {
        return /^([\w\-.+])+@([\w\-.])+\.[A-Za-z]{2,4}$/.test(email);
    }

    function validateForm()
    {
        var valid = true;

        var privacy = $('#privacy-check').attr('checked');
        var email = validateEmail($('#email').val());

        if (email) {
            $('#email-wrapper').removeClass('form-error');
        } else {
            $('#email-wrapper').addClass('form-error');
            valid = false;
        }

        if (privacy) {
            $('#privacy-check-label').removeClass('form-error');
        } else {
            $('#privacy-check-label').addClass('form-error');
            valid = false;
        }

        // show or hide error messages
        if (!email && !privacy) {
            showError(errorMessages['email-privacy']);
        } else if (!email) {
            showError(errorMessages['email']);
        } else if (!privacy) {
            showError(errorMessages['privacy']);
        } else {
            hideError();
        }

        return valid;
    }

    // first intro page is optional
    if (pagesById['intro']) {
        $('#mobile-promo-intro a:first').click(function(e) {
            e.preventDefault();
            flip(parentNode, pagesById['intro'], pagesById['form']);
        });
    }

    $('#mobile-promo-success a:first').click(function(e) {
        e.preventDefault();
        flip(parentNode, pagesById['thank-you'], pagesById['form']);
    });

    $('#mobile-promo-form form').submit(function(e) {
        e.preventDefault();
        $('#mobile-send').attr('disabled', true);

        var loc = document.location + '';
        var pos = loc.lastIndexOf('/');
        loc = loc.substring(0, pos + 1) + 'sms.html';
        $(this).ajaxSubmit({
            url:      loc,
            dataType: 'json',
            success:  handleFormResponse
        });

        return false;
    });

    function handleFormResponse(data, httpStatus, xhr)
    {
        var error = false;
        for (var i = 0; i < data.errors.length; i++) {
            switch(data.errors[i]) {

            case 'phone-required':
                if (!error) {
                    showError(
                        Mozilla.SMSForm.errorMessages['phone-required']
                    );
                    error = true;
                }
                $phone.addClass('form-error');
                break;

            case 'phone-error':
                if (!error) {
                    showError(
                        Mozilla.SMSForm.errorMessages['phone-error']
                    );
                    error = true;
                }
                break;

            case 'recaptcha-failed':
                if (!error) {
                    showError(
                        Mozilla.SMSForm.errorMessages['recaptcha-failed']
                    );
                    error = true;
                }
                $('#recaptcha_response_field').addClass('form-error');
                break;
            }
        }

        if (data.errors.length === 0) {
            flip(parentNode, pagesById['form'], pagesById['thank-you']);
            hideError();
        }

        Recaptcha.reload();
        $('#mobile-send').attr('disabled', false)
    }

    // hide pages
    pages.css('display', 'none');

    // show first page
    pages.eq(0).css('display', 'block');

});
