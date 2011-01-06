<?php

        $dynamic_top_menu_array = array();
        $breadcrumbs = !isset($breadcrumbs) ? array() : $breadcrumbs;

        if (is_array($GLOBALS['__l10n_moz'])) {
            $dynamic_top_menu_array = array (
                'id'    => 'nav-main',
                'items' => array(
                    "{$GLOBALS['__l10n_moz']['Products']}" => array(
                        'id'      => 'menu_products',
                        'href'    => "/{$lang}/products/",
                        'submenu' => array(
                            'items' => array(
                                'Firefox' => array(
                                    'id'      => 'submenu_firefox',
			                        'href'    => "/{$lang}/products/firefox/",
                                ),
                                'Firefox Móvel' => array(
                                    'id'      => 'submenu_mobile',
			                        'href'    => "/{$lang}/mobile/",
                                ),
                                'Thunderbird' => array(
                                    'id'      => 'submenu_thunderbird',
			                        'href'    => "/{$lang}/products/thunderbird/",
                                )
                            )
                        )
                    ),
                    "{$GLOBALS['__l10n_moz']['Add-ons']}" => array(
                        'id'      => 'menu_addons',
                        'href'    => 'https://addons.mozilla.org/',
                        'submenu' => array(
                            'items' => array(
                                'Todos os complementos' => array(
                                    'id'      => 'submenu_addons_all',
			                        'href'    => "https://addons.mozilla.org/firefox/",
                                ),
                                'Complementos móveis' => array(
                                    'id'      => 'submenu_addons_mobile',
			                        'href'    => "https://addons.mozilla.org/mobile/",
                                ),
                                'Recomendados' => array(
                                    'id'      => 'submenu_addons_recommended',
			                        'href'    => "https://addons.mozilla.org/firefox/recommended",
                                ),
                                'Populares' => array(
                                    'id'      => 'submenu_addons_popular',
			                        'href'    => "https://addons.mozilla.org/firefox/browse/type:1/cat:all?sort=popular",
                                ),
                                'Temas' => array(
                                    'id'      => 'submenu_addons_themes',
			                        'href'    => "https://addons.mozilla.org/firefox/browse/type:2",
                                ),
                                'Ferramentas de busca' => array(
                                    'id'      => 'submenu_addons_search',
			                        'href'    => "https://addons.mozilla.org/firefox/browse/type:4",
                                ),
                                'Plugins' => array(
                                    'id'      => 'submenu_addons_plugins',
			                        'href'    => "https://addons.mozilla.org/firefox/browse/type:7",
                                )
                            )
                        )
                    ),
                    "{$GLOBALS['__l10n_moz']['Support']}"    => array(
                        'id'      => 'menu_support',
                        'href'    => "http://support.mozilla.com/",
                        'submenu' => array(
							'items' => array(
								'Suporte do Firefox' => array(
									'id'      => 'submenu_support_kb',
									'href'    => "http://support.mozilla.com/{$lang}/kb/",
								),
								'Suporte do Firefox Móvel' => array(
									'id'      => 'submenu_support_mobile',
									'href'    => "http://mobile.support.mozilla.com/",
								),
								'Suporte do Thunderbird' => array(
									'id'      => 'submenu_support_thunderbird',
									'href'    => "http://www.mozilla.org/support/thunderbird/",
								)
							)
						)
                    ),
                    "{$GLOBALS['__l10n_moz']['Community']}" => array(
                        'id'      => 'menu_community',
                        'href'    => "/{$lang}/manyfaces/",
                        'submenu' => array(
                            'items' => array(
                                'Complementos' => array(
                                    'id'      => 'submenu_community_addons',
			                        'href'    => "http://addons.mozilla.org/",
                                ),
                                'Bugzilla' => array(
                                    'id'      => 'submenu_community_bugzilla',
			                        'href'    => "https://bugzilla.mozilla.org/",
                                ),
                                'Mozilla Developer Center' => array(
                                    'id'      => 'submenu_community_devmo',
			                        'href'    => "http://developer.mozilla.org/pt/",
                                ),
                                'Mozilla Labs' => array(
                                    'id'      => 'submenu_community_labs',
			                        'href'    => "http://labs.mozilla.com/",
                                ),
                                'Mozilla Messaging' => array(
                                    'id'      => 'submenu_community_mozillamessaging',
			                        'href'    => "http://www.mozillamessaging.com/",
                                ),
                                'Mozilla.org' => array(
                                    'id'      => 'submenu_community_mozillaorg',
			                        'href'    => "http://www.mozilla.org/",
                                ),
                                'MozillaZine' => array(
                                    'id'      => 'submenu_community_mozillazine',
			                        'href'    => "http://www.mozillazine.org/",
                                ),
                                'Planet Mozilla' => array(
                                    'id'      => 'submenu_community_planet',
			                        'href'    => "http://planet.mozilla.org/",
                                ),
                                'Planeta Moz/BR' => array(
                                    'id'      => 'submenu_community_planet',
			                        'href'    => "http://planeta.mozillabrasil.org/",
                                ),
                                'QMO' => array(
                                    'id'      => 'submenu_community_qmo',
			                        'href'    => "http://quality.mozilla.org/",
                                ),
                                'Spread Firefox' => array(
                                    'id'      => 'submenu_community_spreadfirefox',
			                        'href'    => "http://www.spreadfirefox.com/",
                                ),
                                'Suporte' => array(
                                    'id'      => 'submenu_community_support',
			                        'href'    => "http://support.mozilla.com/{$lang}/",
                                )
                            )
                        )
                    ),
                    "{$GLOBALS['__l10n_moz']['About']}"      => array(
                        'id'      => 'menu_aboutus',
                        'href'    => "/{$lang}/about/",
                        'submenu' => array(
                            'items' => array(
                                'O que é a Mozilla?' => array(
                                    'id'      => 'submenu_about',
			                        'href'    => "/{$lang}/about/whatismozilla.html",
                                ),
                                'Envolva-se' => array(
                                    'id'      => 'submenu_getinvolved',
			                        'href'    => "/{$lang}/about/get-involved.html",
                                ),
                                'Área de Imprensa' => array(
                                    'id'      => 'submenu_press',
			                        'href'    => "/{$lang}/press/",
                                ),
                                'Carreiras' => array(
                                    'id'      => 'submenu_careers',
			                        'href'    => "/{$lang}/about/careers.html",
                                ),
                                'Parcerias' => array(
                                    'id'      => 'submenu_partnerships',
			                        'href'    => "/{$lang}/about/partnerships.html",
                                ),
                                'Licenças' => array(
                                    'id'      => 'submenu_licensing',
			                        'href'    => "http://www.mozilla.org/foundation/licensing.html",
                                ),
                                'Blog' => array(
                                    'id'      => 'submenu_blog',
			                        'href'    => "http://blog.mozilla.com/brasil",
                                ),
                                'Loja da Comunidade' => array(
                                    'id'      => 'submenu_community_store',
			                        'href'    => "http://communitystore.mozilla.org/",
                                ),
                                'Guia de Logotipos' => array(
                                    'id'      => 'submenu_logo',
			                        'href'    => "/{$lang}/about/logo/",
                                ),
                                'Entre em contato' => array(
                                    'id'      => 'submenu_contact',
			                        'href'    => "/{$lang}/about/contact.html",
                                )
                            )
                        )
                    )
                )
            );
        }

        $dynamic_top_menu = buildDynamicTopMenuString($dynamic_top_menu_array, $breadcrumbs);

        // Include the global header.  All locales will include this.
        require "{$config['file_root']}/includes/header.inc.php";

        // Built dynamically in the global header now, to provide consistency across
        // pages.
        echo $dynamic_header;

        unset($dynamic_header);

        unset($dynamic_top_menu);

?>
