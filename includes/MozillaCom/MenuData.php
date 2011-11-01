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
                    'title' => 'Desktop',
                    'href'  => "/{$this->lang}/firefox/features/",
                    'items' => array(
                        'submenu_features' => array(
                            'title' => 'Features',
                            'href'  => "/{$this->lang}/firefox/features/",
                        ),
                        'submenu_customize' => array(
                            'title' => 'Customize',
                            'href'  => "/{$this->lang}/firefox/customize/",
                        ),
                        'submenu_performance' => array(
                            'title' => 'Performance',
                            'href'  => "/{$this->lang}/firefox/performance/",
                        ),
                        'submenu_technology' => array(
                            'title' => 'Technology',
                            'href'  => "/{$this->lang}/firefox/technology/",
                        ),
                        'submenu_security' => array(
                            'title' => 'Privacy &amp; Security',
                            'href'  => "/{$this->lang}/firefox/security/",
                        ),
                    ),
                ),

                'menu_mobile' => array(
                    'title' => 'Mobile',
                    'href'  => "/{$this->lang}/mobile/",
                    'items' => array(
                        'submenu_mobile_download' => array(
                            'title' => 'Download',
                            'href'  => "/{$this->lang}/mobile/",
                        ),
                        'submenu_mobile_features' => array(
                            'title' => 'Features',
                            'href'  => "/{$this->lang}/mobile/features/",
                        ),
                        'submenu_mobile_customize' => array(
                            'title' => 'Customize',
                            'href'  => "https://addons.mozilla.org/{$this->lang}/mobile/?browse=featured",
                        ),
                        'submenu_mobile_faq' => array(
                            'title' => 'FAQ',
                            'href'  => "/{$this->lang}/mobile/faq/",
                        ),
                    )
                ),

                'menu_releases' => array(
                    'title' => 'Releases',
                    'href'  => "/{$this->lang}/mobile/",
                    'items' => array(
                        'submenu_releases_download' => array(
                            'title' => 'Download',
                            'href'  => "/{$this->lang}/firefox/channel/",
                        ),
                        'submenu_releases_aurora' => array(
                            'title' => 'Firefox Aurora',
                            'href'  => "/{$this->lang}/firefox/aurora/",
                        ),
                        'submenu_releases_beta' => array(
                            'title' => 'Firefox Beta',
                            'href'  => "/{$this->lang}/firefox/beta/",
                        ),
                        'submenu_releases_firefox' => array(
                            'title' => 'Firefox',
                            'href'  => "/{$this->lang}/firefox/",
                        ),
                    )
                ),

                'menu_addons' => array(
                    'title' => 'Add-ons',
                    'href'  => 'https://addons.mozilla.org/',
                    'items' => array(
                        'submenu_addons_all' => array(
                            'title' => 'Desktop Add-ons',
                            'href'  => "https://addons.mozilla.org/firefox/",
                        ),
                        'submenu_addons_mobile' => array(
                            'title' => 'Mobile Add-ons',
                            'href'  => "https://addons.mozilla.org/mobile/",
                        ),
                        'submenu_addons_personas' => array(
                            'title' => 'Personas',
                            'href'  => "http://www.getpersonas.com/",
                        ),
                    ),
                ),

                'menu_support' => array(
                    'title' => 'Support',
                    'href'  => "http://support.mozilla.com/",
                    'items' => array(
                        'submenu_support_kb' => array(
                            'title' => 'Desktop Support',
                            'href'  => "http://support.mozilla.com/{$this->lang}/kb/",
                        ),
                        'submenu_support_mobile' => array(
                            'title' => 'Mobile Support',
                            'href'  => "http://support.mozilla.com/mobile",
                        ),
                    ),
                ),

                'menu_about' => array(
                    'title' => 'About',
                    'href'  => "/{$this->lang}/firefox/about/",
                    'items' => array(
                        'submenu_blog' => array(
                            'title' => 'Blog',
                            'href'  => "http://blog.mozilla.com/",
                        ),
                        'submenu_about_firefox' => array(
                            'title' => 'About Firefox',
                            'href'  => "/{$this->lang}/firefox/about/",
                        ),
                        'submenu_about_join' => array(
                            'title' => 'Join Mozilla',
                            'href'  => "http://www.mozilla.org/join",
                        ),
                        'submenu_about_participate' => array(
                            'title' => 'Participate',
                            'href'  => "/{$this->lang}/about/participate/",
                        ),
                        'submenu_press' => array(
                            'title' => 'Press Center',
                            'href'  => "/{$this->lang}/press/",
                        ),
                        'submenu_brand' => array(
                            'title' => 'Brand Toolkit',
                            'href'  => "/{$this->lang}/firefox/brand/",
                        ),
                        'submenu_careers' => array(
                            'title' => 'Careers',
                            'href'  => "/{$this->lang}/about/careers.html",
                        ),
                        'submenu_partnerships' => array(
                            'title' => 'Partnerships',
                            'href'  => "/{$this->lang}/about/partnerships.html",
                        ),
                        'submenu_contact' => array(
                            'title' => 'Contact Us',
                            'href'  => "/{$this->lang}/about/contact.html",
                        ),
                    ),
                ),

            ),
        );
    }
}
