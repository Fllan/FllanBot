<?php

namespace FllanBot\Core\Utils;

class AuthenticationUtil {
    public static function serializeTokens(array $tokens) {
        $value = '';
        foreach ($tokens as $token) {
            $value .= sprintf('%s=%s; ', $token->name, $token->value);
        }

        return rtrim(trim($value), ';');
    }
}

?>