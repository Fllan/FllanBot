<?php

namespace FllanBot\Core\Clients;

require_once '../../Dependencies/httpful.phar';
require_once './IAuthenticationClient.php';

use Httpful\Request;

class AuthenticationClient implements IAuthenticationClient {
    public function authenticate ($settings) {
        $url = 'http://uni111.ogame.us/game/reg/login2.php?login=THE+MUCKRAKER&pass=Branleur69%24&kid=&v=2';
        echo $url;
        $response = Request::get($url)->send();
    }
}

?>
