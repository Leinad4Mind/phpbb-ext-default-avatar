<?php

/**
 * @package Default Avatar - phpBB Extension
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright (c) 2015 Alfredo Ramos
 * @license GNU GPL 2.0 <https://www.gnu.org/licenses/gpl-2.0.txt>
 *
 * Translated By : Bassel Taha Alhitary - www.alhitary.net
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
	'UCP_ALLOW_DEFAULT_AVATAR'			=> 'السماح بإستخدام الصورة الشخصية الإفتراضية :',
	'UCP_ALLOW_DEFAULT_AVATAR_EXPLAIN'	=> 'نرجوا الملاحظة بأن المدراء يستطيعون تعطيل هذا الخيار.'
]);
