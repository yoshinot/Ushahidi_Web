<?php defined('SYSPATH') OR die('No direct access allowed.');

$lang = array
(
	'getimagesize_missing'    => 'The Image library requires the getimagesize() PHP function, which is not available in your installation.',
	'unsupported_method'      => 'Your configured driver does not support the %s image transformation.',
	'file_not_found'          => 'The specified image, %s, was not found. Please verify that images exist by using file_exists() before manipulating them.',
	'type_not_allowed'        => '指定された画像, %s, は許可された画像タイプではありません。',
	'invalid_width'           => '指定されたwidth , %s, は正しくありません。',
	'invalid_height'          => '指定されたheight, %s, は正しくありません。',
	'invalid_dimensions'      => '%s 用に指定されたdimension は正しくありません。',
	'invalid_master'          => '指定されたmaster dimension は正しくありません。',
	'invalid_flip'            => '指定されたflip ディレクトリは正しくありません。',
	'directory_unwritable'    => '指定されたディレクトリ, %s, は書き込みできません。',

	// ImageMagick specific messages
	'imagemagick' => array
	(
		'not_found' => '指定されたImageMagick ディレクトリには必要なプログラム, %s がありません。',
	),
	
	// GraphicsMagick specific messages
	'graphicsmagick' => array
	(
		'not_found' => '指定されたGraphicsMagick ディレクトリには必要なプログラム, %s がありません。',
	),
	
	// GD specific messages
	'gd' => array
	(
		'requires_v2' => '画像ライブラリにはGD2が必要です。詳しくは http://php.net/gd_info を参照してください。',
	),
);
