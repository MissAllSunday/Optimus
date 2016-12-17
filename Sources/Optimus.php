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

}
