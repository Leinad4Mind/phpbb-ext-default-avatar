<?php

/**
 * @package Default Avatar - phpBB Extension
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright (c) 2015 Alfredo Ramos
 * @license GNU GPL 2.0 <https://www.gnu.org/licenses/gpl-2.0.txt>
 */

/**
 * @ignore
 */
if (!defined('IN_PHPBB')) {
	exit;
}

if (empty($lang) || !is_array($lang)) {
	$lang = [];
}

$lang = array_merge($lang, [
	'ACP_DEFAULT_AVATAR'		=> 'Default Avatar',
	'ACP_JAVASCRIPT_EXPLAIN'	=> 'Preview requires JavaScript to function, please turn it on.',
	
	'ACP_SETTINGS_SAVED'		=> 'Settings have been saved successfully!',
	
	'ACP_AVATAR_TYPE'			=> 'Avatar type',
	'ACP_AVATAR_TYPE_EXPLAIN'	=> '%s: %s<br />%s: %s<br />%s: %s<br />%s: %s<br />',
	
	'ACP_AVATAR_FROM_STYLE'			=> 'From style',
	'ACP_AVATAR_FROM_STYLE_EXPLAIN'	=> 'Get the image from the user\'s style',
	
	'ACP_LOCAL_AVATAR'			=> 'Local',
	'ACP_LOCAL_AVATAR_EXPLAIN'	=> 'Image must be in the <code>%s</code> path.',
	
	'ACP_REMOTE_AVATAR'			=> 'Remote',
	'ACP_REMOTE_AVATAR_EXPLAIN'	=> 'Image can be a hotlink or relative to your phpBB root directory.',
	
	'ACP_GRAVATAR_AVATAR'			=> 'Gravatar',
	'ACP_GRAVATAR_AVATAR_EXPLAIN'	=> 'Must be a valid email address.',
	
	'ACP_AVATAR_IMAGE'			=> 'Avatar image',
	'ACP_AVATAR_IMAGE_FEMALE'	=> 'Avatar image (female)',
	'ACP_AVATAR_IMAGE_MALE'		=> 'Avatar image (male)',
	'ACP_AVATAR_IMAGE_EXPLAIN'	=> '<strong>%s</strong> won\'t have any effect if <strong>%s</strong> is set to <em>%s</em>.',
	
	'ACP_AVATAR_DIMENSIONS'			=> 'Avatar dimensions',
	'ACP_AVATAR_DIMENSIONS_EXPLAIN'	=> 'Maximum and minimum image dimensions depend on the <strong>%s</strong>.',
	
	'ACP_FORCE_AVATAR'			=> 'Force default avatar',
	'ACP_FORCE_AVATAR_EXPLAIN'	=> 'Forces the use of the default avatar even if the user has disabled it in the UCP.',
	
	'ACP_AVATAR_BY_GENDER'			=> 'Avatar by gender',
	'ACP_AVATAR_BY_GENDER_EXPLAIN'	=> 'To enable avatars by gender you need to install and activate the <a href="https://www.phpbb.com/customise/db/extension/phpbb_3.1_genders">Genders</a> extension.',
	
	'ACP_IMAGE_EXTENSIONS'			=> 'Image extensions',
	'ACP_IMAGE_EXTENSIONS_EXPLAIN'	=> 'A list of image extensions to search in the style path. Must be separated by a comma. This option won\'t have any effect if "%s" is not set to "%s".',
	
	'ACP_PREVIEW_EXPLAIN'	=> 'This is what the avatar will look like.'
]);