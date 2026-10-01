<?php
require_once "db.php";
$result = $conn->query("SELECT id,bus_name,bus_number,source,destination,departure_time,duration,price,total_seats FROM buses ORDER BY id");
$buses=[];
while($row=$result->fetch_assoc()) $buses[]=$row;
echo json_encode(["success"=>true,"buses"=>$buses]);
?>