<?php

/**
 * Drag&Drop File Uploads
 *
 * @author Ismayil Khayredinov <info@hypejunction.com>
 * @copyright Copyright (c) 2015-2016, Ismayil Khayredinov
 */
require_once __DIR__ . '/autoloader.php';

elgg_register_event_handler('init', 'system', function() {
	
	elgg_register_action('dropzone/upload', __DIR__ . '/actions/dropzone/upload.php');

	// @see views.php for view locations
	elgg_extend_view('elgg.css', 'css/dropzone/stylesheet');
	elgg_extend_view('admin.css', 'css/dropzone/stylesheet');
	
	elgg_register_plugin_hook_handler('view_vars', 'input/file', '\hypeJunction\hypeDropzone\Views::fileToDropzone');
	elgg_register_plugin_hook_handler('view_vars', 'input/dropzone', '\hypeJunction\hypeDropzone\Views::preventDropzoneDeadloop');
	
	elgg_register_plugin_hook_handler('action', 'all', '\hypeJunction\hypeDropzone\Actions::prepareFiles');
	
	elgg_register_plugin_hook_handler('cron', 'daily', '\hypeJunction\hypeDropzone\Cron::cleanupTempUploadedFiles');
	
	elgg_register_event_handler('upgrade', 'system', '\hypeJunction\hypeDropzone\Upgrade::registerSubtype');
	
	if (!elgg_is_active_plugin('file')) {
		elgg_register_action('file/delete', dirname(__FILE__) . '/actions/file/delete.php');
	}
});
