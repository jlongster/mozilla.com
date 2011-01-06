import json
import unittest

from selenium import selenium

import settings


selenium_config = {
    'server': 'qa-selenium.mv.mozilla.com',
    'port': 4444,
    'browsers': {
        "default": "Firefox-default;en;Linux",
        "linux": {
            "firefox": "Firefox-default;en-us;Linux"
        }, 
        "mac": {
            "chrome": "Chrome:en-us;MacOSX6", 
            "firefox": "Firefox-default;en-us;MacOSX6", 
            "firefox_35": "Firefox-3.5;en-us;MacOSX6", 
            "safari": "Safari;en-us;MacOSX6"
        }, 
        "windows": {
            "chrome": "Chrome:en-us;WinXP", 
            "firefox": "Firefox-default;en-us;WinXP", 
            "firefox_35": "Firefox-3.5;en-us;WinXP", 
            "ie_7": "IE-7;en-us;WinXP", 
            "ie_8": "IE-8;en-us;Vista"
        }
    }
}

servers = {
    'trunk': 'www-trunk.stage.mozilla.com',
    'stage': 'www.authstage.mozilla.com',
    'prod': 'www.mozilla.com',
    # aliases to www.mozilla.com
    'getfx': 'www.getfirefox.com', 
    'firefox': 'www.firefox.com',
}

languages = json.load(open('product-details/json/languages.json'))

user_agents = {
    'ie6': 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)',
    'ie7': 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)',
    'ie8': 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)',
    'fx2': 'Mozilla/5.0 (X11; U; OpenBSD i386; en-US; rv:1.8.1.14) Gecko/20080821 Firefox/2.0.0.14',
    'fx3': 'Mozilla/5.0 (Macintosh; U; PPC Mac OS X 10.5; en-US; rv:1.9.0.3) Gecko/2008092414 Firefox/3.0.3',
    'fx35': 'Mozilla/5.0 (X11; U; Linux x86_64; it; rv:1.9.1.9) Gecko/20100330 Fedora/3.5.9-2.fc12 Firefox/3.5.9',
    'fx36': 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.6; en-US; rv:1.9.2.9) Gecko/20100824 Firefox/3.6.9',
    'fx4': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:2.0b6) Gecko/20100101 Firefox/4.0b6',
    'safari': 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_4; en-us) AppleWebKit/533.17.8 (KHTML, like Gecko) Version/5.0.1 Safari/533.17.8',
    'chrome': 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_4; en-US) AppleWebKit/534.3 (KHTML, like Gecko) Chrome/6.0.472.59 Safari/534.3',
    'opera': 'Opera/9.80 (Windows NT 6.1; U; en) Presto/2.5.24 Version/10.54',
}


def url(path='', locale='en-US', protocol='http', domain=settings.target):

    if locale:
        return "%s://%s/%s/%s" % (protocol, domain, locale, path) 
    else:
        return "%s://%s/%s" % (protocol, domain, path) 


class TestCase(unittest.TestCase):

    def setUp(self):
        self.errors = []
        self.selenium = selenium(selenium_config['server'], selenium_config['port'], 
                                 selenium_config['browsers']['default'], url())
