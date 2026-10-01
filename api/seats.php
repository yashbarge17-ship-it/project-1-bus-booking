<?php
require_once "db.php";
$bus_id=(int)($_GET["bus_id"]??0);
$stmt=$conn->prepare("SELECT seat_number,status FROM seats WHERE bus_id=? ORDER BY seat_number");
$stmt->bind_param("i",$bus_id); $stmt->execute(); $res=$stmt->get_result();
$seats=[]; while($row=$res->fetch_assoc()) $seats[]=$row;
echo json_encode(["success"=>true,"seats"=>$seats]);
?>