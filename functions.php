<?php
 require_once"connectdb.php";//connect to db newsdb
 $msg1='';
 $stat=0;
$upload_msg=0;

	$imgages_number=0;
	if(isset($_POST['img_number'])){
		$imgages_number=$_POST['img_number'];
		$im=array();
		$im[0]=$imgages_number;
		 	echo json_encode($im);
		}
 //////////////////select all project/////////////////
 ////////////////get_all_projects////////////////
 function getallprojects(){ 
    global $db;
	global $msg1;
    global $stat;
	global $upload_msg;

	$counts=array();
    $sql="select * from projects order by id desc ";
    $result=$db->query($sql);
	$projects=array();
	$pro=array();

			  //	$images1=array();
				
   foreach($result as $info){	
	 $images=array();   
	       $sql1="select * from images where pro_id=".$info['id']." order by img_id desc ";
		      $result1=$db->query($sql1);
                 $count1=0;
				 
  foreach($result1 as $img){
	      $images[]=$img;
		  $count1+=1;
        }

		       
			   $pro[0]=$info;
			   $pro[1]=$images;
			   $counts[]=count($images);
			  $projects[]= $pro;
    }
	

	$res[0]=$projects;
	$res[1]=$msg1;
	$res[2]=$stat;
	$res[3]=$upload_msg;
	$res[4]=$counts;
	//$res[4]=$images;
 	echo json_encode($res);
 }
 /////////////// refresh ////////////////
	  if(isset($_POST['refresh'])&&$_POST['refresh']=='refresh'){
		   getallprojects();
	   }
 	   
  function getconfirmed(){ 
    global $db;
    $sql="select * from projects where status=1 ";
    $result=$db->query($sql);
	$locations=array();
   foreach($result as $i){
	  $locations[]=$i;
    }
 	echo json_encode($locations);
 }
 
  function getunconfirmed(){ 
    global $db;
    $sql="select * from projects where status=0 ";
    $result=$db->query($sql);
	$locations=array();
   foreach($result as $i){
	  $locations[]=$i;
    }
 	echo json_encode($locations);
 }
 ////////////////////////////////
 ///////////////search////////////////

 if(isset($_POST['search'])){

    $projects=array();
	$pro=array();
	 $images=array();
	 $res=array();
			 $search=$_POST['text'];
    $sql="select * from projects  where id like '%".$search."%' or name like '%".$search."%' or info like '%".$search."%' or category like '%".$search."%' or lat like '%".$search."%' or lng like '%".$search."%' order by id desc ";
    $result=$db->query($sql);
	$locations=array();
	$count=0;
 
   foreach($result as $info){	  
	 

		       
			   $pro[0]=$info;
			  $projects[]= $pro;
			    $count+=1;
    }


$res[0]=$projects;	
$res[1]=$count;
 	echo json_encode($res);

	 
 }
////////////////////////////

 if(isset($_POST['fun'])){
/////////////////add project/////////////////
 if($_POST['fun']=='insert'){

 $name=$_POST['name'];
$lat=$_POST['lat'];
$lng=$_POST['lng'];
$info=$_POST['info'];
$category=$_POST['category'];
//$start_date=date('y-m-d h:m');

$start_date=$_POST['start_date'];

if(isset($_POST['finish_date'])&&$_POST['finish_date']!="")
$finish_date=$_POST['finish_date'];
else 
	$finish_date="مفتوحٍ";
	
if(isset($_POST['status']))	
$status=$_POST['status'];
else
	$status=0;


try{
	$msg1="";
      $sql="INSERT INTO `projects` (name,lat,lng,info,category,start_date,finish_date,status) values(?,?,?,?,?,?,?,?)";
  
         $state=$db->prepare($sql);	
		 $state->bindValue(1,$name);
		 $state->bindValue(2,$lat);
		 $state->bindValue(3,$lng);
		 $state->bindValue(4,$info);
		 $state->bindValue(5,$category);
		 $state->bindValue(6,$start_date);
		 $state->bindValue(7,$finish_date);
		 $state->bindValue(8,$status);
		 $exe=$state->execute();
     //         $db->close();
	 if(!$exe){
	 $msg1=$exe;	
		}
	  else{
		   $msg1=$exe;
				
		
  if(isset($_POST['images'])&&$_POST['images']!=null){
	  	 $ms="";
$photo=$_POST['images'];

	    $count_image=count($photo);
		  if($count_image>=1){
			$images_uploaded=0;
			  			 $q="SELECT  id FROM projects where name=?";
         $res=$db->prepare($q);
		 $res->bindValue(1,$name);
		 $res->execute();
         $row=$res->fetch();
		 $pro_id=$row['id'];
		   // $db->close();
			  for($i=0;$i<$count_image;$i++){
                $img_path=$photo[$i];			  
		  $sq="INSERT INTO images (pro_id,img_path) values(?,?)";
          $st=$db->prepare($sq);	
		 $st->bindValue(1,$pro_id);
		 $st->bindValue(2,$img_path);
		 	 $ex=$st->execute();
	 if($ex){
	$images_uploaded=$images_uploaded+1;
		}
			  }
			  if($images_uploaded>=1){
			$ms="مع ".$images_uploaded." صورة بنجاح";
			  }
		     else
			    $ms=" خطاء: ".$images_uploaded." صور تم رفعها لكن لم تتم إضاةتها";
		  }
		  else
			 $ms=" خطاء: ".$count_image." صورة لم يتم رفعها";
		 

}else{
	 $ms=" لا يحتوي صورة ";
}
		  $upload_msg=$ms;
	  }	
}
CATCH(PDOException $e){
 $$upload_msg ="invalid connection";
die($e->getMessage());
			 }
			
 	  	 $stat=$status;
	   	  getallprojects(); 
 }
 
 //////////////////edit project/////////////////
if($_POST['fun']=='update'){
$pid=$_POST['pid'];
$name=$_POST['name'];
$info=$_POST['info'];
$category=$_POST['category'];
//$start_date=date('y-m-d h:m');
$start_date=$_POST['start_date'];
$finish_date=$_POST['finish_date'];

$lat=$_POST['lat'];
$lng=$_POST['lng'];

if(isset($_POST['confirmed'])&&$_POST['confirmed']==1)
$status=1;
else
	$status=0;

	      $sql="update projects set name=?,info=?,category=?,start_date=?,finish_date=?,lat=?,lng=?,status=? where id=?";

         $state=$db->prepare($sql);	
		 $state->bindValue(1,$name);
		 $state->bindValue(2,$info);
		 $state->bindValue(3,$category);
		 $state->bindValue(4,$start_date);
		 $state->bindValue(5,$finish_date);
		 $state->bindValue(6,$lat);
		 $state->bindValue(7,$lng);
		 $state->bindValue(8,$status);
		 $state->bindValue(9,$pid);
		 $exe=$state->execute();

	 if(!$exe){
	   $msg1="لم يتم التعديل".$status;	
		}
	  else{
		  $msg1=" تم التعديل بنجاح ".$status;
	  }		
getallprojects();
}
 }
 ///////////delete project///////
  if(isset($_POST['fun'])&&$_POST['fun']=='del'){
	   $pid=$_POST['pid'];
	  
	      $query="delete from projects where id=".$pid;
         $stat=$db->prepare($query);	
		 		 $exec=$stat->execute();

	 if($exec>0){
	   $msg1=$pid;	
	   getallprojects();
		}
	  else{
		  $msg1=0;
	  }		

  }

 /////////////////////////////////////
 function getdate_now(){
	return date('D d-m-yy');
}
/////////////////////////////////

if(isset($_POST['upload'])){

	if(!empty($_FILES['file'])){
		$success=0;
$fn= $_FILES['file']['name'];
$ft= $_FILES['file']['type'];
$fs= $_FILES['file']['size'];
$ftmp= $_FILES['file']['tmp_name'];	

$v_type=['jpg','png','gif','pdf','mp4'];
//pathinfo()

$e=explode(".", $fn);
$path=strtolower(end($e));
 //echo $path;
$size=400000000;
$new_name="images/".uniqid().".$path";

	if(move_uploaded_file($ftmp,$new_name)){
	$photo=$new_name;
		$ms="upload successfullt";
		$success=1;
	}
else
	$ms="file not uploaded"; 

}
else
	$ms="no photo";

	$res=array();
	//$res['data']=$fn;
	$res['msg']=$ms;
$res['success']=$success;
echo JSON_encode($res);
}
?>