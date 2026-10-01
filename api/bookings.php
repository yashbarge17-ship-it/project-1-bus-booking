<?php
require_once "db.php";
$user_id=(int)($_GET["user_id"]??0);
$stmt=$conn->prepare("SELECT b.id,b.bus_id,b.seat_number,b.booking_date,b.status,x.bus_name,x.source,x.destination,x.price FROM bookings b JOIN buses x ON x.id=b.bus_id WHERE b.user_id=? ORDER BY b.id DESC");
$stmt->bind_param("i",$user_id);$stmt->execute();$res=$stmt->get_result();
$bookings=[];while($row=$res->fetch_assoc())$bookings[]=$row;
echo json_encode(["success"=>true,"bookings"=>$bookings]);
?>