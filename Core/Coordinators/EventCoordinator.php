<?php

namespace FllanBot\Core\Coordinators;

require_once DIR_CORE . '/Clients/IEventClient.php';
require_once DIR_CORE . '/Models/Profile.php';
require_once DIR_CORE . '/Notifications/INotificationProvider.php';

use FllanBot\Core\Clients\IAuthenticationClient;
use FllanBot\Core\Clients\IEventClient;
use FllanBot\Core\Models\Profile;
use FllanBot\Core\Notifications\INotificationProvider;

class EventCoordinator {
    private $authenticationClient;
    private $eventClient;
    private $notificationProvider;

    public function __construct(
        IAuthenticationClient $authenticationClient,
        IEventClient $eventClient,
        INotificationProvider $notificationProvider) {
        $this->authenticationClient = $authenticationClient;
        $this->eventClient = $eventClient;
        $this->notificationProvider = $notificationProvider;
    }

    public function analyze(Profile $profile, array $securityTokens = null) {
        $securityTokens = !is_null($securityTokens) ? $securityTokens :
            $this->authenticationClient->acquireTokens($profile);

        if ($this->eventClient->countHostileEvents($securityTokens, $profile) > 0) {
            $this->notificationProvider->notify('Ongoing attack(s) !', $profile);
        }
    }
}

?>