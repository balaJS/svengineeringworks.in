<?php
$page=array($_SERVER["SCRIPT_NAME"]);
$page=array('/index.php');

$sql="select * from seo where page=? ";
$query=$conn->prepare($sql);
$query->execute($page);

$data=$query->fetch();

if(empty($data['title'])){
    $title='';
    $title=$data['title'];  //temp
}else{
    $title=$data['title'];
}


if(empty($data['keyword'])){
    $keywords='';
    $keywords=$data['keyword']; //temp
}else{
    $keywords=$data['keyword'];
}

if(empty($data['description'])){
    $description='';
    $description=$data['description'];  //temp
}else{
    $description=$data['description'];
}

?>