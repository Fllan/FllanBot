<?php

namespace FllanBot\Core\Utils;

class EndpointUtil {
    public static function buildEndpointUrl($serverUrl, $url) {
        return sprintf('http://%s/%s', rtrim($serverUrl, '/'), ltrim($url, '/'));
    }
}

?>