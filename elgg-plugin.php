<?php

$composer_path = '';
if (is_dir(__DIR__ . '/vendor')) {
	$composer_path = __DIR__ . '/';
}

return [
	'entities' => [
		[
			'type' => 'object',
			'subtype' => 'temp_file_upload',
			'class' => TempUploadFile::class,
		],
	],
	'actions' => [
		'dropzone/upload' => [],
	],
	'views' => [
		'default' => [
			'dropzone/lib.js' => $composer_path . 'vendor/bower-asset/dropzone/dist/min/dropzone-amd-module.min.js',
			'css/dropzone/stylesheet' => __DIR__ . '/views/default/dropzone/dropzone.css',
		],
	]
];
