<?php

namespace FllanBot\Core\Notifications;

require_once DIR_CORE . '/Models/Profile.php';
require_once 'INotificationProvider.php';

use FllanBot\Core\Models\Profile;

class EmailNotificationProvider implements INotificationProvider {
    public function notify($message, Profile $profile) {
        if (mail($profile->email, $subject, 'Something is happening on your OGame account !')) {
            echo '<p>Message successfully sent !</p>';
        } else {
            echo '<p>Message delivery failed...</p>';
        }
    }
}

?>