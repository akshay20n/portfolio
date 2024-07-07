<?php
$email = $_POST['email'];
$conn = new mysqli('localhost','root','','emails');
if($conn->connect_error){
die('Connection Failed :'.$conn->connect_error);
}else{
$stmt = $conn->prepare("insert into emails(email)
values(?)";
$stmt-> bind_param("s",$email);
$stmt->execute();
echo "email sent successfully...";
$stmt->close();
$conn->close();
?>
