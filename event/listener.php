<?php

/**
 * @package Default Avatar - phpBB Extension
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright (c) 2015 Alfredo Ramos
 * @license GNU GPL 2.0 <https://www.gnu.org/licenses/gpl-2.0.txt>
 */

namespace alfredoramos\defaultavatar\event;

/**
 * @ignore
 */
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface {
	
	/* @var \phpbb\request\request */
	protected $request;

	/* @var \phpbb\template\template */
	protected $template;
	
	/* @var \phpbb\user */
	protected $user;
	
	/* @var \alfredoramos\defaultavatar\includes\defaultavatar */
	private $defaultavatar;
	
	/**
	 * Constructor
	 *
	 * @param \phpbb\request\request	$request	Request object
	 * @param \phpbb\template\template	$template	Template object
	 * @param \phpbb\user				$user		User object
	 * @param \alfredoramos\defaultavatar\includes\defaultavatar	$defaultavatar	Default avatar object
	 */
	public function __construct(
		\phpbb\request\request $request,
		\phpbb\template\template $template,
		\phpbb\user $user,
		\alfredoramos\defaultavatar\includes\defaultavatar $defaultavatar
	) {
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->defaultavatar = $defaultavatar;
	}
	
	static public function getSubscribedEvents() {
		return [
			'core.user_setup'						=> 'user_setup',
			'core.user_setup_after'					=> 'user_setup_after',
			'core.page_header'						=> 'page_header',
			'core.viewtopic_post_rowset_data'		=> 'viewtopic_post_rowset_data',
			'core.ucp_pm_view_messsage'				=> 'ucp_pm_view_messsage',
			'core.memberlist_view_profile'			=> 'memberlist_view_profile',
			'core.ucp_prefs_personal_update_data'	=> 'ucp_prefs_personal_update_data'
		];
	}
	
	public function user_setup($event) {
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = [
			'ext_name'	=> 'alfredoramos/defaultavatar',
			'lang_set'	=> 'defaultavatar'
		];
		$event['lang_set_ext'] = $lang_set_ext;
	}
	
	public function user_setup_after($event) {
		$this->template->assign_vars([
			'ALLOW_DEFAULT_AVATAR'		=> $this->user->data['user_allow_default_avatar'],
			'ENABLE_AVATAR_BY_GENDER'	=> $this->defaultavatar->can_enable_gender_avatars()
		]);
	}
	
	public function page_header($event) {
		if ($this->defaultavatar->can_show_default_avatar($this->user->data)) {
			$this->user->data = array_merge($this->user->data, $this->defaultavatar->get_avatar_data($this->user->data['user_id']));
		}
	}
	
	public function viewtopic_post_rowset_data($event) {
		if ($this->defaultavatar->can_show_default_avatar($event['row'])) {
			$event['row'] = array_merge($event['row'], $this->defaultavatar->get_avatar_data($event['row']['user_id']));
		}
	}
	
	public function ucp_pm_view_messsage($event) {
		if ($this->defaultavatar->can_show_default_avatar($event['user_info'])) {
			$event['msg_data'] = array_merge($event['msg_data'], [
				'AUTHOR_AVATAR'	=> $this->defaultavatar->get_avatar($event['user_info']['user_id'], [
					'full_path'	=> true,
					'html'		=> true
				])
			]);
		}
	}
	
	public function memberlist_view_profile($event) {
		if ($this->defaultavatar->can_show_default_avatar($event['member'])) {
			$event['member'] = array_merge($event['member'], $this->defaultavatar->get_avatar_data($event['member']['user_id']));
		}
	}
	
	public function ucp_prefs_personal_update_data($event) {
		$event['data'] = array_merge($event['data'], [
			'allowdefaultavatar'	=> $this->request->variable('allowdefaultavatar', (bool) $this->user->data['user_allow_default_avatar'])
		]);
		$event['sql_ary'] = array_merge($event['sql_ary'], [
			'user_allow_default_avatar'	=> $event['data']['allowdefaultavatar']
		]);
	}
	
}