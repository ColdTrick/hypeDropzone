<?php

class TempUploadFile extends ElggFile {
	
	const SUBTYPE = 'temp_file_upload';
	
	/**
	 * @inheritdoc
	 */
	protected function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = self::SUBTYPE;
	}
}
