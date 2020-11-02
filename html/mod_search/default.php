<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_search
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Including fallback code for the placeholder attribute in the search field.
?>

<div class="search--button-container">
	<button class="search--button icon-searche_btn" type="button"></button>
<form action="<?php echo JRoute::_('index.php'); ?>" method="post" role="search" class="search--form search--form-disabled">
	<input type="search" name="searchword" id="search--input<?php echo $module->id ?>" placeholder="<?php echo JText::_('TPL_GUDANIINTERIOR_PLACEHOLDER_SEARCH') ?>" class="search--input">
	<button type="submit" class="search--button-action icon-searche_btn"></button>
</form>
</div>
