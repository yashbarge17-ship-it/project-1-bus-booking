<?php
require_once "db.php";
$data=json_decode(file_get_contents("php://input"),true)??$_POST;
$name=trim($data["name"]??""); $email=trim($data["email"]??""); $password=$data["password"]??"";
if($name===""||$email===""||$password===""){http_response_code(400);echo json_encode(["success"=>false,"message"=>"Name, email and password are required"]);exit;}
$hash=password_hash($password,PASSWORD_DEFAULT);
$stmt=$conn->prepare("INSERT INTO users(name,email,password) VALUES(?,?,?)");
$stmt->bind_param("sss",$name,$email,$hash);
if(!$stmt->execute()){http_response_code(409);echo json_encode(["success"=>false,"message"=>"Email may already be registered"]);exit;}
echo json_encode(["success"=>true,"user_id"=>$stmt->insert_id]);
?>