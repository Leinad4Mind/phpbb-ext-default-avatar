<?php namespace alfredoramos\defaultavatar\event;

/**
 * @package Default Avatar - phpBB Extension
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright (c) 2015 Alfredo Ramos
 * @license GNU GPL 2.0 <https://www.gnu.org/licenses/gpl-2.0.txt>
 */

/**
 * @ignore
 */
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface {
	
	/* @var \phpbb\request\request */
	protected $request;
	
	/* @var \phpbb\controller\helper */
	protected $helper;

	/* @var \phpbb\template\template */
	protected $template;
	
	/* @var \phpbb\config\config */
	protected $config;
	
	/* @var \phpbb\user */
	protected $user;
	
	/* @var \alfredoramos\defaultavatar\includes\defaultavatar */
	private $defaultavatar;
	
	/**
	 * Constructor
	 *
	 * @param \phpbb\request\request	$request	Request object
	 * @param \phpbb\controller\helper	$helper		Controller helper object
	 * @param \phpbb\template			$template	Template object
	 * @param \phpbb\config\config		$config		Config object
	 * @param \phpbb\user				$user		User object
	 */
	public function __construct(\phpbb\request\request $request, \phpbb\controller\helper $helper, \phpbb\template\template $template, \phpbb\config\config $config, \phpbb\user $user) {
		$this->request = $request;
		$this->helper = $helper;
		$this->template = $template;
		$this->config = $config;
		$this->user = $user;
		$this->defaultavatar = \alfredoramos\defaultavatar\includes\defaultavatar::instance();
	}
	
	static public function getSubscribedEvents() {
		return [
			'core.user_setup'						=> 'load_language_on_setup',
			'core.user_setup_after'					=> 'set_global_template_variables',
			'core.page_header'						=> 'page_header_default_avatar',
			'core.viewtopic_post_rowset_data'		=> 'viewtopic_post_default_avatar',
			'core.ucp_pm_view_messsage'				=> 'ucp_pm_default_avatar',
			'core.memberlist_view_profile'			=> 'viewprofile_default_avatar',
			'core.ucp_prefs_personal_update_data'	=> 'ucp_prefs_personal_default_avatar'
		];
	}
	
	public function load_language_on_setup($event) {
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = [
			'ext_name'	=> 'alfredoramos/defaultavatar',
			'lang_set'	=> [
				'ucp/defaultavatar',
				'acp/defaultavatar'
			]
		];
		$event['lang_set_ext'] = $lang_set_ext;
	}
	
	public function set_global_template_variables($event) {
		$this->template->assign_vars([
			'CAN_ENABLE_AVATAR_BY_GENDER'	=> $this->defaultavatar->can_enable_gender_avatars(),
			'U_ALLOW_DEFAULT_AVATAR'		=> $this->user->data['user_allow_default_avatar']
		]);
	}
	
	public function page_header_default_avatar($event) {
		if ($this->defaultavatar->can_show_default_avatar($this->user->data)) {
			$this->user->data = array_merge($this->user->data, $this->defaultavatar->get_avatar_data($this->user->data['user_id']));
		}
	}
	
	public function viewtopic_post_default_avatar($event) {
		if ($this->defaultavatar->can_show_default_avatar($event['row'])) {
			$event['row'] = array_merge($event['row'], $this->defaultavatar->get_avatar_data($event['row']['user_id']));
		}
	}
	
	public function ucp_pm_default_avatar($event) {
		if ($this->defaultavatar->can_show_default_avatar($event['user_info'])) {
			$event['msg_data'] = array_merge($event['msg_data'], [
				'AUTHOR_AVATAR'	=> $this->defaultavatar->get_avatar($event['user_info']['user_id'], [
					'full_path'	=> true,
					'html'		=> true
				])
			]);
		}
	}
	
	public function viewprofile_default_avatar($event) {
		if ($this->defaultavatar->can_show_default_avatar($event['member'])) {
			$event['member'] = array_merge($event['member'], $this->defaultavatar->get_avatar_data($event['member']['user_id']));
		}
	}
	
	public function ucp_prefs_personal_default_avatar($event) {
		$event['data'] = array_merge($event['data'], [
			'allowdefaultavatar'	=> $this->request->variable('allowdefaultavatar', (bool) $this->user->data['user_allow_default_avatar'])
		]);
		$event['sql_ary'] = array_merge($event['sql_ary'], [
			'user_allow_default_avatar'	=> $event['data']['allowdefaultavatar']
		]);
	}
	
}