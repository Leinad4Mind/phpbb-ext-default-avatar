<?php

/**
 * @package Default Avatar - phpBB Extension
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright (c) 2015 Alfredo Ramos
 * @license GNU GPL 2.0 <https://www.gnu.org/licenses/gpl-2.0.txt>
 */

namespace alfredoramos\defaultavatar;

/**
 * @ignore
 */
class ext extends \phpbb\extension\base {
	
	const PHPBB_VERSION = '3.1.6-RC1';
	
	public function is_enableable() {
		$config = $this->container->get('config');
		return phpbb_version_compare($config['version'], self::PHPBB_VERSION, '>=');
	}
	
}