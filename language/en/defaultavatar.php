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

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang = array_merge($lang, [
	// UCP
	'UCP_ALLOW_DEFAULT_AVATAR'			=> 'Allow use of the default avatar:',
	'UCP_ALLOW_DEFAULT_AVATAR_EXPLAIN'	=> 'Note that administrators can override this setting.',
	
	// ACP
	'ACP_DEFAULT_AVATAR'		=> 'Default Avatar',
	
	'ACP_SETTINGS_SAVED'		=> 'Settings have been saved successfully!',
	
	'ACP_AVATAR_TYPE'			=> 'Avatar type',
	'ACP_AVATAR_TYPE_EXPLAIN'	=> '%1$s: %2$s<br />%3$s: %4$s<br />%5$s: %6$s<br />%7$s: %8$s<br />',
	
	'ACP_STYLE_AVATAR'			=> 'From style',
	'ACP_STYLE_AVATAR_EXPLAIN'	=> 'Get the image from the user’s style',
	
	'ACP_LOCAL_AVATAR'			=> 'Local',
	'ACP_LOCAL_AVATAR_EXPLAIN'	=> 'Image must be in the <code>%1$s</code> path.',
	
	'ACP_REMOTE_AVATAR'			=> 'Remote',
	'ACP_REMOTE_AVATAR_EXPLAIN'	=> 'Image can be a hotlink or relative to your phpBB root directory.',
	
	'ACP_GRAVATAR_AVATAR'			=> 'Gravatar',
	'ACP_GRAVATAR_AVATAR_EXPLAIN'	=> 'Must be a valid email address.',
	
	'ACP_AVATAR_IMAGE'			=> 'Avatar image',
	'ACP_AVATAR_IMAGE_FEMALE'	=> 'Avatar image (female)',
	'ACP_AVATAR_IMAGE_MALE'		=> 'Avatar image (male)',
	'ACP_AVATAR_IMAGE_EXPLAIN'	=> '<strong>%1$s</strong> won’t have any effect if <strong>%2$s</strong> is set to <em>%3$s</em>.',
	
	'ACP_AVATAR_DIMENSIONS'			=> 'Avatar dimensions',
	'ACP_AVATAR_DIMENSIONS_EXPLAIN'	=> 'Maximum and minimum image dimensions depend on the <strong>%1$s</strong>.',
	
	'ACP_FORCE_AVATAR'			=> 'Force default avatar',
	'ACP_FORCE_AVATAR_EXPLAIN'	=> 'Forces the use of the default avatar if the user has disabled it in the UCP.',
	
	'ACP_AVATAR_BY_GENDER'			=> 'Avatar by gender',
	'ACP_AVATAR_BY_GENDER_EXPLAIN'	=> 'To enable avatars by gender you need to install and activate the <a href="https://www.phpbb.com/customise/db/extension/phpbb_3.1_genders" target="_blank" rel="nofollow">Genders</a> extension.',
	
	'ACP_IMAGE_EXTENSIONS'			=> 'Image extensions',
	'ACP_IMAGE_EXTENSIONS_EXPLAIN'	=> 'A list of image extensions to search in the style path. Must be separated by a comma. This option won’t have any effect if <em>%1$s</em> is not set to <em>%2$s</em>.'
]);