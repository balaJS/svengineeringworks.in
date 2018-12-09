<?php 
require 'config.php';

function insert($table, $keys, $values) {
    if(!$table || !$keys || !$values) { return ['status'=>false,'data'=>null];}
    global $conn;
    $key_str = implode(',',$keys);
    $value_str = implode(",'",$values);
    $query = "insert into $table ($key_str) values('$value_str')";
    $sql = mysqli_query($conn, $query);
    return ['status'=>true,'data'=> ['insert_id'=> mysqli_insert_id($conn)]];
}

function update($table, $keys, $values, $condition) {
    if(!$table || !$keys || !$values || count($keys) !== count($values)) { return ['status'=>false,'data'=>null];}
    global $conn;
    $query = '';
	$data = array_combine($keys, $values);
	foreach($data as $key => $value) {
	    $query .= "$key = '$value'";
	    if (next($data)) $query .= ",";
    }
    $final_query = "update $table set $query $condition";
    $sql = mysqli_query($conn, $final_query);
    return ['status'=> true,'data'=> ['affected_rows'=>mysqli_affected_rows($conn)]];
}

function select($table, $condition, $return_cols = '*') {
    if(!$table) { return ['status'=>false,'data'=>null]; }
    global $conn;
    $output = array();
    $query = "select $return_cols $table $condition";
    $sql = mysqli_query($conn, $query);
    while($data = mysqli_fetch_assoc($sql)) {
        $output[] = $data;
    }
    return ['status'=> true, 'data'=> ['result'=> $output, 'count'=> mysqli_num_rows($sql)]];
}

function deleted($table, $condition, $type = 'delete') {
    if(!$table) { return ['status'=>false,'data'=>null]; }
    global $conn;
    if($type === 'inactive') { return update($table, ['status'], [0], $condition);}
    $query = "delete from $table where $condition";
    $sql = mysqli_query($conn, $query);
    return ['status'=> true,'data'=> ['affected_rows'=>mysqli_affected_rows($conn)]];
}
$arr1 = ['cat_name','cat_image','cat_slug'];$arr2 = ['values1','values2','values1'];
var_dump(insert('categary',$arr1, $arr2));

?>