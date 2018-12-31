<?php
require 'functions.php';

if(!isset($_POST['uname']) && isset($_POST['email'])) {
	$user_table = 'users';
	$email = $_POST['email'];$pass = $_POST['pswd'];

	$where = " where (email='$email' || mobile='$email') && pwd='$pass'";
    $userArray = select($user_table, $where,'id,uname, email, mobile');

    if(!$userArray['status']) {
		echo json_encode(['status' => false, 'field' => 'pwd', 'criteria' => 'Given email or Password was wrong. Please double check them.']);
		return;
    }
    
    $user_id = $userArray['data']['result'][0]['id'];
    update($user_table, ['last_login'], [date("Y-m-d H:i:s")], " where id='$user_id'");

    $_SESSION['svengg']['user'] = $userArray['data']['result'][0];
    $_SESSION['svengg']['user']['status'] = true;
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

	$uname_condition = "where uname='".$_POST['uname']."'";
	$check_uname_data = select($user_table, $uname_condition, 'id', 0);

	$email_condition = "where (email='".$_POST['email']."' || mobile='".$_POST['email']."')";
	$check_email_data = select($user_table, $email_condition, 'id', 0);

	if(!$check_uname_data['status'] || !$check_email_data['status']) {
		$return_array = [];
		if(!$check_uname_data['status']) $return_array[] = ['status' => false, 'field' => 'uname', 'criteria' => 'This username already exist. So change the username'];
		if(!$check_email_data['status']) $return_array[] = ['status' => false, 'field' => 'email', 'criteria' => 'This email already exists. So change the email.'];
		echo json_encode($return_array);
		return;
	}
	
	$output = insert($user_table, $keys, $values);
		#echo json_encode($output);return; # for debugging purpose
	if(!$output['status']) {
		echo json_encode(['status' => false]);
    	return;
	}
	$id = $output['data']['insert_id'];
	$userArray = select($user_table," where id='$id'",'id,uname, email, mobile');

	$_SESSION['svengg']['user'] = $userArray['data']['result'][0];
	$_SESSION['svengg']['user']['status'] = true;
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

/*
* Here Product logic's available
*/

if(isset($_POST['prod_cat']) && isset($_POST['product_name'])) {
	$check_user = check_user();
	if(!$check_user['status']) {
		echo json_encode($check_user);return;
	}
	$prod_table = 'product';
	$keys = ['product_cat','product_type','product_name','product_spec','product_desc','product_image1','user_id'];
	$attributes = json_encode(array_combine($_POST['attr_name'], $_POST['attr_value']));
	$user_id = $_SESSION['svengg']['user']['id'];
	$product_name = $_POST['product_name'];

	$uploaded = upload('images', $product_name);
	if(!$uploaded['status']) {
		$uploaded['field'] = 'images';$uploaded['criteria'] = 'This image was not upload. Please double check';
		echo json_encode($uploaded);return;
	}
	$filename = $uploaded['data']['name'];
	$values = [$_POST['prod_cat'],$_POST['machine_type'],$product_name,$attributes,'product_desc',$filename,$user_id];

	$prod_condition = "where product_name='".$_POST['product_name']."'";
	$check_prod_data = select($prod_table, $prod_condition, 'product_name', 0);
	if(!$check_prod_data['status'] || !$check_prod_data['status']) {
		$return_array = [];
		if(!$check_prod_data['status']) $return_array[] = ['status' => false, 'field' => 'product_name', 'criteria' => 'This Product name already exist. So change it.'];
		echo json_encode($return_array);return;
	}

	$output = insert($prod_table, $keys, $values);
	if(!$output['status']) {
		echo json_encode(['status' => false, 'field' => 'product_name', 'criteria' => 'This Product not added properly.']);
    	return;
	}
	$output['field'] = 'product_name'; $output['criteria'] = 'This product added successfully.';
	echo json_encode($output);return;
}

if(isset($_POST['user_id']) && isset($_POST['limit'])) {
	$table = 'product';
	$userID = $_SESSION['svengg']['user']['id'];
	$limit = $_POST['limit'] ? intVal($_POST['limit']) : 5;
	$condition = "where user_id='$userID' LIMIT $limit";
	$output = select($table, $condition);
	echo json_encode($output); return;
}





?>