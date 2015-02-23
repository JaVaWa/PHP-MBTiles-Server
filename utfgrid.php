<?php
$zoom = intval ($_GET['z']);
$column = intval ($_GET['x']);
$row = pow (2, $zoom) - 1 - intval ($_GET['y']);
header ('Content-Type: text/javascript; charset=UTF-8');
$db = new PDO ('sqlite:' . $_GET['layer'] . '.mbtiles');
$data = $db->prepare ('SELECT grid FROM grids WHERE zoom_level=' . $zoom . ' AND tile_column=' . $column . ' AND tile_row=' . $row);
$data->execute();
$grid = $data->fetchObject();
if (isset($grid->grid)) {
	echo $_GET['callback'] . '(' . substr(gzinflate (substr ($grid->grid, 2)), 0, -1) . ', "data": {';
	$data = $db->prepare ('SELECT key_name,key_json FROM grid_data WHERE zoom_level=' . $zoom . ' AND tile_column=' . $column . ' AND tile_row=' . $row);
	$data->execute();
	$i = 0;
	while ($grid_data = $data->fetchObject()) {
		if ($i) echo ',';
		$i = 1;
		echo '"' . $grid_data->key_name . '":' . $grid_data->key_json;
	}
	echo '}});';
}
?>
