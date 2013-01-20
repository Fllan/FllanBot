<?php

require_once './Core/Clients/AuthenticationClient.php';

use FllanBot\Core\Clients\AuthenticationClient;
use FllanBot\Core\Models\Profile;

$profile = new Profile();
$profile->serverUrl = 'truc';
$profile->username = 'machin';
$profile->password = 'machine';

$client = new AuthenticationClient();
$client->authenticate($profile);

?>