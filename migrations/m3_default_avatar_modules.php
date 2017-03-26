<?php

/**
 * @package Default Avatar - phpBB Extension
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright (c) 2015 Alfredo Ramos
 * @license GNU GPL 2.0 <https://www.gnu.org/licenses/gpl-2.0.txt>
 */

namespace alfredoramos\defaultavatar\migrations;

class m3_default_avatar_modules extends \phpbb\db\migration\migration {
	
	public function update_data() {
		return [
			[
				'module.add',
				['acp', 'ACP_CAT_DOT_MODS', 'ACP_DEFAULT_AVATAR']
			],
			[
				'module.add',
				['acp', 'ACP_DEFAULT_AVATAR', [
					'module_basename'	=> '\alfredoramos\defaultavatar\acp\main_module',
					'modes'				=> ['settings']
				]]
			]
		];
	}
}