PHP-MBTiles-Server
==================

### About

An extremely simple PHP script for extracting images from an [MBTiles](https://github.com/mapbox/mbtiles-spec) sqlite database file. Example for use with [Leaflet](http://leaflet.cloudmade.com/) included.

Two scripts are provided: one to extract the images from the MBTiles database, and another one to extract UTFGrid data.

Forked from https://github.com/bmcbride/PHP-MBTiles-Server

### Dependencies

- [PHP with PDO_SQLITE enabled](http://php.net/manual/en/ref.pdo-sqlite.php)

### Usage
```
sampleLayer = L.tileLayer('mbtiles.php?layer={filename-without-extension}&z={z}&x={x}&y={y}').addTo(map);

utfgridLayer = new L.UtfGrid('utfgrid.php?layer={filename-without-extension}&z={z}&x={x}&y={y}?callback={cb}', {resolution: 4});

map.addLayer(utfgridLayer);

utfgridLayer.on('click', function (e) {
  if (e.data) {
    //add code to do something when clicking the feature
  }
});

utfgridLayer.on('mouseover', function (e) {
  if (e.data) {
			//add code to show something like a label on mouseover
		}
});

utfgridLayer.on('mouseout', function (e) {
  //add code to hide/remove the label
});
```

### Adapting .htaccess for nicer URLs

Add the following to an .htaccess file:
```
RewriteEngine On
RewriteRule ^tiles/(.+)/(.+)/(.+)/(.+)\.png$ /tiles/mbtiles.php?layer=$1&z=$2&x=$3&y=$4 [L]
RewriteRule ^tiles/(.+)/(.+)/(.+)/(.+)\.grid\.json$ /tiles/utfgrid.php?layer=$1&z=$2&x=$3&y=$4 [QSA,L]
```

Now you can use a URLs like

`/tiles/{layer}/{z}/{x}/{y}.png`

and

`/tiles/{layer}/{z}/{x}/{y}.grid.json?callback={cb}`

### Note

MBTiles files generated from [TileMill](http://mapbox.com/tilemill/) (currently) use the "TMS" tiling scheme. These scripts have been adapted, so that you can use the "XYZ" tiling scheme directly.
