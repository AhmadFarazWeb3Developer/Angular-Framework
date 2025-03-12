<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="formdata";


$connection=mysqli_connect($servername,$username,$password,$dbname);

if(!$connection) {
	die("Connection failed: " . mysqli_connect_error());
} else {

$email=$_POST['email'];
	$age=$_POST['age'];
	$gender=$_POST['gender'];
	$country=$_POST['country'];
	$city=$_POST['city'];
    $favArea=$_POST['favoriteArea'];
	$query ="INSERT INTO form (`email`,`age`,`gender`,`country`,`city`,`favArea`)
		  VALUES ('".$email."','".$age."','".$gender."','".$country."','".$city."','".$favArea."')";
    $query ="INSERT INTO form (`email`,`age`,`gender`,`country`,`city`,`favAre`)
          VALUES ('".$email."','".$age."','".$gender."','".$country.",".$city.",".$favArea."')";
}
mysqli_close($connection);


?>