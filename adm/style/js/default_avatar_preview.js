/**
 * @package Default Avatar - phpBB Extension
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright (c) 2015 Alfredo Ramos
 * @license GNU GPL 3.0+ <https://www.gnu.org/licenses/gpl-3.0.txt>
 */

function get_gravatar($email, $size = 90) {
	var $base_url = 'https://secure.gravatar.com/avatar/';
	var $url = $base_url + md5($email) + '.jpg?s=' + $size;
	return $url;
}

function setup_default_avatar_preview() {
	/**
	 * Attributes
	 */
	var $previewWrapper = $('#default_avatar_preview');
	var $board_url = $.trim($previewWrapper.attr('data-board-url'));
	var $board_style = $.trim($previewWrapper.attr('data-board-style'));
	var $min_width = parseInt($.trim($previewWrapper.attr('data-min-width')));
	var $max_width = parseInt($.trim($previewWrapper.attr('data-max-width')));
	var $min_height = parseInt($.trim($previewWrapper.attr('data-min-height')));
	var $max_height = parseInt($.trim($previewWrapper.attr('data-max-height')));
	
	/**
	 * Form variables
	 */
	var $type = $.trim($('[name="default_avatar_type"]:checked').val());
	var $image = $.trim($('#default_avatar_image').val());
	var $image_female = $.trim($('#default_avatar_image_female').val());
	var $image_male = $.trim($('#default_avatar_image_male').val());
	var $width = parseInt($.trim($('#default_avatar_width').val()));
	var $height = parseInt($.trim($('#default_avatar_height').val()));
	
	/**
	 * Helpers
	 */
	var $img = {
		unknown: {src: '', width: $width, height: $height},
		female: {src: '', width: $width, height: $height},
		male: {src: '', width: $width, height: $height}
	};
	var $html = '';
	
	switch ($type) {
		case 'local':
			$img.unknown.src = $board_url + 'images/avatars/gallery/' + $image;
			$img.female.src = $board_url + 'images/avatars/gallery/' + $image_female;
			$img.male.src = $board_url + 'images/avatars/gallery/' + $image_male;
			break;
		case 'style':
			/**
			 * TODO: Get the image format
			 */
			$img.unknown.src = $board_url + 'styles/' + $board_style + '/theme/images/no_avatar.gif';
			$img.female.src = $board_url + 'styles/' + $board_style + '/theme/images/no_avatar_female.gif';
			$img.male.src = $board_url + 'styles/' + $board_style + '/theme/images/no_avatar_male.gif';
			
			// Check if image exists
			$.ajax({
				url: $img.female.src,
				async: false,
				type: 'HEAD',
				error: function() {
					$img.female.src = $img.unknown.src;
				}
			});
			$.ajax({
				url: $img.male.src,
				async: false,
				type: 'HEAD',
				error: function() {
					$img.male.src = $img.unknown.src;
				}
			});
			
			break;
		case 'remote':
			var $regexp = /(https?:\/\/(?:www\.)?)|(data:\w+\/\w+;base64)/i;
			var $matches = [];
			$img.unknown.src = ($matches = $image.match($regexp)) ? $image : $board_url + $image;
			$img.female.src = ($matches = $image_female.match($regexp)) ? $image_female : $board_url + $image_female;
			$img.male.src = ($matches = $image_male.match($regexp)) ? $image_male : $board_url + $image_male;
			break;
		case 'gravatar':
			$img.unknown.src = get_gravatar($image, $img.unknown.width);
			$img.female.src = get_gravatar($image_female, $img.female.width);
			$img.male.src = get_gravatar($image_male, $img.male.width);
			break;
	}
	
	/**
	 * HTML image tag
	 */
	for (var $gender in $img) {
		$html += '<img class="avatar-preview" ';
		$html += 'src="' + $img[$gender].src + '" ';
		$html += 'width="' + $img[$gender].width + '" ';
		$html += 'height="' + $img[$gender].height + '" ';
		$html += 'style="min-width:' + $min_width + 'px;max-width:' + $max_width + 'px;min-height:' + $min_height + 'px;max-height:' + $max_height + 'px" ';
		$html += '/>';
	}
	
	$previewWrapper.html($html);
}

$(document).on('ready', function() {
	setup_default_avatar_preview();
	$('.default-avatar-control').on('change', function() {
		setup_default_avatar_preview();
	});
	$('.default-avatar-control').on('keydown', function() {
		setup_default_avatar_preview();
	});
	$('.default-avatar-control').on('keyup', function() {
		setup_default_avatar_preview();
	});
});