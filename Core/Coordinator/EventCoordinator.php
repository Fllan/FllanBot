<?php

namespace FllanBot\Core\Coordinator;

require_once DIR_CORE . '/Clients/EventClient.php';
require_once DIR_CORE . '/Models/Profile.php';
require_once DIR_CORE . '/Notifications/EmailNotificationProvider.php';

use FllanBot\Core\Models\Profile;
use FllanBot\Core\Clients\EventClient;
use FllanBot\Core\Notifications\EmailNotificationProvider;

class EventCoordinator {
    public function analyze(Profile $profile) {
        $eventClient = new EventClient($authenticationClient);

        if (var_dump($eventClient->countHostileEvents($securityTokens, $profile))) {
            $message = "Ongoing attack(s) !";
            EmailNotificationProvider::notify($message, $profile);
        }
    }
}

?>