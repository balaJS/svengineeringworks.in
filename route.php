<?php
require 'functions.php';

if(!isset($_POST['uname']) && isset($_POST['email'])) {
	$user_table = 'users';
	$email = $_POST['email'];$pass = $_POST['pswd'];

	$where = " where (email='$email' || mobile='$email') && pwd='$pass'";
    $userArray = select($user_table, $where,'id,uname, email, mobile');

    if(!$userArray['status']) {
		echo json_encode([]);
		return;
    }
    
    $user_id = $userArray['data']['result'][0]['id'];
    update($user_table, ['last_login'], [date("Y-m-d H:i:s")], " where id='$user_id'");

    $_SESSION['svengg']['user'] = $userArray['data']['result'][0];
    echo json_encode($_SESSION['svengg']['user']);
    //echo json_encode($userArray['data']['result'][0]);
    return;
}


if(isset($_POST['uname']) && isset($_POST['email'])) {
	$user_table = 'users';
	$keys = ['uname', 'email', 'pwd', 'last_login'];
	if(is_numeric($_POST['email'])) {
		$keys[1] = 'mobile';
	}
	$values = [$_POST['uname'], $_POST['email'], $_POST['pswd'], date("Y-m-d H:i:s")];

	$output = insert($user_table, $keys, $values);

	if(!$output['status']) {
		echo json_encode([]);
    	return;
	}
	$id = $output['data']['insert_id'];
	$userArray = select($user_table," where id='$id'",'uname, email, mobile');

	$_SESSION['svengg']['user'] = $userArray['data']['result'][0];
	echo json_encode($_SESSION['svengg']['user']);
	return;
}

if(isset($_GET['request'])) {
	if(!isset($_SESSION['svengg']['user'])) {
		echo json_encode([]);
		return;
	}
	echo json_encode($_SESSION['svengg']['user']);
	return;
}


?>