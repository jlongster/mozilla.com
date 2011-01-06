import json

def path(file):
    return 'product-details/json/firefox_{0}.json'.format(file)


history = {
    'major': json.load(open(path('history_major_releases'))),
    'stability' : json.load(open(path('history_stability_releases'))),
    'devel'     : json.load(open(path('history_development_releases'))),
}

versions_data = json.load(open(path('versions')))
versions = { 
    'primary': versions_data['LATEST_FIREFOX_VERSION'],
    'devel': versions_data['LATEST_FIREFOX_DEVEL_VERSION'],
    'older': versions_data['LATEST_FIREFOX_OLDER_VERSION'],
    'all': history['major'].keys() + history['stability'].keys() + history['devel'].keys(),
}

builds = {
    'primary': json.load(open(path('primary_builds'))),
    'beta': json.load(open(path('beta_builds'))),
}
