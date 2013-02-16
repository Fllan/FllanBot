<?php

namespace FllanBot\Core\Clients;

require_once DIR_CORE . '/Models/Profile.php';
require_once DIR_CORE . '/Utils/AuthenticationUtil.php';
require_once DIR_CORE . '/Utils/EndpointUtil.php';
require_once '/IAuthenticationClient.php';

use FllanBot\Core\Models\Profile;
use FllanBot\Core\Utils\AuthenticationUtil;
use FllanBot\Core\Utils\EndpointUtil;
use Httpful\Request;

class EventClient {
    private $authenticationClient;

    public function __construct(IAuthenticationClient $authenticationClient) {
        $this->authenticationClient = $authenticationClient;
    }

    // Test if a hostile event is coming (return '0' if no event)
    public function countHostileEvents(array $tokens, Profile $profile) {
        return Request::get(EndpointUtil::buildEndpointUrl($profile->serverUrl, '/game/index.php?page=fetchEventbox&ajax=1'))
            ->addHeaders(self::buildHeaders($tokens, $profile))
            ->expectsJson()
            ->send()
            ->body
            ->hostile;
    }


    private function buildHeaders(array $tokens, Profile $profile) {
        return array(
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Accept-Charset' => 'ISO-8859-1,utf-8;q=0.7,*;q=0.3',
            'Accept-Language' => 'fr-FR,fr;q=0.8,en-US;q=0.6,en;q=0.4',
            'Connection' => 'close',
            'Cookie' => $this->useOrAcquireTokens($tokens, $profile),
            'Host' => $profile->serverUrl,
            'Referer' => sprintf('http://%s/game/index.php?page=overview', $profile->serverUrl),
            'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17))',
            'X-Requested-With' => 'XMLHttpRequest');
    }

    private function useOrAcquireTokens(array $tokens, Profile $profile) {
        return AuthenticationUtil::serializeTokens(!empty($tokens) ? $tokens :
            $this->authenticationClient->acquireTokens($profile));
    }
}

?>
