PHP-MBTiles-Server
==================

### About

An extremely simple PHP script for extracting images from an [MBTiles](https://github.com/mapbox/mbtiles-spec) sqlite database file. Examples for use with [Leaflet](http://leaflet.cloudmade.com/) and [OpenLayers](http://openlayers.org/) included.
Forked from https://github.com/bmcbride/PHP-MBTiles-Server

### Dependencies

- [PHP with PDO_SQLITE enabled](http://php.net/manual/en/ref.pdo-sqlite.php)

### Limitations

There are two scripts: one to extract the images from the MBTiles database, and another one to extract UTFGrid data.

### Note

MBTiles files generated from [TileMill](http://mapbox.com/tilemill/) (currently) use the "TMS" tiling scheme. These scripts have been adapted, so that you can use the "XYZ" tiling scheme directly.
