import httplib2
import unittest

from pyquery import PyQuery as pq

import mobile
from . import TestCase, servers


positives = mobile.supported['stable']
negatives = mobile.unsupported['stable']


# this needs to be rewritten to accomodate the new design, and the test utility url()

#class testMobileDetection(TestCase):
#    def testDetection(self):
#        h = httplib2.Http('.cache')
#        for ua in positives:
#            resp, content = h.request(
#                "http://www-trunk.stage.mozilla.com/en-US/m/",
#                headers={ 'user-agent': ua } )
#            doc = pq(content)
#            self.assertTrue(doc("#download .button").eq(0).is_(".button"), "download button should exist for UA: %s" % ua)
#
#        for ua in negatives:
#            resp, content = h.request(
#                "http://www-trunk.stage.mozilla.com/en-US/m/",
#                headers={ 'user-agent': ua } )
#            doc = pq(content)
#            self.assertFalse(doc("#download .button").eq(0).is_(".button"), "download button should not exist for UA: %s" % ua)

#if __name__ == "__main__":
#    unittest.main()
