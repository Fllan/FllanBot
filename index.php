<?php

define('DIR_ROOT', dirname(__FILE__));
define('DIR_CORE', DIR_ROOT . '/Core/');
define('DIR_DEPENDENCIES', DIR_ROOT . '/Dependencies/');

require_once DIR_CORE . '/Clients/AuthenticationClient.php';
require_once DIR_CORE . '/Clients/EventClient.php';
require_once DIR_CORE . '/Utils/AuthenticationUtil.php';
require_once DIR_CORE . '/email.php';
require_once DIR_DEPENDENCIES . '/httpful.phar';

use FllanBot\Core\Clients\AuthenticationClient;
use FllanBot\Core\Clients\EventClient;
use FllanBot\Core\Models\Profile;
use FllanBot\Core\Utils\AuthenticationUtil;
use Httpful\Request;
use FllanBot\Core\Email;

$profile = new Profile();
$profile->serverUrl = 'uni111.ogame.us';
$profile->username = 'THE MUCKRAKER';
$profile->password = 'Branleur69$';
$profile->email = 'ogame@lanternier.net';

$authenticationClient = new AuthenticationClient();
$securityTokens = $authenticationClient->acquireTokens($profile);

$analyze = new EventCoordinator();
$analyze->analyze($profile);


/*
$eventClient = new EventClient($authenticationClient);
var_dump($eventClient->countHostileEvents($securityTokens, $profile));
*/
?>