<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

require_once 'helper.php';

$subMenuItems = TplArticleHelper::getSubMenuItems();
foreach ($subMenuItems as $subMenuItem)
{
	$menuItemTitle        = $subMenuItem->title;
	$generalMenuItemStyle = $subMenuItem->getParams()->get('menu-anchor_css');
	$generalMenuItemId    = $subMenuItem->getParams()->get('aliasoptions');
	$currentMenuItem      = TplArticleHelper::getMenuItemById($generalMenuItemId);
	$currentArticle       = TplArticleHelper::getArticleByMenuItem($currentMenuItem->query['id']);

	switch ($generalMenuItemStyle):
		case 'aboutUs':
			echo TplArticleHelper::renderAboutUsCard($menuItemTitle, $currentArticle->introtext, $currentMenuItem->query['id']);
			break;
		case 'projectPreview':
			echo TplArticleHelper::renderCardProject(json_decode($currentArticle->images)->image_intro, $menuItemTitle, $currentArticle->introtext, $currentMenuItem->query['id']);
			break;
		case 'moreProject':
			echo TplArticleHelper::renderMoreProject($menuItemTitle, $currentMenuItem->query['id']);
			break;
		case 'cardDesign':
			echo TplArticleHelper::renderDesignCard($menuItemTitle, $currentArticle->introtext, $currentMenuItem->query['id'], $this->item->language);
			break;
		case 'cardProduction':
			echo TplArticleHelper::renderProductionCard(json_decode($currentArticle->images)->image_intro, $menuItemTitle, $currentArticle->introtext, $currentMenuItem->query['id']);
			break;
		case 'cardContact':
			echo TplArticleHelper::renderContactInfo($this->item->language);
			break;
	endswitch;
}
?>
