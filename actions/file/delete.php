<?php
/**
* Elgg file delete
*
* NOTE: this file is only used if the file plugin is NOT active
*
* @package ElggFile
*/

$guid = (int) get_input('guid');

$file = get_entity($guid);
if (!$file instanceof ElggFile) {
	register_error(elgg_echo("entity:delete:item_not_found"));
	forward('file/all');
}
/* @var ElggFile $file */

if (!$file->canEdit()) {
	register_error(elgg_echo("entity:delete:permission_denied"));
	forward($file->getURL());
}

$container = $file->getContainerEntity();
$title = $file->getDisplayName();
if (!$file->delete()) {
	register_error(elgg_echo("entity:delete:fail", [$title]));
} else {
	system_message(elgg_echo("entity:delete:success", [$title]));
}

if (elgg_instanceof($container, 'group')) {
	forward("file/group/$container->guid/all");
} else {
	forward("file/owner/$container->username");
}
