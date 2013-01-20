<?php

define('DIR_ROOT', dirname(__FILE__));
define('DIR_CORE', DIR_ROOT . '/Core/');
define('DIR_DEPENDENCIES', DIR_ROOT . '/Dependencies/');

require_once DIR_CORE . '/Clients/AuthenticationClient.php';

use FllanBot\Core\Clients\AuthenticationClient;
use FllanBot\Core\Models\Profile;

$profile = new Profile();
$profile->serverUrl = 'truc';
$profile->username = 'machin';
$profile->password = 'machine';

$client = new AuthenticationClient();
$client->authenticate($profile);
?>
