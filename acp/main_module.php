<?php namespace alfredoramos\defaultavatar\acp;

/**
 * @package Default Avatar - phpBB Extension
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright (c) 2015 Alfredo Ramos
 * @license GNU GPL 2.0 <https://www.gnu.org/licenses/gpl-2.0.txt>
 */

class main_module {
	public $u_action;

	public function main($id, $mode) {
		global $db, $user, $auth, $template, $cache, $request;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		$user->add_lang('acp/common');
		$user->add_lang('acp/board');
		$this->tpl_name = 'acp_default_avatar_settings';
		$this->page_title = $user->lang('ACP_DEFAULT_AVATAR');
		add_form_key('alfredoramos/defaultavatar');
		
		// Helpers
		$defaultavatar = \alfredoramos\defaultavatar\includes\defaultavatar::instance();
		$avatar = [
			'type'		=> '',
			'driver'	=> '',
			'name'		=> [
				'default'	=> '',
				'female'	=> '',
				'male'		=> ''
			],
			'width'		=> 0,
			'hight'		=> 0,
			'gender'	=> 0,
			'extensions'=> '',
			'force'		=> 0
		];
		
		if ($request->is_set_post('submit')) {
			if (!check_form_key('alfredoramos/defaultavatar')) {
				trigger_error('FORM_INVALID');
			}
			
			// Avatar type
			$avatar['type'] = $request->variable('default_avatar_type', $config['default_avatar_type']);
			
			// Avatar driver
			$avatar['driver'] = sprintf('avatar.driver.%s', ($avatar['type'] === 'style') ? 'remote' : $avatar['type']);
			
			// Avatar image
			$avatar['name']['default'] = $request->variable('default_avatar_image', $config['default_avatar_image']);
			$avatar['name']['female'] = $request->variable('default_avatar_image_female', $config['default_avatar_image_female']);
			$avatar['name']['male'] = $request->variable('default_avatar_image_male', $config['default_avatar_image_male']);
			
			// Avatar width
			$avatar['width'] = $request->variable('default_avatar_width', (int) $config['default_avatar_width']);
			$avatar['width'] = ($avatar['width'] < $config['avatar_min_width']) ? $config['avatar_min_width'] : $avatar['width'];
			$avatar['width'] = ($avatar['width'] > $config['avatar_max_width']) ? $config['avatar_max_width'] : $avatar['width'];
			
			// Avatar height
			$avatar['height'] = $request->variable('default_avatar_height', (int) $config['default_avatar_height']);
			$avatar['height'] = ($avatar['height'] < $config['avatar_min_height']) ? $config['avatar_min_height'] : $avatar['height'];
			$avatar['height'] = ($avatar['height'] > $config['avatar_max_height']) ? $config['avatar_max_height'] : $avatar['height'];
			
			// Avatar by gender
			$avatar['gender'] = $request->variable('default_avatar_by_gender', $config['default_avatar_by_gender']);
			$avatar['gender'] = $defaultavatar->can_enable_gender_avatars() ? $avatar['gender'] : false;
			
			// Avatar image extensions
			$avatar['extensions'] = $request->variable('default_avatar_image_extensions', $config['default_avatar_image_extensions']);
			
			// Force default avatar
			$avatar['force'] = $request->variable('force_default_avatar', $config['force_default_avatar']);
			
			// Avatar settings
			$config->set('default_avatar_type', $avatar['type']);
			$config->set('default_avatar_driver', $avatar['driver']);
			$config->set('default_avatar_image', $avatar['name']['default']);
			$config->set('default_avatar_image_female', $avatar['name']['female']);
			$config->set('default_avatar_image_male', $avatar['name']['male']);
			$config->set('default_avatar_width', $avatar['width']);
			$config->set('default_avatar_height', $avatar['height']);
			$config->set('default_avatar_by_gender', $avatar['gender']);
			$config->set('default_avatar_image_extensions', $avatar['extensions']);
			$config->set('force_default_avatar', $avatar['force']);
			
			trigger_error($user->lang('ACP_SETTINGS_SAVED') . adm_back_link($this->u_action));
		}
		
		// Template variables
		$template->assign_vars([
			'U_ACTION'					=> $this->u_action,
			'BOARD_URL'					=> generate_board_url() . '/',
			'BOARD_STYLE_PATH'			=> $defaultavatar->get_style($user->data['user_style'])['style_path'],
			'AVATAR_TYPE_EXPLAIN'		=> vsprintf($user->lang('ACP_AVATAR_TYPE_EXPLAIN'), [
				$user->lang('ACP_AVATAR_FROM_STYLE'),
				$user->lang('ACP_AVATAR_FROM_STYLE_EXPLAIN'),
				$user->lang('ACP_LOCAL_AVATAR'),
				sprintf(
					$user->lang('ACP_LOCAL_AVATAR_EXPLAIN'),
					'./' . $config['avatar_gallery_path']
				),
				$user->lang('ACP_REMOTE_AVATAR'),
				$user->lang('ACP_REMOTE_AVATAR_EXPLAIN'),
				$user->lang('ACP_GRAVATAR_AVATAR'),
				$user->lang('ACP_GRAVATAR_AVATAR_EXPLAIN'),
			]),
			'IMAGE_EXTENSIONS_EXPLAIN'	=> vsprintf($user->lang('ACP_IMAGE_EXTENSIONS_EXPLAIN'), [
				$user->lang('ACP_AVATAR_TYPE'),
				$user->lang('ACP_AVATAR_FROM_STYLE')
			]),
			'AVATAR_IMAGE_EXPLAIN'		=> vsprintf($user->lang('ACP_AVATAR_IMAGE_EXPLAIN'), [
				$user->lang('ACP_AVATAR_IMAGE'),
				$user->lang('ACP_AVATAR_TYPE'),
				$user->lang('ACP_AVATAR_FROM_STYLE')
			]),
			'AVATAR_DIMENSIONS_EXPLAIN'	=> sprintf($user->lang('ACP_AVATAR_DIMENSIONS_EXPLAIN'), $user->lang('ACP_AVATAR_SETTINGS')),
			
			'AVATAR_TYPE'				=> $config['default_avatar_type'],
			'AVATAR_BY_GENDER'			=> $config['default_avatar_by_gender'],
			'AVATAR_EXTENSIONS'			=> $config['default_avatar_extensions'],
			'AVATAR_IMAGE'				=> $config['default_avatar_image'],
			'AVATAR_IMAGE_FEMALE'		=> $config['default_avatar_image_female'],
			'AVATAR_IMAGE_MALE'			=> $config['default_avatar_image_male'],
			'AVATAR_MIN_WIDTH'			=> $config['avatar_min_width'],
			'AVATAR_WIDTH'				=> $config['default_avatar_width'],
			'AVATAR_MAX_WIDTH'			=> $config['avatar_max_width'],
			'AVATAR_MIN_HEIGHT'			=> $config['avatar_min_height'],
			'AVATAR_HEIGHT'				=> $config['default_avatar_height'],
			'AVATAR_MAX_HEIGHT'			=> $config['avatar_max_height'],
			'FORCE_DEFAULT_AVATAR'		=> $config['force_default_avatar']
		]);
	}
}