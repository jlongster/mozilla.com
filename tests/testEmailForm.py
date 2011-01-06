import urllib

import httplib2
from pyquery import PyQuery as pq
from nose.tools import eq_

from . import TestCase, url


h = httplib2.Http()


def form_data(override={}, delete=[]):
    data = {
        'email': 'foo@bar.com',
        'privacy': 'on',
        'firstname': 'firstname',
        'lastname': 'lastname',
        'country': 'us',
        'role': 'role',
        'other': 'other',
        'extra_news': 'on',
        'submit': 'submit',
    }
    data.update(override)
    for x in delete:
        del data[x]
    return data

def submit(url, data):
    body = urllib.urlencode(data)
    return h.request(url, method="POST", body=body, 
                     headers={'Content-Type': 'application/x-www-form-urlencoded'})

def has_error(url, data, error):
    resp, content = submit(url, data)
    return pq(content)('#email-form').eq(0).is_('.error-{0}'.format(error))

def field_required(url, name):
    data = form_data(delete=[name])
    eq_(has_error(url, data, name), True, '{0} should be required'.format(name))


class Base(object):
    url = None

    def test_success(self):
        resp, content = submit(self.url, form_data())
        success = pq(content)('#email-form').eq(0).is_('.success')
        eq_(success, True, 'Form submission should succeed')

    def test_email_required(self):
        field_required(self.url, 'email')

    def test_privacy_required(self):
        field_required(self.url, 'privacy')

    def test_email_validation(self):
        data = form_data({'email': 'foo'})
        eq_(has_error(self.url, data, 'email'), True, 
            'Only email addresses should validate')

    def test_email_persisted(self):
        # delete the privacy checkbox data so the form submission fails
        data = form_data(delete=['privacy'])

        r, content = submit(self.url, data)
        email_val = pq(content)('#email-form input[name=email]').val()
        eq_(email_val, data['email'])

    def test_privacy_persisted(self):
        # delete the email checkbox data so the form submission fails
        data = form_data(delete=['email'])
        
        r, content = submit(self.url, data)
        el = pq(content)('#email-form input[name=privacy]')
        eq_(el.attr.checked, 'checked')

    def test_has_submit(self):
        r, content = h.request(self.url)
        eq_(pq(content).is_('#email-form input[name=submit]'), True, 'Form should have a field named submit')

class CountryField(object):
    def test_country_persisted(self):
        # delete the privacy checkbox data so the form submission fails
        data = form_data(delete=['privacy'])

        r, content = submit(self.url, data)
        country_val = pq(content)('#email-form select[name=country] option[selected]').val()
        eq_(country_val, data['country'])

class ExtraNewsField(object):
    def test_extra_news_persisted(self):
        data = form_data(delete=['privacy'])

        r, content = submit(self.url, data)
        el = pq(content)('#email-form input[name=extra_news]')
        eq_(el.attr.checked, 'checked')
        
class TestLanding(CountryField, Base, TestCase):
    url = url('newsletter/')

class TestAboutMozilla(CountryField, Base, TestCase):
    url = url('newsletter/about_mozilla/')

class TestFirefoxBeta(ExtraNewsField, Base, TestCase):
    url = url('firefox/beta/feedback/')

class TestL10nFirefoxBeta(ExtraNewsField, Base, TestCase):
    url = url('firefox/beta/feedback/', locale='en-GB')

class TestFirstrun(CountryField, Base, TestCase):
    url = url('firefox/3.6/firstrun/')

class TestWhatsnew(CountryField, Base, TestCase):
    url = url('firefox/3.6/whatsnew/')

# coming soon
#class TestConnect(CountryField, Base, TestCase):
#    url = url('firefox/connect/')
