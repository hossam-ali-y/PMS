<?php
	  	 $ms="";
$success=0;
$photo=array();
$i=0;
$count=count($_FILES['file']['name']);
for($i=0;$i<$count;$i++){
		//$res['success']=$_FILES['file']['name'][0];
	//if(!empty($_FILES['file']['name'])){
		$file=$_FILES['file'];
$fn= $file['name'][$i];
$ft= $file['type'][$i];
$fs= $file['size'][$i];
$ftmp= $file['tmp_name'][$i];	

$v_type=['jpg','png','gif','pdf','mp4'];
//pathinfo()

$e=explode(".", $fn);
$path=strtolower(end($e));
 //echo $path;
$size=400000000;
$new_path="images/".uniqid().".$path";
$new_name="../".$new_path;

	if(move_uploaded_file($ftmp,$new_name)){
	$photo[$i]=$new_path;
	}
}
	    $count_image=count($photo);
	$res=array();
	//$res['data']=$fn;
	$res['msg']=$count_image;
$res['images']=$photo;
echo JSON_encode($res);
?>