<?php

/**
 * @category    File
 * @package     Joomla.Site
 * @subpackage  Template.gudaniinterior
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * @var JDocumentHtml $this
 */

defined('_JEXEC') or die;

require_once JPATH_THEMES . '/' . $this->template . '/helper.php';

TplGudaniHelper::loadStyle();
TplGudaniHelper::setMetadata();
TplGudaniHelper::loadJs();

?>

<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction ?>">

<head>
	<jdoc:include type="head" />
</head>

<body>
<header class="page--header">
	<div class="page--header-wrapper">
		<a href="/" class="page--logo-wrapper">
			<?php echo TplGudaniHelper::getCompanyLogo(); ?>
		</a>
		<jdoc:include type="modules" name="position-0" />
		<jdoc:include type="modules" name="position-2" />
		<jdoc:include type="modules" name="position-3" />
	</div>
</header>
<main>

	<?php if (TplGudaniHelper::isHome()) : ?>
		<div class="home--slider">
			<jdoc:include type="modules" name="position-4" />
			<div class="company-info">
				<h1 class="company-info--name"><?php echo $this->params->get("company_name") ?></h1>
				<p class="company-info--slogan"><?php echo JText::_('TPL_GUDANIINTERIOR_TEXT_COMPANY_SLOGAN') ?></p>
				<a href="index.php?Itemid=103" class="company-info--project-link"><?php echo JText::_('TPL_GUDANIINTERIOR_TEXT_OUR_PROJECT') ?></a>
			</div>
		</div>
	<?php endif; ?>

	<jdoc:include type="component" />

</main>
</body>

</html>