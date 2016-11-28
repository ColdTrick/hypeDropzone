<?php
/**
 * Called when the plugin is activated
 *
 */

if (get_subtype_id('object', \TempUploadFile::SUBTYPE)) {
	update_subtype('object', \TempUploadFile::SUBTYPE, \TempUploadFile::class);
} else {
	add_subtype('object', \TempUploadFile::SUBTYPE, \TempUploadFile::class);
}
