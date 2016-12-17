<?php
/**
 * @package Ohara Optimus
 * @license http://opensource.org/licenses/artistic-license-2.0 Artistic-2.0
 */

if (file_exists(dirname(__FILE__) . '/SSI.php') && !defined('SMF'))
	require_once(dirname(__FILE__) . '/SSI.php');

else if(!defined('SMF'))
	die('<b>Error:</b> Cannot install - please verify you put this in the same place as SMF\'s index.php and SSI.php files.');

if ((SMF == 'SSI') && !$user_info['is_admin'])
	die('Admin priveleges required.');

// Prepare and insert this mod's config array.
$_config = array(
	'_availableHooks' => array(
		'buffer' => 'integrate_buffer',
		'siteMap' => 'integrate_create_topic',
		'admin' => 'integrate_admin_areas',
		'operations' => 'integrate_menu_buttons',
	),
);

// All good.
updateSettings(array('_configActivityBar' => json_encode($_config)));

// Default mod settings
$newSettings = array(
	'Optimus_portalCompat'      => 0,
	'Optimus_forumIndex'        => $smcFunc['substr']($txt['forum_index'], 7),
	'Optimus_description'        => $context['forum_name'],
	'Optimus_templates'          => '',
	'Optimus_sitemapTopicSize' => 1,
	'Optimus_meta'               => '',
	'Optimus_countCodeCss'     => '.copyright a>img {opacity: 0.3} .copyright a:hover>img {opacity: 1.0} #footerarea ul li.copyright {line-height: normal; padding: 0}',
	'Optimus_ignoredActions'    => 'admin,bookmarks,credits,helpadmin,pm,printpage,dlattach,likes,uploadAttach,viewsmfile,mlhttp,.xml,breezeajax,breezecover,breezemood',
);

$base = array();
foreach ($newSettings as $setting => $value)
	if (!isset($modSettings[$setting]))
		$base[$setting] = $value;

updateSettings($base);

if (SMF == 'SSI')
	echo 'Database changes are complete!';