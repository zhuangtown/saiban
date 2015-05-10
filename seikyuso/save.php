
<?php 
header("Content-Type:text/html;charset=utf-8"); 
$mysqli=new MySQLi("localhost","root","123456","xiaoqiangdb"); 
if(mysqli_connect_errno){ 
echo "?Ú”˜?Ž¸?".mysqli_connect_error(); 
exit; 
} 
$sql="update users set name='{$_POST["name"]}',age='{$_POST["age"]}',sex='{$_POST["sex"]}',email='{$_POST["email"]}' where id='{$_POST["id"]}'"; 
$result=$mysqli->query($sql); 
if($result){ 
echo "C‰ü¬Œ÷"; 
}else{ 
echo "•Û‘¶Ž¸?"; 
} 
$mysqli->close(); 
?> 