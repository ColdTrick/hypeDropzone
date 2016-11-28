<?php
/**
 * Called when the plugin is deactivated
 */

update_subtype('object', \TempUploadFile::SUBTYPE);
