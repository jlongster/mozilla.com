import urllib
import unittest

import mobile
from . import TestCase


class testDownloads(TestCase):
    def testMobile(self):
        for b in mobile.builds:
            for p, u in b['download'].items():
                r = urllib.urlopen(u)
                assert r.code == 200
    

if __name__ == "__main__":
    unittest.main()
