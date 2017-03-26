<?php

/**
 * @package Default Avatar - phpBB Extension
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright (c) 2015 Alfredo Ramos
 * @license GNU GPL 2.0 <https://www.gnu.org/licenses/gpl-2.0.txt>
 */

namespace alfredoramos\defaultavatar\migrations;

class m1_default_avatar_schema extends \phpbb\db\migration\migration {
	
	public function effectively_installed() {
		return $this->db_tools->sql_column_exists(USERS_TABLE, 'user_allow_default_avatar');
	}
	
	public function update_schema() {
		return [
			'add_columns'	=> [
				USERS_TABLE	=> [
					'user_allow_default_avatar'	=> ['BOOL', 1]
				]
			]
		];
	}
	
	public function revert_schema() {
		return [
			'drop_columns'	=> [
				USERS_TABLE	=> [
					'user_allow_default_avatar'
				]
			]
		];
	}
	
}