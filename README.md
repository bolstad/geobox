geobox
======

The simple way: 

```

$geobox = new GeoBox\Simple;

$polySides  = 8; //how many corners the polygon has
$polyX    =  array( 12.548740, 12.541320, 12.537410, 12.535310, 12.534499, 12.535787, 12.538100, 12.543890, 12.548740 );//horizontal coordinates of corners
$polyY    =  array( 55.694469, 55.687840, 55.690552, 55.694641, 55.695293, 55.696625, 55.696911, 55.697659, 55.694469 );//vertical coordinates of corners
$x = 12.548740;
$y = 55.694469;


if ($geobox->isPointInPolygon($polyX,$polyY,$x,$y)){
  echo "Is in polygon!\n";
}
else echo "Is not in polygon\n";

```

Or with some helper objects: 


```
// Kungsholmen is an island in Stockholm, Sweden. 'data' is a IITC Drawtool export of a polygon covering the island
$parser = new GeoBox\Parser\DrawTool(
	array (
		'data' => '[{"type":"polygon","latLngs":[{"lat":59.33712917242916,"lng":17.993974685668945},{"lat":59.341943796898505,"lng":18.006291389465332},{"lat":59.33520313154757,"lng":18.046588897705078},{"lat":59.32990595603571,"lng":18.052854537963867},{"lat":59.32767301480689,"lng":18.058090209960938},{"lat":59.325133413122515,"lng":18.05577278137207},{"lat":59.32539613933905,"lng":18.04203987121582},{"lat":59.327410306192064,"lng":18.028478622436523},{"lat":59.323075320824685,"lng":18.023414611816406},{"lat":59.329949737730324,"lng":17.993974685668945}],"color":"#a24ac3"}]',
		'label' => 'SE:STOCKHOLM:STOCKHOLM:KUNGSHOLMEN'
	)
);

// 'Resande med djur' is a public artwork on T-Kristineberg (on Kungsholmen)
$onKungsholmen = new GeoBox\Location\Point( array(
		'label' => 'Public Artwork: Resande med djur',
		'x' => 18.004639,
		'y' => 59.332444 )
);

// 'Tranebergsstugan' is a cabin in Alvik, Stockholm - close, but not on the island Kungsholmen 
$offKungsholmen = new GeoBox\Location\Point( array(
		'label' => 'Building: Tranebergsstugan',
		'x' => 17.990457,
		'y' => 59.333161 )
);

$geobox = new GeoBox\Simple;

foreach ( array( $onKungsholmen, $offKungsholmen ) as $check ) {
	if ( $geobox->isPointObjInPolygon( $check, $parser ) )
		echo $check->getLabel() . " was found in polygon " . $parser->getLabel() . "!\n";
	else
		echo $check->getLabel() . " was *not* found in polygon " . $parser->getLabel() . "\n";

}


```

=== Credits === 

The basic polynom matching is based on the algorithm by David Strachan as presented on http://stackoverflow.com/a/19103041.