<?php

namespace FllanBot\Core\Models;

class PositionType {
	const Planet = 0;
	const Moon = 1;
	const DebrisField = 2;
}

class Coordinates {
	public $galaxy;
	public $system;
	public $position;
	public $positionType;
}

?>
