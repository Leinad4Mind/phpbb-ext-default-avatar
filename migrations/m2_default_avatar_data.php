<?php

/**
 * @package Default Avatar - phpBB Extension
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright (c) 2015 Alfredo Ramos
 * @license GNU GPL 2.0 <https://www.gnu.org/licenses/gpl-2.0.txt>
 */

namespace alfredoramos\defaultavatar\migrations;

class m2_default_avatar_data extends \phpbb\db\migration\migration {
	
	public function effectively_installed() {
		return isset($this->config['default_avatar_type']);
	}
	
	public function update_data() {
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
				['default_avatar_by_gender', 0]
			],
			[
				'config.add',
				['default_avatar_extensions', 'gif,jpg,png']
			],
			[
				'config.add',
				['force_default_avatar', 0]
			]
		];
	}
	
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
					'default_avatar_extensions',
					'force_default_avatar'
				]
			]
		];
	}
	
}