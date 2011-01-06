'''
Created on March 17, 2010

@author Alex Buchanan <abuchanan@mozilla.com>

This test visits the release notes, first run and whats new pages for all locales on mozilla.com
It checks that all redirects on mozilla.com point to the correct pages and do not return 404 errors.
'''

import unittest
import urllib

import httplib2
from pyquery import PyQuery as pq

from . import TestCase, url, user_agents
import firefox
import mobile


class testRewrites(TestCase):

    def testDefaultLocaleFallback(self):
        u = url(locale='')
        r = urllib.urlopen(u)
        self.assertEqual(r.url, url(), '{0} should equal {1}'.format(r.url, url()))

    def testLatestReleasePages(self):
        locales = firefox.builds['primary'].keys()
        releases = (firefox.versions['primary'], firefox.versions['older'])

        for release in releases:
            for locale in locales:

                firstrun_url = url("firefox/%s/firstrun" % release, locale=locale)
                firstrun_res = urllib.urlopen(firstrun_url)
                assert firstrun_res.code == 200

                whatsnew_url = url("firefox/%s/whatsnew" % release, locale=locale)
                whatsnew_res = urllib.urlopen(whatsnew_url)
                assert whatsnew_res.code == 200

                releasenotes_url = url("firefox/%s/releasenotes" % release, locale=locale)
                releasenotes_res = urllib.urlopen(releasenotes_url)
                assert releasenotes_res.code == 200


    def testAliases(self):
        h = httplib2.Http()

        # firefox.com redirects to www.mozilla.com
        resp, content = h.request('http://firefox.com')
        assert 'www.mozilla.com' in resp['content-location']

        # getfirefox.com redirects to www.mozilla.com
        resp, content = h.request('http://getfirefox.com')
        assert 'www.mozilla.com' in resp['content-location']

    def testBrowserSpecificProductPage(self):
        h = httplib2.Http()
        expect = {
            'personal': ['fx36'],
            'upgrade': ['fx3', 'fx35'], 
            'firefox': ['opera', 'chrome', 'safari'],
            'ie': ['ie6', 'ie7', 'ie8'],
        }

        for dest, browsers in expect.items():
            for browser in browsers:
                headers = {'User-Agent': user_agents[browser]}
                resp, content = h.request(url('firefox?no_cache'), headers=headers)
                expected = url('firefox/%s.html' % dest)
                self.assertEqual(expected, resp['content-location'], 
                    'expected: {0}, actual: {1}, browser: {2}, resp: {3}'.format(expected, resp['content-location'], browser, resp))

    def testOutOfDate(self):
        h = httplib2.Http()
        exceptions = [firefox.versions['primary'][:3], firefox.versions['devel'][:3]]
        for v in firefox.versions['all']:
            # skip versions 1.x, they don't have firstrun/whatsnew pages
            if v[0] == '1':
                continue

            # latest versions (major and devel) shouldn't show out-of-date
            def check(content):
                doc = pq(content)
                el = 'body'
                cls = '.out-of-date'
                if v[:3] in exceptions:
                    return doc(el).eq(0).not_(cls)
                else:
                    return doc(el).eq(0).is_(cls)

            resp, content = h.request(url('firefox/%s/firstrun/' % v))
            self.assertTrue(check(content), "{0} firstrun is wrong".format(v))

            resp, content = h.request(url('firefox/%s/whatsnew' % v))
            self.assertTrue(check(content), "{0} whatsnew is wrong".format(v))

        # check that firefox/sync/firstrun.html isn't affected by this rule
        r, content = h.request(url('firefox/sync/firstrun'))
        doc = pq(content)
        self.assertTrue(doc('body').eq(0).not_('.out-of-date'), "sync firstrun page shouldn't have out-of-date")

    def testMobileDevice(self):
        """
        A supported mobile device visiting the home page
        will be redirected to the mobile landing page (i.e. mozilla.com/m)

        Android versions < 2 won't be redirected, since they're not supported.

        A mechanism exists to allow the user to view the mozilla.com landing page,
        without being redirected to the mobile landing page.  A link is provided on
        the mobile landing page, "View the full site".  This links to home page, with
        a URL parameter, "mobile_no_redirect".  This turns off the redirection, and sets
        a cookie (also named "mobile_no_redirect") to remember this preference.
        That cookie expires with the browser session.

        "Vary: User-Agent" will be added to the response headers for the home page.
        This avoids caching issues, because one UA gets content, another gets redirected,
        so we need to cache different things under the same URL.
        """

        h = httplib2.Http()
        for ua in mobile.supported['beta']:
            resp, content = h.request(url('', locale=None), headers={'User-Agent': ua})
            self.assertEqual(resp['content-location'], url('m/'))
            # don't do more than 1 redirect
            self.assertFalse(resp.previous.previous)

        # desktop browsers don't get redirected
        for ua in user_agents:
            resp, content = h.request(url('', locale=None), headers={'User-Agent': ua})
            self.assertEqual(resp['content-location'], url(''))

        # "no redirect" URL parameter
        ua = mobile.user_agents['nexusone'][0]
        resp, content = h.request(url('?mobile_no_redirect'), headers={'User-Agent': ua})
        self.assertEqual(resp['content-location'], url('?mobile_no_redirect'))

        # "no redirect" Cookie
        resp, content = h.request(url(''), headers={'Cookie': 'mobile_no_redirect=1'})
        self.assertEqual(resp['content-location'], url(''))

        # "Vary: User-Agent" header
        resp, content = h.request(url(''))
        self.assertEqual(resp['vary'], 'User-Agent')


if __name__ == "__main__":
    unittest.main()
