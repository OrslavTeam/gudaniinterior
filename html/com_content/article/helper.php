<?php defined('_JEXEC') or die;

use Joomla\CMS\Categories\Categories;
use Joomla\CMS\Menu\MenuItem;

JModelLegacy::addIncludePath(JPATH_SITE . '/components/com_contact/models', 'ContactModel');

/**
 * @package        Joomla.Article
 * @subpackage     Template.gudaniinterior.article
 * @copyright      Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license        GNU General Public License version 2 or later; see LICENSE.txt
 * @since          1.0.0
 */
class TplArticleHelper
{
	/**
	 * Method to get sub menu items
	 *
	 * @access    public
	 * @return    mixed
	 * @throws    Exception
	 * @since     1.0
	 */
	static public function getSubMenuItems()
	{
		$menuItems     = JFactory::getApplication()->getMenu();
		$currentMenuId = $menuItems->getActive()->id;

		return $menuItems->getItems('parent_id', $currentMenuId);
	}

	/**
	 * Method to get menu item by id
	 *
	 * @access    public
	 *
	 * @param   string  $id  //menu item id
	 *
	 * @return    mixed
	 * @since     1.0
	 * @throws Exception
	 */
	static public function getMenuItemById($id)
	{
		$menuItems = JFactory::getApplication()->getMenu();

		return $menuItems->getItems('id', $id)[0];
	}

	/**
	 * Method to get article by menu item
	 *
	 * @access  public
	 *
	 * @param   MenuItem  $menuItem
	 *
	 * @return  mixed
	 * @throws  Exception
	 *
	 * @since   1.0
	 */
	static public function getArticleByMenuItem($menuItem)
	{

		return JControllerLegacy::getInstance('Content')->getModel('Article')->getItem($menuItem);
	}

	/**
	 * Method to render article preview About us block
	 *
	 * @access  public
	 *
	 * @param   string  $header
	 * @param   string  $description
	 * @param   string  $linkId
	 *
	 * @return  string
	 * @throws  Exception
	 *
	 * @since   1.0
	 */
	static public function renderAboutUsCard($header, $description, $linkId)
	{
		return "
		<div class='card--container'>
			<div class='card--content card--content-big'>
				<h2 class='card--header card--header-big'>$header</h2>
				<div class='card--description'>$description</div>
				<div class='card--link'>
					<a href='index.php?Itemid=$linkId'>" . JText::_('TPL_GUDANIINTERIOR_CONTROL_LINK_DETAIL') . "</a>
				</div>
			</div>
		</div>
		";
	}

	/**
	 * Method to render article preview project block
	 *
	 * @access  public
	 *
	 * @param   string  $previewPath  //Image preview path
	 * @param   string  $header       //Header article
	 * @param   string  $description  //Text
	 * @param   string  $linkId
	 *
	 * @return  string
	 * @throws  Exception
	 *
	 * @since   1.0
	 */
	static public function renderCardProject($previewPath, $header, $description, $linkId)
	{
		return "
		<div class='card--container'>
			<div class='card'>
				<div class='card--preview'>
					<img src='$previewPath' alt=''>
				</div>
				<div class='card--content card--content-small'>
					<h2 class='card--header card--header-small'>$header</h2>
					<div class='card--description card--description-center'>$description</div>
					<div class='card--link'>
						<a href='index.php?Itemid=$linkId'>" . JText::_('TPL_GUDANIINTERIOR_CONTROL_GO_TO_PROJECT') . "</a>
					</div>
				</div>
			</div>
		</div>
		";
	}

	/**
	 * Method to render project more project
	 *
	 * @access  public
	 *
	 * @param   string  $header  //Header article
	 * @param   string  $linkId
	 *
	 * @return  string
	 * @throws  Exception
	 *
	 * @since   1.0
	 */
	static public function renderMoreProject($header, $linkId)
	{
		return "
		<div class='container-fluid'>
			<div id='moreProject' class='container'>
				<h2>$header</h2>
				<div class='card--link'>
					<a href='index.php?Itemid=$linkId'>" . JText::_('TPL_GUDANIINTERIOR_CONTROL_GO_TO_PROJECT') . "</a>
				</div>
			</div>
		</div>
		";
	}

	/**
	 * Method to render design block
	 *
	 * @access  public
	 *
	 * @param   string  $header       //Header article
	 * @param   string  $description  //Text
	 * @param   string  $linkId
	 * @param   string  $language     //Current language
	 *
	 * @return  string
	 * @throws  Exception
	 *
	 * @since   1.0
	 */
	static public function renderDesignCard($header, $description, $linkId, $language)
	{
		$result = "
		<div class='card--container card--container-gray'>
			<div class='card--content card--content-big'>
				<h2 class='card--header card--header-big'>$header</h2>
				<div class='card--description'>$description</div>
				<div class='card--link'>
					<a href='index.php?Itemid=$linkId'>" . JText::_('TPL_GUDANIINTERIOR_CONTROL_LINK_DETAIL') . "</a>
				</div>
		";

		$categories    = Categories::getInstance('contact');
		$categoryNodes = $categories->get()->getChildren();

		$designCategoryId = 0;

		foreach ($categoryNodes as $categoryNode)
		{
			if ($categoryNode->alias === 'designers' && $categoryNode->language === $language)
				$designCategoryId = $categoryNode->id;
		}

		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
			->select($db->quoteName(array('name', 'image', 'webpage', 'sortname1')))
			->from($db->quoteName('#__contact_details'))
			->where($db->quoteName('catid') . ' = ' . $designCategoryId)
			->order('sortname1');
		$db->setQuery($query);
		$contacts = $db->loadObjectList();

		$result .= '<div class="card--designers-wrapper">';
		foreach ($contacts as $contact)
		{
			$result .= '<div class="designer">';
			$result .= "<div class='designer--photo'><img src='$contact->image' alt=''></div>";
			$result .= "
					<div class='designer--info'>
						<p>$contact->name</p>
						<a href='$contact->webpage'>" . JText::_('TPL_GUDANIINTERIOR_CONTROL_PORTFOLIO') . "</a>
					</div>";
			$result .= '</div>';
		}

		$result .= "</div></div></div>";

		return $result;
	}

	/**
	 * Method to render article preview card production
	 *
	 * @access  public
	 *
	 * @param   string  $previewPath  //Image preview path
	 * @param   string  $header       //Header article
	 * @param   string  $description  //Text
	 * @param   string  $linkId
	 *
	 * @return  string
	 * @throws  Exception
	 *
	 * @since   1.0
	 */
	static public function renderProductionCard($previewPath, $header, $description, $linkId)
	{
		return "
		<div class='card--container card--container-gray'>
			<div class='card--content card--content-withImage'>
				<h2 class='card--header card--header-big'>$header</h2>
				<div class='card--description'>$description</div>
				<div class='card--media'>
					<img src='$previewPath' alt=''>
				</div>
				<div class='card--link'>
					<a href='index.php?Itemid=$linkId'>" . JText::_('TPL_GUDANIINTERIOR_CONTROL_LINK_DETAIL') . "</a>
				</div>
			</div>
		</div>
		";
	}

	/* Method to render article preview card contact
	 *
	 * @access  public
	 *
	 * @param   string  $header    //Header article
	 * @param   string  $language  //Current language
	 *
	 * @return  string
	 * @throws  Exception
	 *
	 * @since   1.0
	 */
	static public function renderContactInfo($lang)
	{
		$categories    = Categories::getInstance('contact');
		$categoryNodes = $categories->get()->getChildren();

		$baseId = 0;

		foreach ($categoryNodes as $categoryNode)
		{
			if ($categoryNode->alias === 'base')
				$baseId = $categoryNode->id;
		}

		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
			->select($db->quoteName(array('id', 'email_to', 'mobile', 'language', 'catid')))
			->from($db->quoteName('#__contact_details'))
			->where($db->quoteName('catid') . ' = ' . $baseId);
		$db->setQuery($query);
		$contacts = $db->loadObjectList();
		$contact = null;

		foreach ($contacts as $item)
		{
			if ($item->language === $lang)
			{
				$contact = $item;
				break;
			}
		}

		$socialMediaQuery = $db->getQuery(true);
		$socialMediaQuery
			->select($db->quoteName(array('group.id', 'fields.title', 'fields.params', 'value.value')))
			->from($db->quoteName('#__fields_groups', 'group'))
			->join('INNER', $db->quoteName('#__fields', 'fields') . 'ON' . $db->quoteName('group.id') . ' = ' . $db->quoteName('fields.group_id'))
			->join('INNER', $db->quoteName('#__fields_values', 'value') . 'ON' . $db->quoteName('fields.id') . ' = ' . $db->quoteName('value.field_id'))
			->where($db->quoteName('group.title') . ' = "SocialMedia"')
			->where($db->quoteName('value.item_id') . ' = ' . $contact->id);
		$db->setQuery($socialMediaQuery);
		$socialMediaFields = $db->loadObjectList();

		$locationQuery = $db->getQuery(true);
		$locationQuery
			->select($db->quoteName(array('group.id', 'fields.title', 'value.value')))
			->from($db->quoteName('#__fields_groups', 'group'))
			->join('INNER', $db->quoteName('#__fields', 'fields') . 'ON' . $db->quoteName('group.id') . ' = ' . $db->quoteName('fields.group_id'))
			->join('INNER', $db->quoteName('#__fields_values', 'value') . 'ON' . $db->quoteName('fields.id') . ' = ' . $db->quoteName('value.field_id'))
			->where($db->quoteName('group.title') . ' = "contacts"')
			->where($db->quoteName('value.item_id') . ' = ' . $contact->id);
		$db->setQuery($locationQuery);
		$location = $db->loadObjectList();



		var_dump($contact);
		var_dump($socialMediaFields);
		var_dump($location);
	}
}
