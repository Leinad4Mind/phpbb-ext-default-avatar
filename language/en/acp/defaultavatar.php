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
	// General
	'ACP_DEFAULT_AVATAR'						=> 'Default Avatar Extension',
	'ACP_DEFAULT_AVATAR_TYPE'					=> 'Avatar type',
	'ACP_DEFAULT_AVATAR_TYPE_STYLE'				=> 'From style',
	'ACP_DEFAULT_AVATAR_TYPE_STYLE_INFO'		=> 'Get the image from the user\'s style',
	'ACP_DEFAULT_AVATAR_TYPE_LOCAL'				=> 'Local',
	'ACP_DEFAULT_AVATAR_TYPE_LOCAL_INFO'		=> 'Image must be in the <code>%s</code> path.',
	'ACP_DEFAULT_AVATAR_TYPE_REMOTE'			=> 'Remote',
	'ACP_DEFAULT_AVATAR_TYPE_REMOTE_INFO'		=> 'Image can be a hotlink or relative to your phpBB root directory.',
	'ACP_DEFAULT_AVATAR_TYPE_GRAVATAR'			=> 'Gravatar',
	'ACP_DEFAULT_AVATAR_TYPE_GRAVATAR_INFO'		=> 'Must be a valid email address.',
	'ACP_DEFAULT_AVATAR_IMAGE'					=> 'Avatar image',
	'ACP_DEFAULT_AVATAR_IMAGE_INFO'				=> '<strong>%s</strong> won\'t have any effect if <strong>%s</strong> is set to <em>%s</em>.',
	'ACP_DEFAULT_AVATAR_IMAGE_DIMENSIONS'		=> 'Avatar dimensions',
	'ACP_DEFAULT_AVATAR_IMAGE_DIMENSIONS_INFO'	=> 'Maximum and minimum image dimensions depend on the <strong>%s</strong>.',
	'ACP_DEFAULT_AVATAR_JAVASCRIPT_WARNING'		=> 'Preview requires JavaScript to function, please turn it on.',
	'ACP_DEFAULT_AVATAR_IMAGE_PREVIEW_INFO'		=> 'This is what the avatar will look like.',
	'ACP_DEFAULT_AVATAR_SETTINGS_SAVED'			=> 'Settings have been saved successfully!',
	
	// Avatars by gender
	'ACP_DEFAULT_AVATAR_BY_GENDER'						=> 'Avatar by gender',
	'ACP_DEFAULT_AVATAR_BY_GENDER_INFO'					=> 'To enable avatars by gender you need to install and activate the <a href="https://www.phpbb.com/customise/db/extension/phpbb_3.1_genders">Genders</a> extension.',
	'ACP_DEFAULT_AVATAR_BY_GENDER_IMAGE_FORMATS'		=> 'Image formats',
	'ACP_DEFAULT_AVATAR_BY_GENDER_IMAGE_FORMATS_INFO'	=> 'A list of image file formats to search in the style path. Must be separated by a comma. This option won\'t have any effect if "%s" is not set to "%s".',
	'ACP_DEFAULT_AVATAR_IMAGE_FEMALE'					=> 'Avatar image (female)',
	'ACP_DEFAULT_AVATAR_IMAGE_MALE'						=> 'Avatar image (male)'
]);