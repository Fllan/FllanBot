<?php

namespace FllanBot\Core\Notifications;

require_once DIR_CORE . '/Models/Profile.php';
require_once 'INotificationProvider.php';

class EmailNotificationProvider implements INotificationProvider {
    public function notify($message, Profile $profile) {
        $to = $profile->email;
        $subject = 'Something is happening on your OGame account !';
        if (mail($to, $subject, $message)) {
            echo '<p>Message successfully sent !</p>'
        } else {
            echo '<p>Message delivery failed...</p>'
        }
    }
}

?>