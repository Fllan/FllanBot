<?php

define('DIR_ROOT', dirname(__FILE__));
define('DIR_CORE', DIR_ROOT . '/Core/');
define('DIR_DEPENDENCIES', DIR_ROOT . '/Dependencies/');

require_once DIR_CORE . '/Clients/AuthenticationClient.php';
require_once DIR_DEPENDENCIES . '/httpful.phar';

use FllanBot\Core\Clients\AuthenticationClient;
use FllanBot\Core\Models\Profile;
use Httpful\Request;

$profile = new Profile();
$profile->serverUrl = 'http://uni111.ogame.us/';
$profile->username = 'THE MUCKRAKER';;
$profile->password = 'Branleur69$';

$client = new AuthenticationClient();
$tokens = $client->acquireTokens($profile);

$cookies = '';
foreach ($tokens as $token) {
    $cookies .= sprintf('%s=%s; ', $token->name, $token->value);
}

$url = 'http://uni111.ogame.us/game/index.php?page=fetchEventbox&ajax=1';
$response = Request::get($url)
    ->addHeaders(array(
        'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
        'Accept-Charset' => 'ISO-8859-1,utf-8;q=0.7,*;q=0.3',
        'Accept-Language' => 'fr-FR,fr;q=0.8,en-US;q=0.6,en;q=0.4',
        'Connection' => 'close',
        'Cookie' => rtrim(trim($cookies), ';'),
        'Host' => 'uni111.ogame.us',
        'Origin' => 'http://uni111.ogame.us',
        'Referer' => 'http://uni111.ogame.us/game/index.php?page=overview',
        'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17))',
        'X-Requested-With' => 'XMLHttpRequest'))
    ->send();

echo $response->body;

?>