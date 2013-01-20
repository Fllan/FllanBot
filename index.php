<?php

define('DIR_ROOT', dirname(__FILE__));
define('DIR_CORE', DIR_ROOT . '/Core/');
define('DIR_DEPENDENCIES', DIR_ROOT . '/Dependencies/');

require_once DIR_CORE . '/Clients/AuthenticationClient.php';

use FllanBot\Core\Clients\AuthenticationClient;
use FllanBot\Core\Models\Profile;

$profile = new Profile();
$profile->serverUrl = 'http://uni111.ogame.us/';
$profile->username = 'THE MUCKRAKER';;
$profile->password = 'Branleur69$';

$client = new AuthenticationClient();
$content = $client->authenticate($profile);
echo htmlentities($content);

?>