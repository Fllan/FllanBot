<?php

namespace FllanBot\Core\Notifications;

interface INotificationProvider {
    public function notify($message, Profile $profile);
}

?>