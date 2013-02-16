<?php

namespace FllanBot\Core\Notifications;

require_once DIR_CORE . '/Models/Profile.php';

use FllanBot\Core\Models\Profile;

interface INotificationProvider {
    public function notify($message, Profile $profile);
}

?>