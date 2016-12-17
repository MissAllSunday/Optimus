<?php

/**
 * Admin-Optimus.php
 *
 * @package Optimus
 * @link http://custom.simplemachines.org/mods/index.php?mod=2659
 * @author Bugo http://dragomano.ru/mods/optimus
 * @copyright 2010-2016 Bugo
 * @license http://opensource.org/licenses/artistic-license-2.0 Artistic-2.0
 *
 * @version 1.9
 */

if (!defined('SMF'))
	die('No direct access...');

// Ohara autoload!
require_once $sourcedir .'/ohara/src/Suki/autoload.php';

use Suki\Ohara;

class Optimus extends \Suki\Ohara
{
	public $name = __CLASS__;

	public function __construct()
	{
		$this->setRegistry();
	}

	public function addAdmin(&$admin_areas)
	{
		return;
	}

	public function addBuffer(&$buffer)
	{
		return;
	}

	public function addOperations(&$dummy)
	{
		global $context, $mbname, $scripturl;

		// Canonical url fix for portal mods
		if ($this->modSetting('portalcompact'))
		{
			if (empty($context['current_board']) && empty($context['current_topic']) && !$this['data']->validate('action'))
			{
				$context['linktree'][0]['name'] = $mbname;
				$context['canonical_url'] = $this->boardUrl . '/';
			}

			if (in_array($context['current_action'], array('forum', 'community')) && (!$this->modSetting('pmx_frontmode') || $this->modSetting('sp_portal_mode')))
				$context['canonical_url'] = $scripturl . '?action=' . $context['current_action'];
		}

		// Description
		if (empty($context['current_action']))
			$context['optimus_description'] = !empty($modSettings['optimus_description']) ? $this['data']->sanitize($modSettings['optimus_description']) : '';
	}

	public function httpStatus()
	{
		global $board_info, $context;

		if ($this->setting('404Status')) || empty($board_info['error']))
			return;

		loadTemplate($this->name);

		$errorCode = $board_info['error'] == 'error' ? '404' : '403';

		header('HTTP/1.1 '. $errorCode .' Not Found');

		$context['sub_template'] = $errorCode;
		$context['page_title'] = $this->text($errorCode. 'PageTitle');
	}

	public function addSiteMap()
	{
		return;
	}
}
