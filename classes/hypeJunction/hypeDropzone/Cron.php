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
		
		echo 'Starting hypeDropzone cleanup' . PHP_EOL;
		elgg_log('Starting hypeDropzone cleanup', 'NOTICE');
		
		// ignore access
		elgg_call(ELGG_IGNORE_ACCESS, function() {
			// prepare batch
			$batch = new \ElggBatch('elgg_get_entities', [
				'type' => 'object',
				'subtype' => \TempUploadFile::SUBTYPE,
				'limit' => false,
				'created_before' => '-1 day',
			]);
			$batch->setIncrementOffset(false);
			
			// loop through old files
			/* @var $file \TempUploadFile */
			foreach ($batch as $file) {
				$file->delete();
			}
		});
		
		echo 'Done with hypeDropzone cleanup' . PHP_EOL;
		elgg_log('Done with hypeDropzone cleanup', 'NOTICE');
	}
}
