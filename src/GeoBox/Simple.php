<?php

NameSpace GeoBox {


	class Simple {
		function __construct() {
		}

		/**
		 * Check if a given point with coordinates $x and $y exist in a polygon with the
		 * edges defined in the arrays $polyX and $polyY
		 *
		 * There might (must?) be a more efficent way to calculate this but since I'm meh in
		 * math this *simple* method work good enough for me.
		 *
		 * Based on the concept by David Strachan, http://stackoverflow.com/a/19103041
		 *
		 * @param array   $polyX
		 * @param array   $polyY
		 * @param float   $x
		 * @param float   $y
		 * @return int
		 */
		function isPointInPolygon( $polyX, $polyY, $x, $y ) {
			if ( count( $polyX ) != count( $polyY ) )
				throw new \Exception( 'Number of points in $polyX (' . count( $polyX ) .  ') and $polyY (' . count( $polyY ) . ') is not identical' );

			$polySides = count( $polyX );
			$j = $polySides-1;
			$oddNodes = 0;

			for ( $i=0; $i<$polySides; $i++ ) {
				if ( $polyY[$i]<$y && $polyY[$j]>=$y ||  $polyY[$j]<$y && $polyY[$i]>=$y ) {
					if ( $polyX[$i]+( $y-$polyY[$i] )/( $polyY[$j]-$polyY[$i] )*( $polyX[$j]-$polyX[$i] )<$x ) {
						$oddNodes=!$oddNodes; }
				}
				$j=$i; }

			return $oddNodes; }

		function isPointObjInPolygon( $pointObj, $polygonObj ) {
			return  $this->isPointInPolygon(
				$polygonObj->getPolyX(),
				$polygonObj->getPolyY(),
				$pointObj->getX(),
				$pointObj->getY()
			);
		}


	}


}
