<?php

namespace FllanBot\Core\Clients;

require_once DIR_DEPENDENCIES . '/httpful.phar';
require_once DIR_CORE . '/Models/Profile.php';
require_once DIR_CORE . '/Models/Token.php';
require_once '/IAuthenticationClient.php';

use Httpful\Request;
use FllanBot\Core\Models\Profile;
use FllanBot\Core\Models\Token;

class AuthenticationClient implements IAuthenticationClient {
    public function authenticate(Profile $profile) {
        return self::extractToken(
            Request::get(self::buildEndpointUrl($profile))
                ->addHeaders(self::createHeaders(array()))
                ->expectsHtml()
                ->send());
    }

    private static function buildEndpointUrl(Profile $profile) {
        return sprintf("%s/game/reg/login2.php?login=%s&pass=%s&kid=&v=2",
            rtrim($profile->serverUrl, '/'),
            urlencode($profile->username),
            urlencode($profile->password));
    }

    private static function createHeaders(array $headers) {
        return !empty($headers) ? $headers : array(
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Accept-Charset' => 'ISO-8859-1,utf-8;q=0.7,*;q=0.3',
            'Accept-Language' => 'fr-FR,fr;q=0.8,en-US;q=0.6,en;q=0.4',
            'Connection' => 'close',
            'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17))');
    }

    private static function createToken(array $cookie) {
        return new Token($cookie[0], $cookie[1]);
    }

    private static function extractToken($response) {
        if (!empty($response->headers['Set-Cookie'])) {
            return self::createToken(
                explode('=', substr($response->headers['Set-Cookie'], 0,
                    strpos($response->headers['Set-Cookie'], ';'))));
        }

        throw new Exception();
    }
}

?>
