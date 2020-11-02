<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// The menu class is deprecated. Use nav instead
?>

<div class="navigation--btn-wrapper">
	<button type="button" class="navigation--btn icon-navigation_button"></button>
</div>
<nav class="navigation--menu">
	<ul class="navigation--list">
		<?php foreach ($list as $menuItem)
		{
			$class = "navigation--item navigation--item-lvl$menuItem->level";

			if ($menuItem->anchor_css != '')
			{
				$class .= ' navigation--item-' . $menuItem->anchor_css;
			}

			echo "<li class='$class'>";

			switch ($menuItem->type)
			{
				case 'component':
					echo "<a href='$menuItem->route' class='navigation--link'>$menuItem->title</a>";
					break;
				case 'heading':
					echo "<p class='navigation--header' data-content='$menuItem->id' data-lvl='$menuItem->level'>
							$menuItem->title<span class='icon-pull_down'></span>
						</p>";
					break;
			};

			if ($menuItem->deeper)
			{
				echo "<ul class='navigation--container' data-header='$menuItem->id'>";
			}
			elseif ($menuItem->shallower)
			{
				echo str_repeat('</ul></li>', $menuItem->level_diff);
			}
			else
			{
				echo '</li>';
			}
		} ?>
	</ul>
</nav>