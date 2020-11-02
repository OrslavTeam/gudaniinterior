<?php

/**
 * @package		Joomla.Site
 * @subpackage	Template.gudaniinterior
 * @copyright	Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;


/**
 * TplGudaniHelper
 *
 * @since	1.0.0
 */
class TplGudaniHelper
{
	/**
	 * Method to load style
	 *
	 * @access	public
	 * @return	void
	 * @throws	Exception
	 * @since	1.0
	 */
	static public function loadStyle()
	{
		HTMLHelper::_(
			'stylesheet',
			'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap',
			['version' => 'auto', 'relative' => true]
		);
		HTMLHelper::_('stylesheet', 'gudaniControl.css', ['version' => 'auto', 'relative' => true]);
		HTMLHelper::_('stylesheet', 'template.css', ['version' => 'auto', 'relative' => true]);
	}

	/**
	 * Method to load js
	 *
	 * @access	public
	 * @return	void
	 * @throws	Exception
	 * @since	1.0
	 */
	static public function loadJs()
	{
		HTMLHelper::_('script', 'template.js', ['version' => 'auto', 'relative' => true]);
	}

	/**
	 * Method to set metadata
	 *
	 * @access	public
	 * @return	void
	 * @throws	Exception
	 * @since	1.0
	 */
	static public function setMetadata()
	{
		$doc = Factory::getDocument();

		$doc->setHtml5(true);
		$doc->setMetadata('X-UA-Compatible', 'IE=edge', true);
		$doc->setMetadata('viewport', 'width=device-width, initial-scale=1.0');

		$title = self::getSiteName() . ' - ' . self::getSiteName();
		$doc->setTitle($title);
	}

	/**
	 * Method to get current site name
	 *
	 * @access	public
	 * @return	string
	 * @since	1.0
	 */
	static public function getSiteName()
	{
		return Factory::getConfig()->get('sitename');
	}

	/**
	 * Method to get current page name
	 *
	 * @access	public
	 * @return	string
	 * @since	1.0
	 */
	static public function getPageName()
	{
		return Factory::getDocument()->title;
	}

	/**
	 * Method to get company logo
	 *
	 * @access	public
	 * @return	mixed
	 * @since	1.0
	 */
	static public function getCompanyLogo()
	{
		$imagePath = Factory::getApplication()->getTemplate(true)->params->get('company_logo', 'defaultValue');

		return "<img src=\"$imagePath\" alt=\"\" class=\"page--logo\">";
	}

	/**
	 * Method to determine whether the current page is the Joomla! homepage
	 *
	 * @access public
	 *
	 * @return boolean
	 * @since  1.0
	 */
	static public function isHome()
	{
		// Fetch the active menu-item
		$activeMenu = Factory::getApplication()->getMenu()->getActive();

		// Return whether this active menu-item is home or not
		return (boolean) ($activeMenu) ? $activeMenu->home : false;
	}
}
