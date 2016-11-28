<?php

namespace hypeJunction\hypeDropzone;

class Cron {
	
	/**
	 * Cleanup temp uploaded files which were left behind
	 *
	 * @param string $hook         the name of the hook
	 * @param string $type         the type of the hook
	 * @param mixed  $return_value current return value
	 * @param mixed  $params       supplied params
	 *
	 * @return void
	 */
	public static function cleanupTempUploadedFiles($hook, $type, $return_value, $params) {
		
		$time = (int) elgg_extract('time', $params, time());
		
		// ignore access
		$ia = elgg_set_ignore_access(true);
		
		// prepare batch
		$batch = new \ElggBatch('elgg_get_entities', [
			'type' => 'object',
			'subtype' => \TempUploadFile::SUBTYPE,
			'limit' => false,
			'created_time_upper' => ($time - (24 * 60 * 60)), // older than 1 day
		]);
		$batch->setIncrementOffset(false);
		
		// loop through old files
		/* @var $file \TempUploadFile */
		foreach ($batch as $file) {
			$file->delete();
		}
		
		// restore access
		elgg_set_ignore_access($ia);
	}
}
