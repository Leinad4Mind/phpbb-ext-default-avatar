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
	'UCP_ALLOW_DEFAULT_AVATAR'			=> 'Permite o uso de um avatar padrão:',
	'UCP_ALLOW_DEFAULT_AVATAR_EXPLAIN'	=> 'Observe que isso pode ser alterado pelos administradores.',
	
	// ACP
	'ACP_DEFAULT_AVATAR'		=> 'Avatar padrão',
	
	'ACP_SETTINGS_SAVED'		=> 'Configuração salva com sucesso!',
	
	'ACP_AVATAR_TYPE'			=> 'Tipo de avatar',
	'ACP_AVATAR_TYPE_EXPLAIN'	=> '%1$s: %2$s<br />%3$s: %4$s<br />%5$s: %6$s<br />%7$s: %8$s<br />',
	
	'ACP_STYLE_AVATAR'			=> 'Do estilo',
	'ACP_STYLE_AVATAR_EXPLAIN'	=> 'Pega a imagem do estilo do usuário.',
	
	'ACP_LOCAL_AVATAR'			=> 'Local',
	'ACP_LOCAL_AVATAR_EXPLAIN'	=> 'Imagem deve estar na pasta <code>%1$s</code>.',
	
	'ACP_REMOTE_AVATAR'			=> 'Remoto',
	'ACP_REMOTE_AVATAR_EXPLAIN'	=> 'Deve ser um link completo ou relativo para a pasta raiz do phpBB.',
	
	'ACP_GRAVATAR_AVATAR'			=> 'Gravatar',
	'ACP_GRAVATAR_AVATAR_EXPLAIN'	=> 'Deve ser um endereço de email válido.',
	
	'ACP_AVATAR_IMAGE'			=> 'Imagem avatar',
	'ACP_AVATAR_IMAGE_FEMALE'	=> 'Imagem avatar (feminino)',
	'ACP_AVATAR_IMAGE_MALE'		=> 'Imagem avatar (masculino)',
	'ACP_AVATAR_IMAGE_EXPLAIN'	=> '<strong>%1$s</strong> não terá nenhum efeito se <strong>%2$s</strong> estiver definido como <em>%3$s</em>.',
	
	'ACP_AVATAR_DIMENSIONS'			=> 'Dimensões do avatar',
	'ACP_AVATAR_DIMENSIONS_EXPLAIN'	=> 'Dimensões máximas e mínimas dependem de <strong>%1$s</strong>.',
	
	'ACP_FORCE_AVATAR'			=> 'Força o uso do avatar padrão',
	'ACP_FORCE_AVATAR_EXPLAIN'	=> 'Força o uso do avatar default se o usuário desabilitá-lo no UCP.',
	
	'ACP_AVATAR_BY_GENDER'			=> 'Avatar por gênero',
	'ACP_AVATAR_BY_GENDER_EXPLAIN'	=> 'Para habilitar avatares por gênero é necessário instalar e ativar a extensão <a href="https://www.phpbb.com/customise/db/extension/phpbb_3.1_genders" target="_blank" rel="nofollow">Genders</a>.',
	
	'ACP_IMAGE_EXTENSIONS'			=> 'Extensões de imagem',
	'ACP_IMAGE_EXTENSIONS_EXPLAIN'	=> 'Uma lista de extensões de imagem a procurar na pasta do estilo. Deve ser separado por vírgula. Esta opção não terá efeito se <em>%1$s</em> estiver definido como <em>%2$s</em>.'
]);