<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Content-Type: application/xml; charset=utf-8");
//include '../dbcclconn.php';
include 'dbcclconn_dev_coord.php';
include 'dataproperty.php';
$p = $_GET['p'];
$datad = new Dataproperty($pdod);
$dataprops = $datad->get_propertieslist($p);
echo $dataprops;

?>
