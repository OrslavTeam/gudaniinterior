<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_languages
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$currentLanguage = null;
$otherLanguage   = array();

foreach ($list as $item)
{
	if ($item->active)
	{
		$currentLanguage = $item;
	}
	else
	{
		array_push($otherLanguage, $item);
	}
}
?>

<div class="language--wrapper">
	<div class="language--current">
		<p class="language--current-label">
			<?php echo $currentLanguage->title_native ?>
		</p>
		<img class="language--current-symbol"
			src="<?php echo '/templates/' . JFactory::getDocument()->template . '/images/button/drop-btn.svg'; ?>"
			alt="↓" />
	</div>
	<div class="language--variables hidden">
		<?php foreach ($otherLanguage as $lang)
			echo '<a class="language--item" href="'
				. htmlspecialchars_decode(htmlspecialchars($lang->link, ENT_QUOTES, 'UTF-8'), ENT_NOQUOTES)
				. '" >'
				. $lang->title_native
				. '</a>';
		?>
	</div>
</div>
