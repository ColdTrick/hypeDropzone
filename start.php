<?php
/**
 * Drag&Drop File Uploads
 *
 * @author Ismayil Khayredinov <info@hypejunction.com>
 * @copyright Copyright (c) 2015-2016, Ismayil Khayredinov
 */

elgg_register_event_handler('init', 'system', function() {
	
	// @see elgg-plugin.php for view locations
	elgg_extend_view('elgg.css', 'css/dropzone/stylesheet');
	elgg_extend_view('admin.css', 'css/dropzone/stylesheet');
	
	elgg_register_plugin_hook_handler('view_vars', 'input/file', '\hypeJunction\hypeDropzone\Views::fileToDropzone');
	elgg_register_plugin_hook_handler('view_vars', 'input/dropzone', '\hypeJunction\hypeDropzone\Views::preventDropzoneDeadloop');
	
	elgg_register_plugin_hook_handler('action', 'all', '\hypeJunction\hypeDropzone\Actions::prepareFiles');
	
	elgg_register_plugin_hook_handler('cron', 'daily', '\hypeJunction\hypeDropzone\Cron::cleanupTempUploadedFiles');
});
