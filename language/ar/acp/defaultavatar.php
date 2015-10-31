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
	// General
	'ACP_DEFAULT_AVATAR'						=> 'الصورة الشخصية الإفتراضية ',
	'ACP_DEFAULT_AVATAR_TYPE'					=> 'نوع الصورة الشخصية ',
	'ACP_DEFAULT_AVATAR_TYPE_STYLE'				=> 'من الإستايل',
	'ACP_DEFAULT_AVATAR_TYPE_STYLE_INFO'		=> 'يجب أن تكون الصورة موجودة في أستايل العضو',
	'ACP_DEFAULT_AVATAR_TYPE_LOCAL'				=> 'محلي',
	'ACP_DEFAULT_AVATAR_TYPE_LOCAL_INFO'		=> 'يجب أن تكون الصورة موجودة في المسار <code>%s</code>.',
	'ACP_DEFAULT_AVATAR_TYPE_REMOTE'			=> 'خارجي',
	'ACP_DEFAULT_AVATAR_TYPE_REMOTE_INFO'		=> 'يجب أن يكون رابط مباشر للصورة من موقع خارجي أو موقعك.',
	'ACP_DEFAULT_AVATAR_TYPE_GRAVATAR'			=> 'جرافتار',
	'ACP_DEFAULT_AVATAR_TYPE_GRAVATAR_INFO'		=> 'صورة من الموقع Gravatar. يجب أن تحتوي الصورة على بريد إلكتروني صالحس.',
	'ACP_DEFAULT_AVATAR_IMAGE'					=> 'رابط الصورة الشخصية ',
	'ACP_DEFAULT_AVATAR_IMAGE_INFO'				=> '<strong>%s</strong> لن يكون لها أي تأثير إذا تم تحديد "<em>%s</em>" في الخيار : <strong>%s</strong>.',
	'ACP_DEFAULT_AVATAR_IMAGE_DIMENSIONS'		=> 'أبعاد الصورة الشخصية ',
	'ACP_DEFAULT_AVATAR_IMAGE_DIMENSIONS_INFO'	=> 'الحد الأعلى والأدنى لأبعاد الصورة تعتمد على <strong>%s</strong>.',
	'ACP_DEFAULT_AVATAR_JAVASCRIPT_WARNING'		=> 'يجب تفعيل سكربت الجافا في مُتصفحك لمُعاينة الصورة.',
	'ACP_DEFAULT_AVATAR_IMAGE_PREVIEW_INFO'		=> 'هنا سيتم عرض الصورة التي أضفتها.',
	'ACP_DEFAULT_AVATAR_SETTINGS_SAVED'			=> 'تم حفظ الإعدادات بنجاح !',
	
	// Avatars by gender
	'ACP_DEFAULT_AVATAR_BY_GENDER'						=> 'الصورة الشخصية بحسب نوع الجنس',
	'ACP_DEFAULT_AVATAR_BY_GENDER_INFO'					=> 'أنت بحاجة إلى تثبيت وتفعيل الإضافة <a href="https://www.phpbb.com/customise/db/extension/phpbb_3.1_genders">الجنس</a> لكي تستطيع استخدام الصورة الشخصية بحسب نوع الجنس.',
	'ACP_DEFAULT_AVATAR_BY_GENDER_IMAGE_FORMATS'		=> 'أنواع امتداد الصور ',
	'ACP_DEFAULT_AVATAR_BY_GENDER_IMAGE_FORMATS_INFO'	=> 'قائمة أنواع امتداد الصور للبحث عنها في مسار الإستايل. أفصل بينهم بعلامة الفاصلة. هذا الخيار لن يكون له أي تأثير إذا تم تحديد "%s" في الخيار : "%s".',
	'ACP_DEFAULT_AVATAR_IMAGE_FEMALE'					=> 'رابط الصورة الشخصية ( أنثى )',
	'ACP_DEFAULT_AVATAR_IMAGE_MALE'						=> 'رابط الصورة الشخصية ( ذكر )'
]);
