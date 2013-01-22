<?php

define('DIR_ROOT', dirname(__FILE__));
define('DIR_CORE', DIR_ROOT . '/Core/');
define('DIR_DEPENDENCIES', DIR_ROOT . '/Dependencies/');

require_once DIR_CORE . '/Clients/AuthenticationClient.php';
require_once DIR_CORE . '/Clients/EventClient.php';
require_once DIR_CORE . '/Utils/AuthenticationUtil.php';
require_once DIR_DEPENDENCIES . '/httpful.phar';

use FllanBot\Core\Clients\AuthenticationClient;
use FllanBot\Core\Clients\EventClient;
use FllanBot\Core\Models\Profile;
use FllanBot\Core\Utils\AuthenticationUtil;
use Httpful\Request;

$profile = new Profile();
$profile->serverUrl = 'uni111.ogame.us';
$profile->username = 'THE MUCKRAKER';
$profile->password = 'Branleur69$';

$authenticationClient = new AuthenticationClient();
$securityTokens = $authenticationClient->acquireTokens($profile);

$eventClient = new EventClient($authenticationClient);
var_dump($eventClient->countHostileEvents($securityTokens, $profile) !== 0);

?>
