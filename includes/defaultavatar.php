<?php

/**
 * @package Default Avatar - phpBB Extension
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright (c) 2015 Alfredo Ramos
 * @license GNU GPL 2.0 <https://www.gnu.org/licenses/gpl-2.0.txt>
 */

namespace alfredoramos\defaultavatar\includes;

class defaultavatar {
	
	/** @var \phpbb\db\driver\factory */
	protected $db;
	
	/** @var \phpbb\db\tools */
	protected $db_tools;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\template\template */
	protected $template;
	
	/** @var \phpbb\config\config */
	protected $config;

	/** @var string */
	protected $root_path;

	/** @var string */
	protected $php_ext;
	
	public function __construct(
		\phpbb\db\driver\factory $db,
		\phpbb\db\tools $db_tools,
		\phpbb\user $user,
		\phpbb\template\template $template,
		\phpbb\config\config $config,
		$root_path,
		$php_ext
	) {
		$this->db = $db;
		$this->db_tools = $db_tools;
		$this->user = $user;
		$this->template = $template;
		$this->config = $config;
		$this->root_path = $root_path;
		$this->php_ext = $php_ext;
	}
	
	/**
	 * Get style by ID
	 * @param	integer		$style_id	Style ID
	 * @return	array|bool
	 */
	public function get_style($style_id = 0) {
		$sql = 'SELECT *
				FROM ' . STYLES_TABLE . '
				WHERE style_id = ' . (int) $style_id;
		$result = $this->db->sql_query($sql);
		$style = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);
		
		return $style;
	}
	
	/**
	 * Get user's style
	 * @param	integer		$user_id	User ID
	 * @return	array|bool
	 */
	public function get_user_style($user_id = 0) {
		$sql = 'SELECT user_style
				FROM ' . USERS_TABLE . '
				WHERE user_id = ' . (int) $user_id;
		$result = $this->db->sql_query($sql);
		$user_style = (int) $this->db->sql_fetchfield('user_style');
		$this->db->sql_freeresult($result);
		
		return $this->get_style($user_style);
	}
	
	/**
	 * Get current style
	 * @return	array
	 */
	public function get_current_style() {
		$style = $this->get_style($this->config['default_style']);
		
		if ($this->user->data['user_style'] != $this->config['default_style'] && !$this->config['override_user_style']) {
			$style = $this->get_user_style($this->user->data['user_id']);
		}
		
		return $style;
	}
	
	/**
	 * Check if avatar image file exists
	 * @param	string	$style	Style path
	 * @param	string	$img	Image name
	 * @param	string	$ext	Image extension
	 * @return	bool
	 */
	public function style_avatar_exists($style = '', $img = '', $ext = 'gif') {
		$avatar = vsprintf('%sstyles/%s/theme/images/%s.%s', [
			$this->root_path,
			$style,
			$img,
			$ext
		]);
		
		return file_exists(realpath($avatar));
	}
	
	/**
	 * Get avatar image from current style
	 * @param	integer	$user_id	User ID
	 * @return	string
	 */
	public function get_current_style_avatar($user_id = 0) {
		$style = $this->get_current_style();
		$gender = $this->get_gender($user_id);
		$avatar = [
			'name'	=> 'no_avatar',
			'ext'	=> 'gif'
		];
		
		$extensions = explode(',', trim($this->config['default_avatar_extensions']));
		
		if ($this->can_enable_gender_avatars() && (bool) $this->config['default_avatar_by_gender']) {
			
			if (!empty($gender)) {
				
				foreach ($extensions as $ext) {
					$ext = trim($ext);
					$name = sprintf('no_avatar_%s', $gender);
					
					if ($this->style_avatar_exists($style['style_path'], $name, $ext)) {
						$avatar['name'] = $name;
						$avatar['ext'] = $ext;
					}
				}
				
			}
			
		}
		
		return vsprintf('%sstyles/%s/theme/images/%s.%s', [
			$this->root_path,
			$style['style_path'],
			$avatar['name'],
			$avatar['ext']
		]);
	}
	
	/**
	 * Get avatar URL
	 * @param	integer	$user_id	User ID
	 * @param	array	$options
	 * @return	string
	 */
	public function get_avatar($user_id = 0, $options = []) {
		$defaults = [
			'full_path'	=> false,
			'html'		=> false,
			'width'		=> (int) $this->config['default_avatar_width'],
			'height'	=> (int) $this->config['default_avatar_height'],
			'attrs'		=> [
				'alt'	=> $this->user->lang('USER_AVATAR')
			]
		];
		$options = array_merge($defaults, $options);
		$gender = $this->get_gender($user_id);
		$url = $this->config['default_avatar_image'];
		
		switch ($this->config['default_avatar_type']) {
			case 'style':
				$url = $this->get_current_style_avatar($user_id);
				break;
			case 'local':
				if (!empty($gender) && (bool) $this->config['default_avatar_by_gender']) {
					$url = $this->config[sprintf('default_avatar_image_%s', $gender)];
				}
				
				// Needed in private messages as there the image
				// doesn't have the gallery path
				if ($options['full_path']) {
					$url = vsprintf('%s%s/%s', [
						$this->root_path,
						$this->config['avatar_gallery_path'],
						$url
					]);
				}
				break;
			case 'gravatar':
				if (!empty($gender) && $this->config['default_avatar_by_gender']) {
					$url = $this->config[sprintf('default_avatar_image_%s', $gender)];
				}
				
				// Needed in private messages because the MD5 email hash
				// is not calculated there.
				if ($options['full_path']) {
					$url = $this->get_gravatar([
						'email'	=> $url,
						'size'	=> $options['width']
					]);
				}
				break;
			default:
				if (!empty($gender) && $this->config['default_avatar_by_gender']) {
					$url = $this->config[sprintf('default_avatar_image_%s', $gender)];
				}
				break;
		}
		
		if ($options['html']) {
			// Default width/height
			$options['attrs'] = array_merge($options['attrs'], [
				'width'		=> $options['width'],
				'height'	=> $options['height']
			]);
			
			$html = '<img src="%s"%s />';
			$attrs = '';
			
			foreach ($options['attrs'] as $key => $value) {
				$attrs .= vsprintf(' %s="%s"', [
					trim($key),
					trim($value)
				]);
			}
			
			$url = vsprintf($html, [$url, $attrs]);
		}
		
		return $url;
	}
	
	/**
	 * Get gravatar URL
	 * @param	array	$data	Gravatar options
	 * @return	string
	 */
	public function get_gravatar($options = []) {
		// Default values
		$defaults = [
			'email'	=> '',
			'size'	=> $this->config['avatar_max_width']
		];
		
		$options = array_merge($defaults, $options);
		
		$url = '//secure.gravatar.com/avatar/%s?s=%d';
		$hash = md5(strtolower(trim($options['email'])));
		$gravatar = vsprintf($url, [
			$hash,
			$options['size']
		]);
		
		return $gravatar;
	}
	
	/**
	 * Check if avatars by gender can be enabled
	 * @return	bool
	 */
	public function can_enable_gender_avatars() {
		return $this->db_tools->sql_column_exists(USERS_TABLE, 'user_gender');
	}
	
	/**
	 * Get user gender
	 * @param	integer	$user_id	User ID
	 * @return	string
	 */
	public function get_gender($user_id = 0) {
		$gender = '';
		
		if ($this->can_enable_gender_avatars()) {
			$sql = 'SELECT user_gender
					FROM ' . USERS_TABLE . '
					WHERE user_id = ' . (int) $user_id;
			$result = $this->db->sql_query($sql);
			$user_gender = (int) $this->db->sql_fetchfield('user_gender');
			$this->db->sql_freeresult($result);
			
			$gender = ($user_gender === 1) ? 'male' : $gender;
			$gender = ($user_gender === 2) ? 'female' : $gender;
		}
		
		return $gender;
	}
	
	/**
	 * Get avatar data
	 * @param	integer	$user_id	User ID
	 * @return	array
	 */
	public function get_avatar_data($user_id = 0) {
		return [
			'user_avatar'			=> $this->get_avatar($user_id),
			'user_avatar_type'		=> $this->config['default_avatar_driver'],
			'user_avatar_width'		=> (int) $this->config['default_avatar_width'],
			'user_avatar_height'	=> (int) $this->config['default_avatar_height']
		];
	}
	
	/**
	 * Check if default avatar can be shown
	 * @param	array	$user	User data
	 * @return	bool
	 */
	public function can_show_default_avatar($user = []) {
		$show = false;
		
		// Checks if avatars are enabled
		if (is_array($user) && !empty($user) && $this->config['allow_avatar']) {
			
			// Checks if the user has not set an avatar
			if (empty($user['user_avatar'])) {
				
				// Checks if the user allows the use of the default avatar
				// or if the admin has overridden the user's settings
				if (!empty($user['user_allow_default_avatar']) || $this->config['force_default_avatar']) {
					$show = true;
				}
				
			}
			
		}
		
		return $show;
		
	}
}