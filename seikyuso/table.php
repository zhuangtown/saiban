<?php 
header("Content-Type:text/html;charset=SJIS"); 
include_once '../Includes/DBconnect.php';
//DB�֐ڑ�
$db=DBconnect();
//DB�̑I��
mysql_set_charset('sjis');
?> 
<html> 
<head> 
<title>�������쐬</title> 
<link rel="stylesheet" type="text/css" href="style.css"> 
<script src="jquery-1.3.2.min.js"></script> 
<script src="table.js"></script> 
</head> 
<body> 
<?php 
//$sql="select id,name,age,sex,email from users limit 0,20"; 
//$result=$mysqli->query($sql); 
echo "<table>"; 
echo "<caption>��??�\�i</caption>"; 
echo "<tr>"; 
echo "<th>?��</th><th>����</th><th>��?</th><th>�N?</th><th>?��</th>"; 
echo "</tr>"; 
while($row=$result->fetch_assoc()){ 
echo '<tr>'; 
echo '<td class="id">'.$row['id']"</td>"; 
echo '<td>'.$row['name']'</td>'; 
echo '<td>'.$row['age']'</td>'; 
echo '<td>'.$row['sex']'</td>'; 
echo '<td>'.$row['email']'</td>'; 
echo '</tr>'; 
} 
echo "</table>"; 
$mysqli->close(); 
?> 
</body> 
</html> 
