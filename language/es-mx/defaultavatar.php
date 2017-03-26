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
	// UCP
	'UCP_ALLOW_DEFAULT_AVATAR'			=> 'Permitir el uso del avatar por defecto:',
	'UCP_ALLOW_DEFAULT_AVATAR_EXPLAIN'	=> 'Tome en cuenta que Administradores podrán anular este ajuste.',
	
	// ACP
	'ACP_DEFAULT_AVATAR'		=> 'Avatar por defecto',
	
	'ACP_SETTINGS_SAVED'		=> '¡Ajustes guardados existosamente!',
	
	'ACP_AVATAR_TYPE'			=> 'Tipo de avatar',
	'ACP_AVATAR_TYPE_EXPLAIN'	=> '%1$s: %2$s<br />%3$s: %4$s<br />%5$s: %6$s<br />%7$s: %8$s<br />',
	
	'ACP_STYLE_AVATAR'			=> 'Del estilo',
	'ACP_STYLE_AVATAR_EXPLAIN'	=> 'Obtiene la imagen del estilo del usuario',
	
	'ACP_LOCAL_AVATAR'			=> 'Local',
	'ACP_LOCAL_AVATAR_EXPLAIN'	=> 'La imagen debe estar en la ruta <code>%1$s</code>',
	
	'ACP_REMOTE_AVATAR'			=> 'Remoto',
	'ACP_REMOTE_AVATAR_EXPLAIN'	=> 'La imagen puede ser un hotlink o ser relativa al directorio raíz de phpBB.',
	
	'ACP_GRAVATAR_AVATAR'			=> 'Gravatar',
	'ACP_GRAVATAR_AVATAR_EXPLAIN'	=> 'Debe ser una dirección de email válida.',
	
	'ACP_AVATAR_IMAGE'			=> 'Imagen del avatar',
	'ACP_AVATAR_IMAGE_FEMALE'	=> 'Imagen del avatar (femenino)',
	'ACP_AVATAR_IMAGE_MALE'		=> 'Imagen del avatar (masculino)',
	'ACP_AVATAR_IMAGE_EXPLAIN'	=> '<strong>%1$s</strong> no tendrá ningún efecto si <strong>%2$s</strong> es establecido a <em>%3$s</em>.',
	
	'ACP_AVATAR_DIMENSIONS'			=> 'Dimensiones del avatar',
	'ACP_AVATAR_DIMENSIONS_EXPLAIN'	=> 'Las dimensiones máximas y mínimas de la imágen dependen de la <strong>%1$s</strong>.',
	
	'ACP_FORCE_AVATAR'			=> 'Forzar el avatar por defecto',
	'ACP_FORCE_AVATAR_EXPLAIN'	=> 'Forza el uso del avatar por defecto si el usuario lo ha deshabilitado en el PCU.',
	
	'ACP_AVATAR_BY_GENDER'			=> 'Avatar por género',
	'ACP_AVATAR_BY_GENDER_EXPLAIN'	=> 'Para habilitar esta opción necesita instalar y activar la extensión <a href="https://www.phpbb.com/customise/db/extension/phpbb_3.1_genders" target="_blank" rel="nofollow">Genders</a>.',
	
	'ACP_IMAGE_EXTENSIONS'			=> 'Extensiones de imagen',
	'ACP_IMAGE_EXTENSIONS_EXPLAIN'	=> 'Lista de extensiones de imagen a buscar en la ruta del estilo. Deben estar separadas por una coma. Esta opción no tendrá ningún efecto si <em>%1$s</em> es establecido a <em>%2$s</em>.'
]);