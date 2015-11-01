<?php namespace alfredoramos\defaultavatar\includes;

/**
 * @package Default Avatar - phpBB Extension
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright (c) 2015 Alfredo Ramos
 * @license GNU GPL 2.0 <https://www.gnu.org/licenses/gpl-2.0.txt>
 */

class defaultavatar {
	use singletontrait;
	
	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\cache\driver\driver_interface */
	protected $cache;

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $php_ext;
	
	/** @var \phpbb\db\tools */
	protected $db_tools;
	
	protected function init() {
		global $db, $user, $phpbb_admin_path, $phpbb_root_path, $phpEx, $template, $request, $cache, $auth, $config;
		
		$this->db = $db;
		$this->user = $user;
		$this->template = $template;
		$this->request = $request;
		$this->cache = $cache;
		$this->auth = $auth;
		$this->config = $config;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $phpEx;
		$this->db_tools = new \phpbb\db\tools($this->db);
	}
	
	/**
	 * Get style by ID
	 * @param	integer		$id	Style ID
	 * @return	array|bool
	 */
	public function get_style($id = 0) {
		$sql = 'SELECT *
				FROM ' . STYLES_TABLE . '
				WHERE style_id = "' . $this->db->sql_escape($id) . '"';
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
				WHERE user_id = "' . $this->db->sql_escape($user_id) . '"';
		$result = $this->db->sql_query($sql);
		$row = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);
		
		return $this->get_style($row['user_style']);
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
		$avatar = vsprintf('%s/styles/%s/theme/images/%s.%s', [$this->phpbb_root_path, $style, $img, $ext]);
		
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
		
		if ($this->can_enable_gender_avatars() && $this->config['default_avatar_by_gender']) {
			
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
		
		return vsprintf('./styles/%s/theme/images/%s.%s', [
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
			'attrs'		=> [
				'alt'		=> $this->user->lang('USER_AVATAR'),
				'width'		=> $this->config['default_avatar_width'],
				'height'	=> $this->config['default_avatar_height']
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
				$url = sprintf('%s', $url);
				
				if ($options['full_path']) {
					$url = vsprintf('./%s/%s', [
						$this->config['avatar_gallery_path'],
						$url
					]);
				}
				
				if (!empty($gender) && $this->config['default_avatar_by_gender']) {
					$url = sprintf('%s', $this->config[sprintf('default_avatar_image_%s', $gender)]);
					
					if ($options['full_path']) {
						$url = vsprintf('./%s/%s', [
							$this->config['avatar_gallery_path'],
							$this->config[sprintf('default_avatar_image_%s',$gender)]
						]);
					}
				}
				break;
			case 'gravatar':
				$url = $this->get_gravatar([
					'email'	=> $this->config['default_avatar_image'],
					'size'	=> $this->config['default_avatar_width']
				]);
				
				if (!empty($gender) && $this->config['default_avatar_by_gender']) {
					$url = $this->get_gravatar([
						'email'	=> $this->config[sprintf('default_avatar_image_%s', $gender)],
						'size'	=> $this->config['default_avatar_width']
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
			$html = '<img src="%s"%s />';
			$attrs = '';
			
			foreach ($options['attrs'] as $key => $value) {
				$attrs .= vsprintf(' %s="%s"', [
					trim($key),
					trim($value)
				]);
			}
			
			$url = vsprintf($html, [
				$url,
				$attrs
			]);
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
					WHERE user_id = "' . $this->db->sql_escape($user_id) . '"';
			$result = $this->db->sql_query($sql);
			$row = $this->db->sql_fetchrow($result);
			$this->db->sql_freeresult($result);
			
			$gender = ($row['user_gender'] === '1') ? 'male' : $gender;
			$gender = ($row['user_gender'] === '2') ? 'female' : $gender;
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
			'user_avatar_width'		=> $this->config['default_avatar_width'],
			'user_avatar_height'	=> $this->config['default_avatar_height']
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