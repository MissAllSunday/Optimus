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
	'optimus_portal_compat'      => 0,
	'optimus_forum_index'        => $smcFunc['substr']($txt['forum_index'], 7),
	'optimus_description'        => $context['forum_name'],
	'optimus_templates'          => '',
	'optimus_sitemap_topic_size' => 1,
	'optimus_meta'               => '',
	'optimus_count_code_css'     => '.copyright a>img {opacity: 0.3} .copyright a:hover>img {opacity: 1.0} #footerarea ul li.copyright {line-height: normal; padding: 0}',
	'optimus_ignored_actions'    => 'admin,bookmarks,credits,helpadmin,pm,printpage',
);

$base = array();
foreach ($newSettings as $setting => $value)
	if (!isset($modSettings[$setting]))
		$base[$setting] = $value;

updateSettings($base);

if (SMF == 'SSI')
	echo 'Database changes are complete!';