<?php

namespace hypeJunction\hypeDropzone;

use \Elgg\ViewsService;

class Views {
	
	/**
	 * Make an input/file into a dropzone
	 *
	 * @param string $hook         the name of the hook
	 * @param string $type         the type of the hook
	 * @param mixed  $return_value current return value
	 * @param mixed  $params       supplied params
	 *
	 * @return mixed
	 */
	public static function fileToDropzone($hook, $type, $return_value, $params) {
		
		$prevent_deadloop = isset($return_value['__hypeDropzone']);
		unset($return_value['__hypeDropzone']);
		
		if ($prevent_deadloop) {
			return $return_value;
		}
		
		$vars = $return_value;
		$vars['subtype'] = \TempUploadFile::SUBTYPE;
		$vars['multiple'] = (bool) elgg_extract('multiple', $return_value, false);
		if (!$vars['multiple']) {
			$vars['max'] = 1;
		}
		
		$return_value[ViewsService::OUTPUT_KEY] = elgg_view('input/dropzone', $vars);
		
		return $return_value;
	}
	
	/**
	 * Set a flag in input/dropzone to prevent deadloops with input/file
	 *
	 * @param string $hook         the name of the hook
	 * @param string $type         the type of the hook
	 * @param mixed  $return_value current return value
	 * @param mixed  $params       supplied params
	 *
	 * @return mixed
	 */
	public static function preventDropzoneDeadloop($hook, $type, $return_value, $params) {
		
		$return_value['__hypeDropzone'] = true;
		
		return $return_value;
	}
}
