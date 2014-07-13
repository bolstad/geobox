<?php

namespace GeoBox\Location;

class Point { 

	var $label;
	var $x;
	var $y; 

	function __construct( $args ) {
		if (isset($args['label'])) 
			$this->setLabel($args['label']);

		if (isset($args['x'])) 
			$this->setX($args['x']);

		if (isset($args['y'])) 
			$this->setY($args['y']);

	}

	public function setLabel( $label ) {
		$this->label = $label;
	}

	public function setX( $x ) {
		$this->x = $x;
	}

	public function setY( $y ) {
		$this->y = $y;
	}

	public function getY() {
		return $this->y; 
	}

	public function getX() {
		return $this->x;
	}

	public function getLabel() {
		return $this->label;
	}
}

