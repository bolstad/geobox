<?php

namespace GeoBox\Parser;

/**
 * Parse Ingress DrawTool 'export' formated JSON data and return a object with polygon data
 */
class DrawTool {

	var $polygonData = array();
	var $label;

	var $polyX;
	var $polyY;

	/**
	 * Constructor that take optional parameters
	 *
	 * @param array   $args
	 */
	function __construct( $args = array() ) {
		if ( isset( $args['data'] ) ) {
			$this->parseJson( $args['data'] );
		}
		if ( isset( $args['label'] ) ) {
			$this->setLabel( $args['label'] );
		}
	}

	/**
	 * Parse the DrawTool JSON
	 *
	 * @param array   $data
	 */
	public function parseJson( $data ) {
		if ( !$parsedData = json_decode( $data, 1 ) )
			throw new \Exception( "Could not parse Drawtool JSON data: '$data'" );

		if ( count( $parsedData ) > 1 )
			throw new \Exception( "Base array contains more than one node" );

		if ( !isset( $parsedData[0]['type'] ) )
			throw new \Exception( "Polygon type is not set" );

		if ( $parsedData[0]['type'] =! 'polygon' )
			throw new \Exception( "Type is not set to 'polygon" );

		$this->polygonData = $parsedData[0]['latLngs'];

		foreach ( $this->polygonData as $point ) {
			$this->polyX[] = $point['lng'];
			$this->polyY[] = $point['lat'];
		}
	}

	/**
	 * Set the polygon label
	 *
	 * @param string  $label
	 */
	public function setLabel( $label ) {
		$this->label = $label;
	}

	/**
	 * Return polygon lable
	 *
	 * @return string
	 */
	public function getLabel() {
		return $this->label;
	}

	/**
	 * Return polygon data as a paired array
	 *
	 * @return array
	 */
	public function getPolygonData() {
		return $this->polygonData;
	}

	/**
	 * Return array of Y-coordinates in polygons points
	 *
	 * @return array
	 */
	public function getPolyY() {
		return $this->polyY;
	}

	/**
	 * Return array of X-coordinates in polygons points
	 *
	 * @return array
	 */
	public function getPolyX() {
		return $this->polyX;
	}

}
