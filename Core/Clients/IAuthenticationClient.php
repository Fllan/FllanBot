<?php

namespace FllanBot\Core\Clients;

use FllanBot\Core\Models\Profile;

interface IAuthenticationClient {
    public function authenticate(Profile $profile);
}

?>
