<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Menu data provider.
 */
require_once 'MozillaCom/MenuData.php';

/**
 *
 * This class is used by the per-language header and footer includes to display
 * the menus.
 *
 * @category  HTML
 * @package   MozillaCom
 * @author    Michael Gauthier
 * @author    Wil Clouser
 * @copyright 2005-2010 Mozilla Corporation
 * @license   http://www.mozilla.org/MPL/MPL-1.1.txt MPL Version 1.1
 */
class MozillaCom_Menu
{
    /**
     * @var MozillaCom_MenuData
     */
    protected $menuData = null;

    /**
     * @var array
     */
    protected $breadcrumbs = array();

    /**
     * @param array $menuData    menu data provider.
     * @param array $breadcrumbs optional. An array, of menu ids representing
     *                           the currently selected path in the menu
     *                           structure.
     */
    public function __construct(
        MozillaCom_MenuData $menuData,
        array $breadcrumbs = array()
    ) {
        $this->menuData    = $menuData;
        $this->breadcrumbs = $breadcrumbs;
    }

    /**
     * This function was created to highlight the link on the nav menu when the user is
     * viewing a page underneath it.  It keys off the breadcrumbs array to figure out
     * where it is in the site.  This is called in the per-lang header.
     *
     * The embedded <!-- and --> markers are used to hide whitespace from older
     * browsers.
     *
     * @param string $id;
     *
     * @return string the HTML text representing a header menu.
     */
    public function getMenuString($id)
    {
        $menuData = $this->menuData->get();
        $ariaEnabled = $id === 'nav-main';

        ob_start();

        echo "\n<!-- start menu #{$id} -->\n";
        echo "<div id=\"{$id}\" role=\"navigation\">\n";

        $this->displayMenuRecursive($menuData, $id, $ariaEnabled);

        echo "</div>\n";
        echo "<!-- end menu #{$id} -->\n";

        return ob_get_clean();
    }

    protected function displayMenuRecursive(
        array $menuData,
        $menuId = null,
        $ariaEnabled = true,
        $level = 0,
        $first = true,
        $last  = true
    ) {
        $current = false;
        $selected = false;

        // If top level href exists in breadcrumbs path, the menu node is
        // selected.
        if ($level === 1 && in_array($menuData['href'], $this->breadcrumbs)) {
            $selected = true;
        }

        if (!empty($menuData)) {

            if ($level > 0) {

                $liClass = array();

                if ($selected) {
                    $liClass[] = 'current';
                }

                if ($first) {
                    $liClass[] = 'first';
                }

                if ($last) {
                    $liClass[] = 'last';
                }

                $liClass = (empty($liClass)) ?
                    '' : ' class="' . implode(' ', $liClass) . '"';

                if ($ariaEnabled) {
                    if ($level === 1) {
                        $menuId = str_replace('menu_', 'nav-main-', $menuId);
                        echo "    <li id=\"{$menuId}\" {$liClass}>"
                           . "<a aria-haspopup=\"true\" "
                           . "aria-owns=\"{$menuId}-submenu\" tabindex=\"0\"";
                    } else {
                        echo "<li {$liClass}><a tabindex=\"-1\"";
                    }
                } else {
                    echo ($level === 1) ? "    <li><a" : "<li><a";
                }

                echo " href=\"{$menuData['href']}\">{$menuData['title']}</a>";

            }

            // Display submenu if it exists.
            if (   isset($menuData['items'])
                && is_array($menuData['items'])
                && !empty($menuData['items'])
            ) {
                if ($ariaEnabled) {
                    if ($level === 0) {
                        echo "  <ul role=\"menubar\">\n";
                    } else {
                        echo "<ul id=\"{$menuId}-submenu\" aria-expanded=\"false\">";
                    }
                } else {
                    echo ($level === 0) ? "  <ul>\n" : "<ul>";
                }

                $first = true;
                $last = false;
                $count = 1;
                $total = count($menuData['items']);
                foreach ($menuData['items'] as $subMenuId => $subMenuData) {

                    $last = ($total === $count);

                    $this->displayMenuRecursive(
                        $subMenuData,
                        $subMenuId,
                        $ariaEnabled,
                        $level + 1,
                        $first,
                        $last
                    );

                    if ($first) {
                        $first = false;
                    }

                    $count++;
                }

                echo ($level === 0) ? "  </ul>\n" : "</ul>";
            }

            if ($level > 0) {
                echo ($level === 1) ? "</li>\n" : "</li>";
            }
        }
    }
}
