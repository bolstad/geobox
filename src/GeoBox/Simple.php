<?php

NameSpace GeoBox {


	class Simple {
		function __construct() {
			echo "Hello Geobox!\n";
		}

		/**
		 * Based on the concept by David Strachan, http://stackoverflow.com/a/19103041
		 *
		 * @param type    $polySides
		 * @param type    $polyX
		 * @param type    $polyY
		 * @param type    $x
		 * @param type    $y
		 * @return type
		 */
		function pointInPolygon( $polySides, $polyX, $polyY, $x, $y ) {
			$j = $polySides-1 ;
			$oddNodes = 0;
			for ( $i=0; $i<$polySides; $i++ ) {
				if ( $polyY[$i]<$y && $polyY[$j]>=$y
					||  $polyY[$j]<$y && $polyY[$i]>=$y ) {
					if ( $polyX[$i]+( $y-$polyY[$i] )/( $polyY[$j]-$polyY[$i] )*( $polyX[$j]-$polyX[$i] )<$x ) {
						$oddNodes=!$oddNodes; }}
				$j=$i; }

			return $oddNodes; }
	}
}
