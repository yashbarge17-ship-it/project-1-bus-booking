<?php
require_once "db.php";
$data=json_decode(file_get_contents("php://input"),true)??$_POST;
$user_id=(int)($data["user_id"]??0); $bus_id=(int)($data["bus_id"]??0); $seat=(int)($data["seat_number"]??0); $date=$data["booking_date"]??"";
if(!$user_id||!$bus_id||!$seat||!$date){http_response_code(400);echo json_encode(["success"=>false,"message"=>"Missing booking details"]);exit;}
$conn->begin_transaction();
try{
  $stmt=$conn->prepare("SELECT status FROM seats WHERE bus_id=? AND seat_number=? FOR UPDATE");
  $stmt->bind_param("ii",$bus_id,$seat);$stmt->execute();$row=$stmt->get_result()->fetch_assoc();
  if(!$row||$row["status"]!=="AVAILABLE") throw new Exception("Seat is already booked");
  $stmt=$conn->prepare("UPDATE seats SET status='BOOKED' WHERE bus_id=? AND seat_number=?");
  $stmt->bind_param("ii",$bus_id,$seat);$stmt->execute();
  $stmt=$conn->prepare("INSERT INTO bookings(user_id,bus_id,seat_number,booking_date,status) VALUES(?,?,?,?, 'CONFIRMED')");
  $stmt->bind_param("iiis",$user_id,$bus_id,$seat,$date);$stmt->execute();
  $conn->commit(); echo json_encode(["success"=>true,"booking_id"=>$stmt->insert_id]);
}catch(Exception $e){$conn->rollback();http_response_code(409);echo json_encode(["success"=>false,"message"=>$e->getMessage()]);}
?>