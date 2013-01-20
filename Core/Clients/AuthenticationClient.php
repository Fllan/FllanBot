<?php

namespace FllanBot\Core\Clients;

require_once '../../Dependencies/httpful.phar';
require_once './IAuthenticationClient.php';

use Httpful\Request;
use FllanBot\Core\Models\Profile;

class AuthenticationClient implements IAuthenticationClient {
    public function authenticate(Profile $profile) {
        echo sprintf("%s/game/reg/login2.php?login=%s&pass=%s&kid=&v=2",
            $profile->serverUrl, $profile->username, $profile->password);
    }
}

?>
