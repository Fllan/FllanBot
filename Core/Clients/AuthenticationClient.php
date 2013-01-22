<?php

namespace FllanBot\Core\Clients;

require_once DIR_CORE . '/Models/Profile.php';
require_once DIR_CORE . '/Models/Token.php';
require_once '/IAuthenticationClient.php';

use FllanBot\Core\Models\Profile;
use FllanBot\Core\Models\Token;
use FllanBot\Core\Utils\EndpointUtil;

class AuthenticationClient implements IAuthenticationClient {
    public function acquireTokens(Profile $profile) {
        return self::extractTokens(
            file_get_contents(
                self::buildEndpointUrl($profile),
                FALSE, stream_context_create(array(
                    'http' => array( 
                        'method' => 'GET',
                        'follow_location' => FALSE,
                        'header' => self::createHeaders(array()))))),
            $http_response_header);
    }

    private static function buildEndpointUrl(Profile $profile) {
        return EndpointUtil::buildEndpointUrl($profile->serverUrl,
            sprintf("/game/reg/login2.php?login=%s&pass=%s&kid=&v=2",
                urlencode($profile->username),
                urlencode($profile->password)));
    }

    private static function createHeaders(array $headers) {
        return !empty($headers) ? $headers : array(
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.3',
            'Accept-Language: fr-FR,fr;q=0.8,en-US;q=0.6,en;q=0.4',
            'Connection: close',
            'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17))');
    }

    private static function createToken(array $cookie) {
        return new Token($cookie[0], substr($cookie[1], 0, strpos($cookie[1], ';')));
    }

    private static function extractTokens($body, array $headers) {
        $tokens = array();
        foreach (self::normalizeHeaders($headers) as $name => $values) {
            if (strcasecmp($name, 'Set-Cookie') === 0) {
                foreach ($values as $value) {
                    $tokens[] = self::createToken(explode('=', $value));
                }
            }
        }

        unset($tokens[0]);
        return $tokens;
    }

    private static function normalizeHeaders(array $headers) {
        $array = array();
        foreach ($headers as $header) {
            if (strpos($header, ':') !== FALSE) {
                list($name, $value) = explode(':', $header);
                $array[trim(strtolower($name))][] = trim($value);
            }
        }

        return $array;
    }
}

?>
