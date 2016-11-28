<?php

namespace hypeJunction\hypeDropzone;

class Upgrade {
	
	/**
	 * Add custom subtype
	 *
	 * @param string $event  the name of the event
	 * @param string $type   the type of the event
	 * @param mixed  $object supplied params
	 *
	 * @return void
	 */
	public static function registerSubtype($event, $type, $object) {
		
		if (get_subtype_id('object', \TempUploadFile::SUBTYPE)) {
			update_subtype('object', \TempUploadFile::SUBTYPE, \TempUploadFile::class);
		} else {
			add_subtype('object', \TempUploadFile::SUBTYPE, \TempUploadFile::class);
		}
	}
}
