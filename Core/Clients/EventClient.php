<?php

namespace FllanBot\Core\Clients;



class EventClient {
    public function testAttack() {
        $url = "http://uni111.ogame.us/game/index.php?page=fetchEventbox&ajax=1";
        $response = Request::get($url)->send();
        
        $ongoingAttack = false;
        
        if($response->body->hostile != 0){
             $ongoingAttack = true;
             echo 'ONGOING ATTACK !';
        }
        return $ongoingAttack;
    }
}

?>
