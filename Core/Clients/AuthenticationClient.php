<?php

namespace FllanBot\Core\Clients;

require_once DIR_DEPENDENCIES . '/httpful.phar';
require_once DIR_CORE . '/Models/Profile.php';
require_once '/IAuthenticationClient.php';

use Httpful\Request;
use FllanBot\Core\Models\Profile;

class AuthenticationClient implements IAuthenticationClient {
    public function authenticate(Profile $profile) {
        assert(!is_null($profile));
        assert(!empty($profile->password));
        assert(!empty($profile->serverUrl));
        assert(!empty($profile->username));

        $url = self::buildAuthenticationEndpointUrl($profile);
        $response = Request::get($url)
            ->addHeaders(self::getDefaultHeaders())
            ->expectsHtml()
            ->send();

        assert(!is_null($response));
        assert(!empty($response->body));

        return $response->body;
    }

    private static function buildAuthenticationEndpointUrl(Profile $profile) {
        return sprintf("%s/game/reg/login2.php?login=%s&pass=%s&kid=&v=2",
            rtrim($profile->serverUrl, '/'),
            urlencode($profile->username),
            urlencode($profile->password));
    }

    private static function getDefaultHeaders() {
        return array(
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Accept-Charset' => 'ISO-8859-1,utf-8;q=0.7,*;q=0.3',
            'Accept-Language' => 'fr-FR,fr;q=0.8,en-US;q=0.6,en;q=0.4',
            'Connection' => 'close',
            'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17))');
    }
}

?>
