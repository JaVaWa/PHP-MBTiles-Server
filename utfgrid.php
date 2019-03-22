<?php
$zoom = intval ($_GET['z']);
$column = intval ($_GET['x']);
$row = pow (2, $zoom) - 1 - intval ($_GET['y']);
$layer = $_GET['layer'];
$callback = '';
if (isset ($_GET['callback'])) $callback = $_GET['callback'];
header ('Content-Type: text/javascript; charset=UTF-8');
$db = new PDO ('sqlite:' . $layer . '.mbtiles');
$data = $db->prepare ('SELECT grid FROM grids WHERE zoom_level=' . $zoom . ' AND tile_column=' . $column . ' AND tile_row=' . $row);
$data->execute();
$grid = $data->fetchObject();
if (isset ($grid->grid)) {
	if ($callback) echo $callback . '(';
	echo substr (gzinflate (substr ($grid->grid, 2)), 0, -1) . ', "data": {';
	$data = $db->prepare ('SELECT key_name,key_json FROM grid_data WHERE zoom_level=' . $zoom . ' AND tile_column=' . $column . ' AND tile_row=' . $row);
	$data->execute();
	$i = 0;
	while ($grid_data = $data->fetchObject()) {
		if ($i) echo ',';
		$i = 1;
		echo '"' . $grid_data->key_name . '":' . $grid_data->key_json;
	}
	echo '}}';
	if ($callback) echo ');';
} else {
	if (!$callback) echo '{"keys": [""], "data": {}, "grid": ["                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                ", "                                                                "]}';
}
?>
