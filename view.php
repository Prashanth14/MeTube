<?php
require_once("files/connection.php"); 
$data = array();
$sql = "SELECT *  FROM `discussion` ORDER BY id desc";
$result = $con->query($sql);
while($row = $result->fetch()){
        array_push($data, $row);
        array_push($data);
}

echo json_encode($data);
$con = null;
exit();
?>



