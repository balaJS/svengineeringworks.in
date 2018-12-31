<?php 
require 'config.php';

function insert($table, $keys, $values) {
    if(!$table || count($keys) !== count($values)) { return ['status'=>false,'data'=>null];}
    global $conn;

    $key_str = implode(',',$keys);
    $data = array_combine($keys, $values);
    $formatted_keys = implode(", :",$keys);

    $sql = "insert into $table ($key_str) values(:$formatted_keys)";
        # return $sql; # for debugging purpose
    $pdo = $conn->prepare($sql)->execute($data);
    $last_ins_id = $conn->lastInsertId();
    return ['status'=> boolval($last_ins_id),'data'=> ['insert_id'=> $last_ins_id]];
}

function update($table, $keys, $values, $condition = false) {
    if(!$table || count($keys) !== count($values) || !$condition) { return ['status'=>false,'data'=>null];}
    global $conn;
    $query = '';
    
    $data = array_combine($keys, $values);
    $length = count($data);
	foreach($data as $key => $value) {
	    $query .= "$key = '$value'";
        if( $length > 1) $query .= ", ";
        --$length;
    }

    $sql = "update $table set $query $condition";
    $pdo = $conn->prepare($sql);
    $pdo->execute();
    $rowCount = $pdo->rowCount();
    return ['status'=> boolval($rowCount),'data'=> ['count'=> $rowCount]];
}

function select($table, $condition, $return_cols = '*', $matchval = false) {
    if(!$table) { return ['status'=>false,'data'=>null]; }
    global $conn;
    $output = array();
    $sql = "select $return_cols from $table $condition";
    //$sql = mysqli_query($conn, $query);
    $pdo = $conn->prepare($sql);
    $pdo->execute();
    while($data = $pdo->fetch(PDO::FETCH_ASSOC)) {
        $output[] = $data;
    }
    $rowCount = $pdo->rowCount();

    if($matchval || $matchval === 0) return check_unique($table, $condition, $return_cols = '*', $matchval);
    
    return ['status'=> boolval($rowCount), 'data'=> ['result'=> $output, 'count'=> $rowCount]];
}

function deleted($table, $condition, $type = 'delete') {
    if(!$table) { return ['status'=>false,'data'=>null]; }
    global $conn;
    if($type === 'inactive') { return update($table, ['status'], [0], $condition);}

    $sql = "delete from $table $condition";
    $pdo = $conn->prepare($sql);
    $pdo->execute();
    $rowCount = $pdo->rowCount();
    return ['status'=> boolval($rowCount),'data'=> ['count'=> $rowCount]];
}

function check_unique($table, $condition, $return_cols, $matchval) {
    $data = select($table, $condition, $return_cols);
    
    if($data['data']['count'] != $matchval)  {
        $data['status'] = false;
        return $data;
    } 
    if($matchval === 0) $data['status'] = true;
    return $data;
}
## Sample data for DB functions open ##
//$arr1 = ['cat_name','cat_image','cat_slug'];$arr2 = ['values1','values2','values2'];
//var_dump(insert('categary',$arr1, $arr2));
//var_dump(update('categary',$arr1, $arr2,'where cat_id = 4'));
//var_dump(select('categary', 'where cat_id = 4', 'cat_id'));
//var_dump(deleted('categary', 'where cat_id = 5'));
## Sample data for DB functions close ##

function upload($field_name, $custom_name = false, $location = 'resources/', $validation = array(['png','jpg','jpeg','gif'],[100*1024, 1024*1024])) { //100kb,1024kb
    if(!$field_name) return ['status'=> false, 'data'=> 'illigal call'];
    $file = $_FILES[$field_name];
    $file_ext = explode('/',$file['type'])[1];
    $extension = '.'.strtolower($file_ext);
    $insecurename = !$custom_name ? $file['name'] : $custom_name.$extension;
    $name = spl_char_avoid($insecurename);
    
    $tmp_name = $file['tmp_name'];
    //validation will be comes here
    $validator = upload_validator($file_ext, $file['size'], $validation);
    if(!$validator['status']) return $validator;

    $path = $location.$name;
    $upload = move_uploaded_file($tmp_name, $path);
    return ['status'=>$upload, 'data'=>['name'=>$name, 'path'=>$path]];
}

function spl_char_avoid($string = false, $spl_char = ["\'", '\"', " "], $replace = '-') {
    if(!$string) return $string;
    foreach($spl_char as $key => $value) {
        $return = str_replace($value, $replace, $string);
    }
    return strtolower($return);
}

function upload_validator($ext, $size, $validation) {
    $file_types = $validation[0];
    $file_limits = $validation[1];
    $return_ext = in_array($ext, $file_types);
    $return_limit = ($file_limits[0] <= $size && $file_limits[1] >= $size) ? true : false;
    $overall = $return_ext && $return_limit ? true : false;
    return ['status'=> $overall, 'data'=> ['type'=> $return_ext, 'size'=> $return_limit]];
}

function check_user() {
    if(!isset($_SESSION['svengg']['user']) || !$_SESSION['svengg']['user']['status']) {
        unset($_SESSION['svengg']['user']);
        return ['status' => false, 'redirect' => true];
    }
    return ['status' => true, 'redirect' => false];
}
## file upload sample data open ##
// if(isset($_POST['submit'])) {
//     var_dump(upload('file_upload'));exit;
// }
## file upload sample data close ##
?>