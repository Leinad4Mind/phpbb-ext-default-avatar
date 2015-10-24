<?php namespace alfredoramos\defaultavatar\migrations;

/**
 * @package Default Avatar - phpBB Extension
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright (c) 2015 Alfredo Ramos
 * @license GNU GPL 2.0 <https://www.gnu.org/licenses/gpl-2.0.txt>
 */

class m1_default_avatar_data extends \phpbb\db\migration\migration {
	
	public function effectively_installed() {
		return isset($this->config['default_avatar_type']);
	}
	/**
	 * Install BBCode data
	 * @return array
	 */
	public function update_data() {
		$defaultavatar = \alfredoramos\defaultavatar\includes\defaultavatar::instance();
		
		return [
			[
				'config.add',
				['default_avatar_type', 'style']
			],
			[
				'config.add',
				['default_avatar_driver', 'avatar.driver.remote']
			],
			[
				'config.add',
				['default_avatar_image', '']
			],
			[
				'config.add',
				['default_avatar_image_female', '']
			],
			[
				'config.add',
				['default_avatar_image_male', '']
			],
			[
				'config.add',
				['default_avatar_width', $this->config['avatar_max_width']]
			],
			[
				'config.add',
				['default_avatar_height', $this->config['avatar_max_height']]
			],
			[
				'config.add',
				['default_avatar_by_gender', false]
			],
			[
				'config.add',
				['default_avatar_image_extensions', 'jpg,png']
			],
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
	
	/**
	 * Uninstall BBCode data
	 * @return array
	 */
	public function revert_data() {
		return [
			[
				'config.remove',
				[
					'default_avatar_type',
					'default_avatar_driver',
					'default_avatar_image',
					'default_avatar_image_female',
					'default_avatar_image_male',
					'default_avatar_width',
					'default_avatar_height',
					'default_avatar_by_gender',
					'default_avatar_image_extensions'
				]
			]
		];
	}
}