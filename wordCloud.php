<?php
require_once("files/connection.php");
require_once("files/main.php");

$query = $con->prepare("SELECT * FROM wordcount ORDER BY search_count DESC");
$query->execute();

$html="<div style = 'font-size: 30px; text-align: Start;'> 
Cloud Word Count based on search:
</div>
<table class='table table-bordered'>
    <thead class='thead-light'>
    <tr>
        <th>Word Cloud list</th>
    </tr>
    </thead>
    <tbody>";

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $keyword = $row['word'];
    $count = $row['search_count'] + 10;
    if ($count > 100) {
        $count = 100;
    }
    $html.="<tr><td>
    <div style = 'font-size:".$count."px';>" .$keyword."&nbsp;&nbsp;&nbsp;&nbsp;</div></td></tr>";   
}
$html.="</tbody></table";
echo $html;
?>