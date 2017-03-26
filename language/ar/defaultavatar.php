<?php

/**
 * @package Default Avatar - phpBB Extension
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright (c) 2015 Alfredo Ramos
 * @license GNU GPL 2.0 <https://www.gnu.org/licenses/gpl-2.0.txt>
 *
 * Translated by: Bassel Taha Alhitary <www.alhitary.net>
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
	// UCP
	'UCP_ALLOW_DEFAULT_AVATAR'			=> 'السماح بإستخدام الصورة الشخصية الإفتراضية :',
	'UCP_ALLOW_DEFAULT_AVATAR_EXPLAIN'	=> 'نرجوا الملاحظة بأن المدراء يستطيعون تعطيل هذا الخيار.',
	
	// ACP
	'ACP_DEFAULT_AVATAR'		=> 'الصورة الشخصية الإفتراضية',
	
	'ACP_SETTINGS_SAVED'		=> 'تم حفظ الإعدادات بنجاح !',
	
	'ACP_AVATAR_TYPE'			=> 'نوع الصورة الشخصية ',
	'ACP_AVATAR_TYPE_EXPLAIN'	=> '%1$s: %2$s<br />%3$s: %4$s<br />%5$s: %6$s<br />%7$s: %8$s<br />',
	
	'ACP_STYLE_AVATAR'			=> 'من الإستايل',
	'ACP_STYLE_AVATAR_EXPLAIN'	=> 'يجب أن تكون الصورة موجودة في أستايل العضو',
	
	'ACP_LOCAL_AVATAR'			=> 'رابط محلي',
	'ACP_LOCAL_AVATAR_EXPLAIN'	=> 'يجب أن تكون الصورة موجودة في المسار <code>%1$s</code>.',
	
	'ACP_REMOTE_AVATAR'			=> 'رابط خارجي',
	'ACP_REMOTE_AVATAR_EXPLAIN'	=> 'يجب أن يكون رابط مباشر للصورة من موقع خارجي أو موقعك.',
	
	'ACP_GRAVATAR_AVATAR'			=> 'جرافتار',
	'ACP_GRAVATAR_AVATAR_EXPLAIN'	=> 'صورة من الموقع Gravatar. يجب أن يكون البريد الإلكتروني صالح.',
	
	'ACP_AVATAR_IMAGE'			=> 'رابط الصورة الشخصية ',
	'ACP_AVATAR_IMAGE_FEMALE'	=> 'رابط الصورة الشخصية ( أنثى ) ',
	'ACP_AVATAR_IMAGE_MALE'		=> 'رابط الصورة الشخصية ( ذكر ) ',
	'ACP_AVATAR_IMAGE_EXPLAIN'	=> '<strong>%1$s</strong> لن يكون لها أي تأثير إذا تم تحديد "<em>%3$s</em>" في الخيار : <strong>%2$s</strong>.',
	
	'ACP_AVATAR_DIMENSIONS'			=> 'أبعاد الصورة الشخصية ',
	'ACP_AVATAR_DIMENSIONS_EXPLAIN'	=> 'الحد الأعلى والأدنى لأبعاد الصورة تعتمد على <strong>%1$s</strong>.',
	
	'ACP_FORCE_AVATAR'			=> 'فرض الصورة الشخصية ',
	'ACP_FORCE_AVATAR_EXPLAIN'	=> 'استخدام الصورة الشخصية بصورة إجبارية حتى لو تم تعطيلها بواسطة العضو من لوحة التحكم الخاصة به.',
	
	'ACP_AVATAR_BY_GENDER'			=> 'الصورة الشخصية بحسب نوع الجنس ',
	'ACP_AVATAR_BY_GENDER_EXPLAIN'	=> 'أنت بحاجة إلى تثبيت وتفعيل الإضافة <a href="https://www.phpbb.com/customise/db/extension/phpbb_3.1_genders" target="_blank" rel="nofollow">الجنس</a> لكي تستطيع استخدام الصورة الشخصية بحسب نوع الجنس.',
	
	'ACP_IMAGE_EXTENSIONS'			=> 'أنواع امتداد الصور ',
	'ACP_IMAGE_EXTENSIONS_EXPLAIN'	=> 'قائمة أنواع امتداد الصور للبحث عنها في مسار الإستايل. أفصل بينهم بعلامة الفاصلة. هذا الخيار لن يكون له أي تأثير إذا لم يتم تحديد <em>%2$s</em> في الخيار : <em>%1$s</em>.'
]);
