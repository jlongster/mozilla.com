<?php

$breadcrumbs = empty($breadcrumbs) ? array() : $breadcrumbs;

require_once "{$config['file_root']}/includes/MozillaCom/Menu.php";
require_once "{$config['file_root']}/includes/MozillaCom/Breadcrumb.php";

$GLOBALS['menu_data']  = new MozillaCom_MenuData($lang, $l10n);
$GLOBALS['menu']       = new MozillaCom_Menu($GLOBALS['menu_data'], $breadcrumbs);
$GLOBALS['breadcrumb'] = new MozillaCom_Breadcrumb($lang, $l10n, $breadcrumbs);

$dynamic_top_menu   = $GLOBALS['menu']->getMenuString('nav-main');
$dynamic_breadcrumb = $GLOBALS['breadcrumb']->getBreadcrumbString('breadcrumbs');

// Include the global header.  All locales will include this.
require "{$config['file_root']}/includes/header.inc.php";

// Built dynamically in the global header now, to provide consistency across
// pages.
echo $dynamic_header;

unset($dynamic_header);
unset($dynamic_top_menu);
unset($dynamic_breadcrumb);

?>
