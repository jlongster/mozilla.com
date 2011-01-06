<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Menu data provider.
 */
require_once 'MozillaCom/MenuData.php';

/**
 * Displays page breadcrumbs
 *
 * @category  HTML
 * @package   MozillaCom
 * @author    Michael Gauthier
 * @copyright 2005-present Mozilla Corporation
 * @license   http://www.mozilla.org/MPL/MPL-1.1.txt MPL Version 1.1
 */
class MozillaCom_Breadcrumb
{
    /**
     * @var l10n_moz
     */
    protected $l10n;

    /**
     * @var string
     */
    protected $lang;

    /**
     * @var array
     */
    protected $breadcrumbs = array();

    /**
     * @param l10n_moz $l10n        object used for translating strings.
     * @param string   $lang        current langauge.
     * @param array    $breadcrumbs An array, of breadcrumbs using the following
     *                              structure:
     *                              <code>
     *                              <?php
     *                              array(
     *                                  'Title'         => '/href/',
     *                                  'Another Title' => '/href/subpage',
     *                              );
     *                              ?>
     *                              </code>
     */
    public function __construct($lang, l10n_moz $l10n, array $breadcrumbs)
    {
        $this->l10n        = $l10n;
        $this->lang        = $lang;
        $this->breadcrumbs = $breadcrumbs;
    }

    /**
     *
     * @param string $id;
     *
     * @return string the HTML text representing a breadcrumbs nav.
     */
    public function getBreadcrumbString($id)
    {
        if (empty($this->breadcrumbs)) {
            return '';
        }

        ob_start();

        echo "\n<!-- start breadcrumbs #{$id} -->\n";
        echo "<p id=\"{$id}\">";

        // Home link
        $home_title = $this->l10n->get('Home');
        echo "<a href=\"/{$this->lang}/\" class=\"home\">"
            . "{$home_title}</a> <b>»</b> \n";

        $count = 1;
        foreach ($this->breadcrumbs as $title => $href) {

            if ($count === count($this->breadcrumbs)) {
                // don't link last entry
                echo "<span>{$title}</span>\n";
            } else {
                echo "<a href=\"{$href}\">{$title}</a> <b>»</b> \n";
            }

            $count++;
        }

        echo "</p>\n";
        echo "<!-- end breadcrumbs #{$id} -->\n";

        return ob_get_clean();
    }
}

?>
