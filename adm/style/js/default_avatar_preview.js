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

function image_exists($url, $extensions) {	
	var $data = {
		exists: false,
		extension: ''
	};
	
	for (var $i = 0; $i < $extensions.length; $i++) {
		$.ajax({
			url: $url + '.' + $extensions[$i],
			async: false,
			type: 'HEAD',
			success: function() {
				$data.extension = $extensions[$i];
				$data.exists = true;
			}
		});
	}
	
	return $data;
}

function setup_default_avatar_preview() {
	var $previewWrapper = $('#default_avatar_preview');
	var $board = {
		url: $.trim($previewWrapper.attr('data-board-url')),
		style_path: $.trim($previewWrapper.attr('data-board-style')),
		gallery_path: 'images/avatars/gallery/'
	};
	var $image = {
		unknown: $.trim($('#default_avatar_image').val()),
		female: $.trim($('#default_avatar_image_female').val()),
		male: $.trim($('#default_avatar_image_male').val())
	};
	var $dimensions = {
		max: {
			width: parseInt($.trim($previewWrapper.attr('data-max-width'))),
			height: parseInt($.trim($previewWrapper.attr('data-max-height')))
		},
		min: {
			width: parseInt($.trim($previewWrapper.attr('data-min-width'))),
			height: parseInt($.trim($previewWrapper.attr('data-min-height')))
		},
		current: {
			width: parseInt($.trim($('#default_avatar_width').val())),
			height: parseInt($.trim($('#default_avatar_height').val()))
		}
	};
	var $type = $.trim($('[name="default_avatar_type"]:checked').val());
	var $extensions = $.trim($previewWrapper.attr('data-image-extensions')).split(',');
	
	var $img = {
		unknown: {src: '', width: $dimensions.current.width, height: $dimensions.current.height},
		female: {src: '', width: $dimensions.current.width, height: $dimensions.current.height},
		male: {src: '', width: $dimensions.current.width, height: $dimensions.current.height}
	};
	var $html = '';
	
	switch ($type) {
		case 'local':
			$img.unknown.src = $board.url + $board.gallery_path + $image.unknown;
			$img.female.src = $board.url + $board.gallery_path + $image.female;
			$img.male.src = $board.url + $board.gallery_path + $image.male;
			break;
		case 'style':
			$img.unknown.src = $board.url + 'styles/' + $board.style_path + '/theme/images/no_avatar';
			$img.female.src = $board.url + 'styles/' + $board.style_path + '/theme/images/no_avatar_female';
			$img.male.src = $board.url + 'styles/' + $board.style_path + '/theme/images/no_avatar_male';
			
			// Check if image exists
			var $check = {
				unknown: image_exists($img.unknown.src, $extensions),
				female: image_exists($img.female.src, $extensions),
				male: image_exists($img.male.src, $extensions)
			};
			
			$img.unknown.src += '.' + $check.unknown.extension;
			$img.female.src += '.' + $check.female.extension;
			$img.male.src += '.' + $check.male.extension;
			
			if (!$check.female.exists) {
				$img.female.src = $img.unknown.src;
			}
			
			if (!$check.male.exists) {
				$img.male.src = $img.unknown.src;
			}
			break;
		case 'remote':
			var $regexp = /(https?:\/\/(?:www\.)?)|(data:\w+\/\w+;base64)/i;
			var $matches = [];
			$img.unknown.src = ($matches = $image.unknown.match($regexp)) ? $image.unknown : $board.url + $image.unknown;
			$img.female.src = ($matches = $image.female.match($regexp)) ? $image.female : $board.url + $image.female;
			$img.male.src = ($matches = $image.male.match($regexp)) ? $image.male : $board.url + $image.male;
			break;
		case 'gravatar':
			$img.unknown.src = get_gravatar($image.unknown, $img.unknown.width);
			$img.female.src = get_gravatar($image.female, $img.female.width);
			$img.male.src = get_gravatar($image.male, $img.male.width);
			break;
	}
	
	// Set image
	for (var $gender in $img) {
		$html += '<img class="avatar-preview" ';
		$html += 'src="' + $img[$gender].src + '" ';
		$html += 'width="' + $img[$gender].width + '" ';
		$html += 'height="' + $img[$gender].height + '" ';
		$html += 'style="min-width:' + $dimensions.min.width + 'px;max-width:' + $dimensions.max.width + 'px;min-height:' + $dimensions.min.height + 'px;max-height:' + $dimensions.max.height + 'px" ';
		$html += '/>';
	}
	
	$previewWrapper.html($html);
}

$(document).on('ready', function() {
	setup_default_avatar_preview();
	$('.default-avatar-control').on('change', function() {
		setup_default_avatar_preview();
	});
});