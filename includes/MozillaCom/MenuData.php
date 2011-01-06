<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Menu data provider
 *
 * This class contains the site menu structure and provides localized menu
 * data for the current language.
 *
 * @category  HTML
 * @package   MozillaCom
 * @author    Michael Gauthier
 * @author    Wil Clouser
 * @copyright 2005-2010 Mozilla Corporation
 * @license   http://www.mozilla.org/MPL/MPL-1.1.txt MPL Version 1.1
 */
class MozillaCom_MenuData
{
    /**
     * @var string
     */
    protected $lang;

    /**
     * @var l10n_moz
     */
    protected $l10n;

    public function __construct($lang, l10n_moz $l10n)
    {
        $this->lang = $lang;
        $this->l10n = $l10n;
    }

    public function get()
    {
        static $data = null;

        if ($data === null) {
            $data = $this->build();
            $data = $this->translate($data);
        }

        return $data;
    }

    protected function translate(array $data)
    {
        $translatedData = array();

        if (!empty($data['title'])) {
            $translatedData['title'] = $this->l10n->get($data['title']);
        }

        if (!empty($data['href'])) {
            $translatedData['href'] = $data['href'];
        }

        if (   isset($data['items'])
            && is_array($data['items'])
            && !empty($data['items'])
        ) {
            $translatedData['items'] = array();
            foreach ($data['items'] as $id => $subData) {
                $translatedData['items'][$id] = $this->translate($subData);
            }
        }

        return $translatedData;
    }

    protected function build()
    {
        return array(
            'title' => 'Home',
            'href'  => "/{$this->lang}/",
            'items' => array(

                'menu_features' => array(
                    'title' => 'Features',
                    'href'  => "/{$this->lang}/firefox/features/",
                    'items' => array(
                        'submenu_features' => array(
                            'title' => 'Features',
                            'href'  => "/{$this->lang}/firefox/features/",
                        ),
                        'submenu_security' => array(
                            'title' => 'Security',
                            'href'  => "/{$this->lang}/firefox/security/",
                        ),
                        'submenu_performance' => array(
                            'title' => 'Performance',
                            'href'  => "/{$this->lang}/firefox/performance/",
                        ),
                        'submenu_customization' => array(
                            'title' => 'Customization',
                            'href'  => "/{$this->lang}/firefox/customize/",
                        ),
                        'submenu_video' => array(
                            'title' => 'Videos',
                            'href'  => "/{$this->lang}/firefox/video/",
                        ),
                        'submenu_tour' => array(
                            'title' => 'Tour',
                            'href'  => "/{$this->lang}/firefox/central/",
                        ),
                    ),
                ),

                'menu_mobile' => array(
                    'title' => 'Mobile',
                    'href'  => "/{$this->lang}/mobile/",
                    'items' => array(
                        'submenu_mobile_overview' => array(
                            'title' => 'Mobile Overview',
                            'href'  => "/{$this->lang}/mobile/",
                        ),
                        'submenu_mobile_download' => array(
                            'title' => 'Download',
                            'href'  => "/{$this->lang}/mobile/download/",
                        ),
                        'submenu_mobile_features' => array(
                            'title' => 'Features',
                            'href'  => "/{$this->lang}/mobile/features/",
                        ),
                        'submenu_mobile_customize' => array(
                            'title' => 'Customize',
                            'href'  => "https://addons.mozilla.org/{$this->lang}/mobile/?browse=featured",
                        ),
                        'submenu_mobile_sync' => array(
                            'title' => 'Sync',
                            'href'  => "/{$this->lang}/mobile/sync/",
                        ),
                        'submenu_mobile_develop' => array(
                            'title' => 'Develop',
                            'href'  => "https://developer.mozilla.org/{$this->lang}/mobile",
                        ),
                        'submenu_mobile_getinvolved' => array(
                            'title' => 'Get Involved',
                            'href'  => "/{$this->lang}/mobile/getinvolved/",
                        ),
                        'submenu_mobile_faq' => array(
                            'title' => 'FAQ',
                            'href'  => "/{$this->lang}/mobile/faq/",
                        ),
                        'submenu_mobile_blog' => array(
                            'title' => 'Blog',
                            'href'  => "https://blog.mozilla.com/mobile/",
                        ),
                    )
                ),

                'menu_addons' => array(
                    'title' => 'Add-ons',
                    'href'  => 'https://addons.mozilla.org/',
                    'items' => array(
                        'submenu_addons_all' => array(
                            'title' => 'Firefox Add-ons',
                            'href'  => "https://addons.mozilla.org/firefox/",
                        ),
                        'submenu_addons_featured' => array(
                            'title' => 'Featured Add-ons',
                            'href'  => "https://addons.mozilla.org/firefox/featured/",
                        ),
                        'submenu_addons_extensions' => array(
                            'title' => 'Extensions',
                            'href'  => "https://addons.mozilla.org/firefox/extensions/",
                        ),
                        'submenu_addons_themes' => array(
                            'title' => 'Themes',
                            'href'  => "https://addons.mozilla.org/firefox/themes/",
                        ),
                        'submenu_addons_personas' => array(
                            'title' => 'Personas',
                            'href'  => "http://www.getpersonas.com/",
                        ),
                        'submenu_addons_searchtools' => array(
                            'title' => 'Search Tools',
                            'href'  => "https://addons.mozilla.org/firefox/search-tools/",
                        ),
                        'submenu_addons_language' => array(
                            'title' => 'Language Support',
                            'href'  => "https://addons.mozilla.org/firefox/language-tools/",
                        ),
                        'submenu_addons_collections' => array(
                            'title' => 'Collections',
                            'href'  => "https://addons.mozilla.org/firefox/collections/",
                        ),
                        'submenu_addons_mobile' => array(
                            'title' => 'Mobile Add-ons',
                            'href'  => "https://addons.mozilla.org/mobile/",
                        ),
                        'submenu_addons_developers' => array(
                            'title' => 'Developer Hub',
                            'href'  => "https://addons.mozilla.org/firefox/developers/",
                        ),
                    ),
                ),

                'menu_support' => array(
                    'title' => 'Support',
                    'href'  => "http://support.mozilla.com/",
                    'items' => array(
                        'submenu_support_kb' => array(
                            'title' => 'Firefox Support',
                            'href'  => "http://support.mozilla.com/{$this->lang}/kb/",
                        ),
                        'submenu_support_mobile' => array(
                            'title' => 'Mobile Support',
                            'href'  => "http://support.mozilla.com/mobile",
                        ),
                        'submenu_support_thunderbird' => array(
                            'title' => 'Thunderbird Support',
                            'href'  => "http://www.mozilla.org/support/thunderbird/",
                        ),
                    ),
                ),

                'menu_about' => array(
                    'title' => 'About',
                    'href'  => "/{$this->lang}/about/",
                    'items' => array(
                        'submenu_about_firefox' => array(
                            'title' => 'About Firefox',
                            'href'  => "/{$this->lang}/about/",
                        ),
                        'submenu_about_participate' => array(
                            'title' => 'Participate',
                            'href'  => "/{$this->lang}/about/participate/",
                        ),
                        'submenu_press' => array(
                            'title' => 'Press Center',
                            'href'  => "/{$this->lang}/press/",
                        ),
                        'submenu_careers' => array(
                            'title' => 'Careers',
                            'href'  => "/{$this->lang}/about/careers.html",
                        ),
                        'submenu_partnerships' => array(
                            'title' => 'Partnerships',
                            'href'  => "/{$this->lang}/about/partnerships.html",
                        ),
                        'submenu_legal' => array(
                            'title' => 'Legal',
                            'href'  => "/{$this->lang}/about/legal.html",
                        ),
                        'submenu_contact' => array(
                            'title' => 'Contact Us',
                            'href'  => "/{$this->lang}/about/contact.html",
                        ),
                        'submenu_blog' => array(
                            'title' => 'Blog',
                            'href'  => "http://blog.mozilla.com/",
                        ),
                    ),
                ),

            ),
        );
    }
}
