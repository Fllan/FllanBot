<?php

namespace FllanBot\Core\Clients;

require_once DIR_CORE . '/Models/Profile.php';
require_once DIR_CORE . '/Models/Token.php';
require_once '/IAuthenticationClient.php';

use FllanBot\Core\Models\Profile;
use FllanBot\Core\Models\Token;


class EventClient {
    public function testAttack() {
        $ongoingAttack = false;
        
        $url = 'http://uni111.ogame.us/game/index.php?page=fetchEventbox&ajax=1';
        $response = Request::get($url)
        ->addHeaders(array(
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Accept-Charset' => 'ISO-8859-1,utf-8;q=0.7,*;q=0.3',
            'Accept-Language' => 'fr-FR,fr;q=0.8,en-US;q=0.6,en;q=0.4',
            'Connection' => 'close',
            'Cookie' => AuthenticationUtil::serializeTokens($tokens),
            'Host' => 'uni111.ogame.us',
            'Origin' => 'http://uni111.ogame.us',
            'Referer' => 'http://uni111.ogame.us/game/index.php?page=overview',
            'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17))',
            'X-Requested-With' => 'XMLHttpRequest'))
        ->send();

        
        if($response->body->hostile != 0){
             $ongoingAttack = true;
             echo 'ONGOING ATTACK !';
        }
        else {
            echo 'Don\'t worry, be happy !';
        }
        return $ongoingAttack;
    }
}

?>
