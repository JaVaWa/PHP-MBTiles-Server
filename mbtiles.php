<?php
$expires = 86400; // cache images for 24 hours
header ('Pragma: public');
header ('Cache-Control: maxage=' . $expires);
header ('Expires: ' . gmdate('D, d M Y H:i:s', time() + $expires) . ' GMT');
header ('Content-Type: image/png');
$zoom = intval ($_GET['z']);
$column = intval ($_GET['x']);
$row = pow (2, $zoom) - 1 - intval ($_GET['y']);
$db = new PDO ('sqlite:' . $_GET['layer'] . '.mbtiles');
$data = $db->prepare ('SELECT tile_data FROM tiles WHERE zoom_level=' . $zoom . ' AND tile_column=' . $column . ' AND tile_row=' . $row);
$data->execute();
$png = $data->fetchObject();
if (isset ($png->tile_data)) {
	echo $png->tile_data;
// To handle requests outside the area that the mbtiles file covers,
// add a blank png file with a width and height of 256 pixels
// and uncomment the next two lines:
//} else {
//	readfile ('256x256.png');
}
?>
