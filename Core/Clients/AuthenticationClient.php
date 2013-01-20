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

        echo sprintf("%s/game/reg/login2.php?login=%s&pass=%s&kid=&v=2",
            $profile->serverUrl, $profile->username, $profile->password);
    }
}

?>
