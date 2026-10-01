<?php
require_once "db.php";
$data=json_decode(file_get_contents("php://input"),true)??$_POST;
$email=trim($data["email"]??""); $password=$data["password"]??"";
$stmt=$conn->prepare("SELECT id,name,email,password FROM users WHERE email=? LIMIT 1");
$stmt->bind_param("s",$email);$stmt->execute();$row=$stmt->get_result()->fetch_assoc();
if(!$row||!password_verify($password,$row["password"])){http_response_code(401);echo json_encode(["success"=>false,"message"=>"Invalid email or password"]);exit;}
unset($row["password"]); echo json_encode(["success"=>true,"user"=>$row]);
?>