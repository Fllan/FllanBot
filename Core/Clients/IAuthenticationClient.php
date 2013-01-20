<?php

namespace FllanBot\Core\Clients;

require_once DIR_CORE . '/Models/Profile.php';

use FllanBot\Core\Models\Profile;

interface IAuthenticationClient {
    public function acquireToken(Profile $profile);
}

?>
