<?php
session_start();
require 'config.php';

if(isset($_POST['login-btn'])){
	
	$email=$_POST['email'];
	$password=$_POST['pwd'];

	$secureData=array('email'=>'bala','password'=>'bala');

	if($secureData['email']===$email && $secureData['password']===$password){
		$_SESSION['user']='Admin';
		header('location:index2.php');
	}else{
		echo '<script>alert("Your user email or password is wrong.");location.href="index.php";</script>';
	}
}

if(isset($_GET['logout'])){ 
	unset($_SESSION['user']);
	header('location:index.php');
}

if(isset($_POST['amc-insert-btn'])){
	$name=$_POST['name'];
	$email=$_POST['email'];
	$mobile=$_POST['mobile'];
	$address=$_POST['address'];
	$sms_sending_date=$_POST['sms_sending_date'];

	$insert=mysqli_query($conn,"insert into customers (name,email,mobile,address,sending_date) values('$name','$email','$mobile','$address','$sms_sending_date')");
	$insertID=mysqli_insert_id($conn);

	/*echo $insertID;*/
	echo '<script>alert("'.$name.' add successfully.");location.href="index2.php";</script>';

}

if(isset($_POST['amc-update-btn'])){
	$id=$_POST['id'];
	$name=$_POST['name'];
	$email=$_POST['email'];
	$mobile=$_POST['mobile'];
	$address=$_POST['address'];
	$sms_sending_date=$_POST['sms_sending_date'];

	$insert=mysqli_query($conn,"update customers set name='$name',email='$email',mobile='$mobile',address='$address',sending_date='$sms_sending_date' where id='$id' ");
	$insertID=mysqli_insert_id($conn);

	/*echo $insertID;*/
	echo '<script>alert("'.$name.' update successfully.");location.href="index2.php?value='.$id.'";</script>';

}

?>