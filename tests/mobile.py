import itertools
import json


data = json.load(open('product-details/json/mobile_details.json'))

builds = data['builds']

user_agents = {
    "n800": [
        "Mozilla/4.0 (compatible; MSIE 6.0; X11; Linux armv6l; U) Opera 8.5 [en_US] Maemo browser 0.7.6 RX-34_2007SE_2.2006.51-6",
        "Mozilla/4.0 (compatible; MSIE 6.0; X11; Linux armv6l; U) Opera 8.5 [en_US] Tablet browser 0.0.14 RX-34_2007SE_4.2007.26-8"
    ],
    "n810": [
        "Mozilla/4.0 (compatible; MSIE 6.0; X11; Linux armv6l; U) Opera 8.5 [en_US] Tablet browser 0.0.14 RX-34_2007SE_4.2007.26-8",
        "Mozilla/5.0 (X11; U; Linux armv6l; en-US; rv:1.9a6pre) Gecko/20071018 Firefox/3.0a1 Tablet browser 0.1.24 RX-34+RX-44_2008SE_1.2007.44-4",
        "Mozilla/5.0 (X11; U; Linux armv6l; en-US; rv:1.9a6pre) Gecko/20071128 Firefox/3.0a1 Tablet browser 0.2.2 RX-34+RX-44_2008SE_2.2007.51-3",
        "Mozilla/5.0 (X11; U; Linux armv6l; en-GB; rv:1.9a6pre) Gecko/20080606 Firefox/3.0a1 Tablet browser 0.3.7 RX-34+RX-44+RX-48_DIABLO_4.2008.23-14",
        "Mozilla/5.0 (X11; U; Linux armv6l; es-ES; rv:1.9a6pre) Gecko/20080828 Firefox/3.0a1 Tablet browser 0.3.7 RX-34+RX-44+RX-48_DIABLO_5.2008.43-7"
    ],
    "n900": [
        "Mozilla/5.0 (X11; U; Linux armv7l; en-US; rv:1.9.2a1pre) Gecko/20091116 Firefox/3.5 Maemo Browser 1.5.6 RX-51 N900",
    ],
    "nexusone": [
        "Mozilla/5.0 (Linux; U; Android 2.1-update1; en-US; Nexus One Build/ERE27) AppleWebkit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17",
    ],
    "g1": [
        "Mozilla/5.0 (Linux; U; Android 1.1; en-gb; dream) AppleWebKit/525.10+ (KHTML, like Gecko) Version/3.0.4 Mobile Safari/523.12.2",
    ],
    "android-0.5": [
        "Mozilla/5.0 (Linux; U; Android 0.5; en-us) AppleWebKit/522+ (KHTML, like Gecko) Safari/419.3",
    ],
    "iphone": [
        "Mozilla/5.0 (iPhone; U; CPU iPhone OS 3_0 like Mac OS X; en-us) AppleWebKit/420.1 (KHTML, like Gecko) Version/3.0 Mobile/1A542a Safari/419.3"
    ]
}


# converts a list of devices (e.g. 'n900') to a list of user agents
devices_to_UAs = lambda *x: itertools.chain(*[ user_agents[y] for y in x])
supported = {
    "stable": devices_to_UAs('n900', 'n810'),
    "beta": devices_to_UAs('n900', 'nexusone')
}

unsupported = {
    "stable": devices_to_UAs('n800', 'g1', 'android-0.5', 'iphone'),
    "beta": devices_to_UAs('n800', 'n810', 'g1', 'android-0.5', 'iphone')
}
