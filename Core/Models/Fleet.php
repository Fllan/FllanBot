<?php

namespace FllanBot\Core\Models;

class Fleet {
   public $arrivalTime;
   public $arrivalDate;
   public $origin; // coordinates of departure
   public $target; // coordinates of target
   public $ships; // composition of the fleet (how many and what kind of ships)
   public $player;
}

?>
