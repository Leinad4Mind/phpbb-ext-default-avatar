<?php

/**
 * @package Default Avatar - phpBB Extension
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright (c) 2015 Alfredo Ramos
 * @license GNU GPL 2.0 <https://www.gnu.org/licenses/gpl-2.0.txt>
 */

namespace alfredoramos\defaultavatar\acp;

class main_module {
	public $u_action;

	public function main($id, $mode) {
		global $db, $user, $auth, $template, $cache, $request;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;
		global $phpbb_container;
		
		$defaultavatar = $phpbb_container->get('alfredoramos.defaultavatar.defaultavatar');

		$user->add_lang(['acp/common', 'acp/board']);
		$this->tpl_name = 'acp_default_avatar_settings';
		$this->page_title = $user->lang('ACP_DEFAULT_AVATAR');
		add_form_key('alfredoramos/defaultavatar');
		
		// Helpers
		$avatar = [
			'type'		=> '',
			'driver'	=> '',
			'image'		=> [
				'default'	=> '',
				'female'	=> '',
				'male'		=> ''
			],
			'width'		=> 0,
			'height'	=> 0,
			'gender'	=> false,
			'extensions'=> '',
			'force'		=> false
		];
		
		// Config values stored in a new variable
		// to cast values to their correct type
		$current = [
			'type'		=> $config['default_avatar_type'],
			'driver'	=> $config['default_avatar_driver'],
			'image'		=> [
				'default'	=> $config['default_avatar_image'],
				'female'	=> $config['default_avatar_image_female'],
				'male'		=> $config['default_avatar_image_male']
			],
			'width'		=> [
				'min'	=> (int) $config['avatar_min_width'],
				'max'	=> (int) $config['avatar_max_width'],
				'conf'	=> (int) $config['default_avatar_width']
			],
			'height'	=> [
				'min'	=> (int) $config['avatar_min_height'],
				'max'	=> (int) $config['avatar_max_height'],
				'conf'	=> (int) $config['default_avatar_height']
			],
			'gender'	=> (bool) $config['default_avatar_by_gender'],
			'extensions'=> $config['default_avatar_extensions'],
			'force'		=> (bool) $config['force_default_avatar']
		];
		
		if ($request->is_set_post('submit')) {
			if (!check_form_key('alfredoramos/defaultavatar')) {
				trigger_error('FORM_INVALID');
			}
			
			// Avatar type
			$avatar['type'] = $request->variable('default_avatar_type', $current['type']);
			$avatar['type'] = in_array($avatar['type'], ['style', 'local', 'remote', 'gravatar']) ? $avatar['type'] : 'style';
			
			// Avatar driver
			$avatar['driver'] = sprintf('avatar.driver.%s', ($avatar['type'] === 'style') ? 'remote' : $avatar['type']);
			
			// Avatar image
			$avatar['image']['default'] = $request->variable('default_avatar_image', $current['image']['default']);
			$avatar['image']['female'] = $request->variable('default_avatar_image_female', $current['image']['female']);
			$avatar['image']['male'] = $request->variable('default_avatar_image_male', $current['image']['male']);
			
			// Avatar width
			$avatar['width'] = $request->variable('default_avatar_width', $current['width']['conf']);
			$avatar['width'] = ($avatar['width'] < $current['width']['min']) ? $current['width']['min'] : $avatar['width'];
			$avatar['width'] = ($avatar['width'] > $current['width']['max']) ? $current['width']['max'] : $avatar['width'];
			
			// Avatar height
			$avatar['height'] = $request->variable('default_avatar_height', $current['height']['conf']);
			$avatar['height'] = ($avatar['height'] < $current['height']['min']) ? $current['height']['min'] : $avatar['height'];
			$avatar['height'] = ($avatar['height'] > $current['height']['max']) ? $current['height']['max'] : $avatar['height'];
			
			// Avatar by gender
			$avatar['gender'] = $request->variable('default_avatar_by_gender', $current['gender']);
			$avatar['gender'] = $defaultavatar->can_enable_gender_avatars() ? $avatar['gender'] : false;
			
			// Avatar image extensions
			$avatar['extensions'] = $request->variable('default_avatar_image_extensions', $current['extensions']);
			$avatar['extensions'] = trim($avatar['extensions'], ',');
			$avatar['extensions'] = array_map('trim', explode(',', $avatar['extensions']));
			$avatar['extensions'] = implode(',', $avatar['extensions']);
			
			// Force default avatar
			$avatar['force'] = $request->variable('force_default_avatar', $current['force']);
			
			// Avatar settings
			$config->set('default_avatar_type', $avatar['type']);
			$config->set('default_avatar_driver', $avatar['driver']);
			$config->set('default_avatar_image', $avatar['image']['default']);
			$config->set('default_avatar_image_female', $avatar['image']['female']);
			$config->set('default_avatar_image_male', $avatar['image']['male']);
			$config->set('default_avatar_width', $avatar['width']);
			$config->set('default_avatar_height', $avatar['height']);
			$config->set('default_avatar_by_gender', $avatar['gender']);
			$config->set('default_avatar_extensions', $avatar['extensions']);
			$config->set('force_default_avatar', $avatar['force']);
			
			trigger_error($user->lang('ACP_SETTINGS_SAVED') . adm_back_link($this->u_action));
		}
		
		// Template variables
		$template->assign_vars([
			'U_ACTION'					=> $this->u_action,
			'AVATAR_TYPE_EXPLAIN'		=> vsprintf($user->lang('ACP_AVATAR_TYPE_EXPLAIN'), [
				$user->lang('ACP_STYLE_AVATAR'),
				$user->lang('ACP_STYLE_AVATAR_EXPLAIN'),
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
				$user->lang('ACP_STYLE_AVATAR')
			]),
			'AVATAR_IMAGE_EXPLAIN'		=> vsprintf($user->lang('ACP_AVATAR_IMAGE_EXPLAIN'), [
				$user->lang('ACP_AVATAR_IMAGE'),
				$user->lang('ACP_AVATAR_TYPE'),
				$user->lang('ACP_STYLE_AVATAR')
			]),
			'AVATAR_DIMENSIONS_EXPLAIN'	=> sprintf($user->lang('ACP_AVATAR_DIMENSIONS_EXPLAIN'), $user->lang('ACP_AVATAR_SETTINGS')),
			
			'AVATAR_TYPE'				=> $current['type'],
			'AVATAR_BY_GENDER'			=> $current['gender'],
			'AVATAR_EXTENSIONS'			=> $current['extensions'],
			'AVATAR_IMAGE'				=> $current['image']['default'],
			'AVATAR_IMAGE_FEMALE'		=> $current['image']['female'],
			'AVATAR_IMAGE_MALE'			=> $current['image']['male'],
			'AVATAR_MIN_WIDTH'			=> $current['width']['min'],
			'AVATAR_WIDTH'				=> $current['width']['conf'],
			'AVATAR_MAX_WIDTH'			=> $current['width']['max'],
			'AVATAR_MIN_HEIGHT'			=> $current['height']['min'],
			'AVATAR_HEIGHT'				=> $current['height']['conf'],
			'AVATAR_MAX_HEIGHT'			=> $current['height']['max'],
			'FORCE_DEFAULT_AVATAR'		=> $current['force']
		]);
	}
}