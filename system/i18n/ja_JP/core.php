<?php defined('SYSPATH') OR die('No direct access allowed.');

$lang = array
(
	'there_can_be_only_one' => 'ページリクエストあたりのKohanaインスタンスはひとつだけです',
	'uncaught_exception'    => 'Uncaught %s: %s in file %s on line %s',
	'invalid_method'        => '不正なメソッド %s が %s で呼び出されました',
	'invalid_property'      => '%s プロパティは %s クラスにはありません。',
	'log_dir_unwritable'    => 'ログディレクトリに書き込みできません: %s',
	'resource_not_found'    => 'リクエストされた %s, %s, はみつかりません',
	'invalid_filetype'      => 'リクエストされたファイル種別, .%s, はあなたのビュー構成ファイルで許可されていません',
	'view_set_filename'     => 'レンダーを呼び出す前にビューファイル名をセットしなければなりません',
	'no_default_route'      => 'config/routes.php にデフォルトルートをセットしてください',
	'no_controller'         => 'Kohana はこのリクエストを処理するコントローラを決定できませんでした: %s',
	'page_not_found'        => 'リクエストされたページ, %s, は見つかりません。',
	'stats_footer'          => 'ロード時間 {execution_time} 秒, メモリ使用量 {memory_usage} 。Kohana v{kohana_version} 作成。',
	'error_file_line'       => '<tt>%s <strong>[%s]:</strong></tt>',
	'stack_trace'           => 'Stack Trace',
	'generic_error'         => 'リクエストを完了できません',
	'errors_disabled'       => '<a href="%s">home page</a> または <a href="%s">やり直し</a>に行けます。',

	// Drivers
	'driver_implements'     => 'The %s driver for the %s library must implement the %s interface',
	'driver_not_found'      => 'The %s driver for the %s library could not be found',

	// Resource names
	'config'                => '構成ファイル',
	'controller'            => 'コントローラ',
	'helper'                => 'ヘルパー',
	'library'               => 'ライブラリ',
	'driver'                => 'ドライバ',
	'model'                 => 'モデル',
	'view'                  => 'ビュー',
);
