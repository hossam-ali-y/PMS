<?php
   @session_start();
   	require_once"../functions.php";
      require_once"../connectdb.php";//connect to db newsdb
  // require '../accounts/checkAuthrizedad.php';
 //     require_once'../user/usermodifycontroller.php';
    require_once'../modal.php';
	
  require_once"../nav.php";

function getuid(){
global $get_uid;
global $db;
global $su;
global $w;
$w="document.getElementById('get_uid').value";
   $sq="select * from user where user_id=".$w;
   $res=$db->query($sq);
   if($res){
   $su=$res->fetch();
   }
   }
   
$msg='';
$ms='';

?>

<?php
if(isset($_GET['msg']))
$msg=$_GET['msg'];
/*///////////////////////استرجاع بيانات المستخدمين  
   $q="select * from projects  order by id asc";
   $result=$db->query($q);	
   
   ////////////////////////////////////استرجاع عدد العدد الكلي للمستخدمين
  $qc="select count(*) from projects ";
   $res=$db->query($qc);
   $users=$res->fetch();
 $count_users=$users[0];
 ////////////////////////////////////////////////////////*/
 
if(isset($_POST['delete']))
{

$id=$_POST['u_id'];
$name=$_POST['u_name'];
	$sql="delete from projects  where id in(?)";
			$state=$db->prepare($sql);	
		 $state->bindValue(1,$id);
		 $ec=$state->execute();
	if($ec==1){
	$msg="user $name whith id ".$id." deleted";
//	header("location:modifyusers.php?msg=$msg");
	}else
		$msg="not deleted";	
		   header("location:modifyusers.php?msg=$msg");
}

/*
if(isset($_GET['uid']))
$u=$_GET['uid'];
else if(isset($_POST['uid']))
$u=$_POST['uid'];


else
header('location:../home.php');
*/

if(isset($_POST['save'])){
$u=$_POST['u_id'];
if(isset($_POST['photopath']))
$photo=$_POST['photopath'];
else
$photo=null;
if(isset($_POST['u_phone']))
$phone=$_POST['u_phone'];
else
$phone=null;
if(isset($_POST['u_email']))
$email=$_POST['u_email'];
else
$email=null;

$name=$_POST['u_name'];
$sname=$_POST['u_sname'];
$gender=$_POST['u_gender'];
$status=$_POST['status'];
	if(!empty($_FILES['photo']['name'])){
	$fn= $_FILES['photo']['name'];
$ft= $_FILES['photo']['type'];
$fs= $_FILES['photo']['size'];
$fe= $_FILES['photo']['error'];
$ftmp= $_FILES['photo']['tmp_name'];	
$v_type=['jpg','png','gif','pdf','mp4'];
//pathinfo()

$e=explode(".", $fn);
$path=strtolower(end($e));
 //echo $path;
$size=400000000;
$new_name="../user/photo/".uniqid().".$path";
if(! in_array($path,$v_type))
$ms='play out only jpg,png,gif,pdf,mp4 are allowed'; 
else if($fs>$size)
$ms='allowed size is 4 mb or less ';
else if ($fe != 0)
	$ms="error occured:  $fe ";
else{
	if(move_uploaded_file($ftmp,$new_name)){
	$ex=explode("../",$new_name);
    $photo=strtolower(end($ex));
	$ms="تم تحديث الصورة الشخصية";
	}
else
	$ms="photo not uploaded"; 
	}
	        }

			
 $sql="UPDATE user SET username=?,surname=?,email=?,gender=?,photo=?,phonenumber=?,status=?
        WHERE user_id=?";

		$state=$db->prepare($sql);	
		 $state->bindValue(1,$name);
		 $state->bindValue(2,$sname);
		 $state->bindValue(3,$email);
		 $state->bindValue(4,$gender);
		 $state->bindValue(5,$photo);
		 $state->bindValue(6,$phone);
		 $state->bindValue(7,$status);
		 $state->bindValue(8,$u);
		 $exec=$state->execute();


	if($exec){
   $msg="$exec تم التحديثه بنجاح $u المستخدم رقم , $ms";
   header("location:modifyusers.php?msg=$msg");
	}
	else 
	$msg="$exec تم تغيير  , $ms";
}

/*
fetch(PDO: FETCH_ASSOC) // PDO: FETCH_NUM , PDO: FETCH_ASSOC , PDO: FETCH_COLUMN
*/

?>
<?php


/*
if(isset($_POST['save'])&&$db){
$uid=$_POST['uid'];
$name=$_POST['uname'];
$sname=$_POST['usname'];
$email=$_POST['uemail'];
$pass=$_POST['upass'];
$gender=$_POST['ugender'];
 $l="UPDATE user SET username=?,surname=?,email=?,gender=?
        WHERE user_id=?";
        
		$state=$db->prepare($l);	
		 $state->bindValue(1,$name);
		 $state->bindValue(2,$sname);
		 $state->bindValue(3,$email);
		 $state->bindValue(4,$gender);
		 $state->bindValue(5,$uid);
		 $exec=$state->execute();
	
	if($exec){
	$msg="$exec update sucsessfully ";
	header("location:modifyusers.php?msg=$msg");
	}
	else 
$msg="something wrong ";
}*/
?>

<!DOCTYPE html>
<html dir="rtl" >
<head>
<title> لوحة التحكم <<PMS</title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
	 <link type="image/x-icon" rel="shortcut icon" href="../images/attach-location.png">
	 
<script src="../bootstrap/js/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>

	  	<!-- Put favicon.ico and apple-touch-icon(s).png in the images folder -->
  	  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	  <link rel="stylesheet" href="../elusive-icons/elusive-icons.css">

	
<link rel="stylesheet" href="../css/font-awesome.min.css">
<link rel="stylesheet" href="../bootstrap/css/icon.css">
	
	

	<link rel="stylesheet" href="../css/my.css">
		<link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
  
		
		<link rel="stylesheet" href="../css/style.css" type="text/css">

		
		<link rel="stylesheet" href="../css/slider.css" type="text/css">
<link rel="stylesheet" href="../css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="../css/owl.theme.css" type="text/css">


<!-----------------leaflet maps Api--------------->
  <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
  integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
  crossorigin="">
  </script>
  
  
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
   
  
<style type="text/css">

    body {
font-family: "Lucida Grande", Helvetica, Verdana, Arial, sans-serif;
    font-size: 13px;
    line-height: 1.42857143;
    color: #4c4c4c;
	}
	 nav{
color:white;
font-size:16;

}

.img{
		 
		 height:180px;
		 }
.modal.modal-footer {
    padding: 11px 39px;
}
.great{
border:1px solid #0a0a5c66;
background-color: #0b7dda;
}
.photo{
width="20%";
height:50px;
}
.photo img{
height:70px;
border-radius:25em 25em;
}	
		 .logout {
		 background-color: #f44336;
		 border: none;
         } 	 
        .logout:hover {
		 background: #da190b;
		 border: none;
		 }
		 
		 .logout{
		 color:white;
		 }


		 #icon{

width:100%;
border:none;
}
div#icon a img{
width:50px;
height:50px;
} 
	
	.table-title {        
		padding-top: 0px;
    padding-right:10px;
    padding-bottom: 2px;
    padding-left: 0px;
	color:#777777;
    background-color: #f0eeee;
	    margin: 0px 0px 0px;
    border-bottom: 1px solid #a8a8a8;
    }
	.btn{
		width:auto;
	}
	div.row{
		    margin-right: 0px;
    margin-left: 0px;
	}
    .table-title h2 {

		font-size: 20px;
	}
	.table-title .btn-group {
		float: right;
	}
	.table-title .btn {
		
		color: white;
    background-color: #7c7bad;
    border-color: #7c7bad;
		color: #fff;
		float: right;
		font-size: 13px;
		border: none;
		min-width: 50px;
		border-radius: 2px;
		border: none;
		outline: none !important;
		margin-left: 10px;
	}
	
	.table-title .btn:hover{
		color: white;
    background-color: #5f5e97;
    border-color: #5b5a91;
	}
	
	.table-title .back-btn{
		   color: #4c4c4c;
    background-color: white;
    border-color: #adadad;
    margin-bottom: 0;
    font-weight: normal;
    text-align: center;
    vertical-align: middle;
    touch-action: manipulation;
    cursor: pointer;
    background-image: none;
    border: 1px solid #aba4a46b;
    white-space: nowrap;
	}
	
	.table-title .back-btn:hover{
    background-color: #9c9c9c;
    border-color: #8c8c8c;
	color:whit;
	}
		
.table-title .btn-del{
    color: whit;
    background-color: #e45656e3;
    border-color: #e45656e3;
    margin-bottom: 0;
    font-weight: normal;
    text-align: center;
    vertical-align: middle;
    touch-action: manipulation;
    cursor: pointer;
    background-image: none;
    border: 1px solid #aba4a46b;
    white-space: nowrap;
    border-radius: 3px;
		}
.table-title .btn-del:hover{
    background-color: #d82b2be3;
    border-color: #d82b2be3;
	}
	
	.table-title .btn i {
		float: left;
		font-size: 21px;
		margin-right: 5px;
	}
	.table-title .btn span {
		float: left;
		margin-top: 2px;
	}
	table {
    width: 100%;
    max-width: 100%;
    margin-right: 0px;


	}
	.containt{
		    border-bottom: solid 1px #afafb6;
		    border-right: solid 1px #afafb6;
background-color:white;
		
	}
	table.table tr th{
	color: #4c4c4c;
    background-color: #eee;
    border-bottom: 2px solid #cacaca;
	font-family: "Lucida Grande", Helvetica, Verdana, Arial, sans-serif;
      vertical-align: middle;
	   font-size: 16px;
    line-height: 1.42857143;
	}
.table>thead>tr>th {
        border-left: 1px solid #dfdfdf;
		padding: 5px;
		
    border-bottom: 2px solid #dddddd;
}	

	
	 table.table tr td {
		     vertical-align: middle;
    font-family: "Lucida Grande", Helvetica, Verdana, Arial, sans-serif;
    font-size: 16px;
    line-height: 1.42857143;
    color: #4c4c4c;
	padding: 5px;
}
table.table tr td.td-lnglat{
	    font-size: 15px;
    font-family: "Lucida Grande", Helvetica, Verdana, Arial, sans-serif;
}
	table.table tr th:first-child {
		width:1px;
	 vertical-align: middle;
	 padding:4px;
	 text-align: center;
	}
	table.table tr td:first-child {
		width:1px;
			 vertical-align: middle;
			 padding:4px;
	 text-align: center;
	}
	table.table tr th:last-child {
		width: 100px;
	}
    table.table-striped tbody tr:nth-of-type(odd) {
    	background-color: #efeff8;
	}

	table.table-striped.table-hover{
cursor: pointer;
background-color:#fff;
	}
	table.table-striped.table-hover tbody tr:hover {
		background: #f5f5f5;
	}
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }	
    table.table td:last-child i {
		opacity: 1;
		font-size: 18px;
        margin: 0 8px;
    }
	table.table td a {
		font-weight: bold;
		color: #566787;
		display: inline-block;
		text-decoration: none;
		outline: none !important;
	}
	table.table td a:hover {
		color: #2196F3;
	}
	table.table td a.edit {
        color: #FFC107;
    }
    table.table td a.delete {
        color: #F44336;
    }
    table.table td i {
        font-size: 19px;
    }
	table.table .avatar {
		border-radius: 50%;
		vertical-align: middle;
		margin-right: 10px;
	}
    .pagination {
        float: right;
        margin: 0 0 5px;
    }
    .pagination li a {
        border: none;
        font-size: 13px;
        min-width: 30px;
        min-height: 30px;
        color: #999;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 2px !important;
        text-align: center;
        padding: 0 6px;
    }
    .pagination li a:hover {
        color: #666;
    }	
    .pagination li.active a, .pagination li.active a.page-link {
        background: #03A9F4;
    }
    .pagination li.active a:hover {        
        background: #0397d6;
    }
	.pagination li.disabled i {
        color: #ccc;
    }
    .pagination li i {
        font-size: 16px;
        padding-top: 6px
    }
    .hint-text {
        float: left;
        margin-top: 10px;
        font-size: 13px;
    }    
	/* Custom checkbox */
	.custom-checkbox {
		position: relative;
	}
	.custom-checkbox input[type="checkbox"] {    
		opacity: 0;
		position: absolute;
		margin: 5px 0 0 3px;
		z-index: 9;
	}
	.custom-checkbox label:before{
		width: 16px;
		height: 16px;
	}
	.custom-checkbox label:before {
		content: '';
		margin:2px;
		margin-top:2px;
		display: inline-block;
		vertical-align: text-top;
	    background: #e5e5e5;
    border: 1px solid #a6a6a6;
		border-radius: 2px;
		box-sizing: border-box;
		z-index: 2;
	}
	.custom-checkbox input[type="checkbox"]:checked + label:after {
	    content: '';
    position: absolute;
    left: 8px;
    top: 4px;
    width: 5px;
    height: 10px;
    border: solid #000;
    border-width: 0 3px 3px 0;
    transform: inherit;
    z-index: 3;
    transform: rotateZ(45deg);
}
	}
	.custom-checkbox input[type="checkbox"]:checked + label:before {
		border-color: #03A9F4;
		background: #03A9F4;
	}
	.custom-checkbox input[type="checkbox"]:checked + label:after {
		border-color: #fff;
	}
	.custom-checkbox input[type="checkbox"]:disabled + label:before {
		color: #b8b8b8;
		cursor: auto;
		box-shadow: none;
		background: #ddd;
	}
	/* Modal styles */
	.modal .modal-dialog {
		max-width: 400px;
	}

	.modal .modal-content {
		border-radius: 3px;
	}
	.modal .modal-footer {
		background: #ecf0f1;
		border-radius: 0 0 3px 3px;
	}
    .modal .modal-title {
        display: inline-block;
    }
	.modal .form-control {
		border-radius: 2px;
		box-shadow: none;
		border-color: #dddddd;
	}
	.modal .form-control:focus {
	border-color: #66afe9;
    outline: 0;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102,175,233,.6);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102,175,233,.6);
	}
	.modal textarea.form-control {
		resize: vertical;
	}
	.modal .btn {
		border-radius: 2px;
		min-width: 100px;
	}	
	.modal form label {
		font-weight: normal;
	}	

	
	
	
	
	
	

   #btn{ content-alignment: center;

   width:-webkit-fill-available;
 
    overflow: auto;
   }
   #startmark{background-color: white;font-size:16px;border-style: none; }
   #options{ background-color: white ;font-size:16px; border-style: none; }
   #s Hover{background-color: grey}

   .leaflet-pane leaflet-map-pane{}
   .leaflet-pane         {z-index: 0;}
   
    .container{
		padding:0 0 0 0px;
		width:100%;

	}
	.page{
		margin:0 0 0 2px;
	}
.nav-inner {
	
	margin:0px;
	
}	
#mobile-menu ul.navmenu ul.submenu {
    padding: 2px 0 0;
    background: #fff;
    width: 99.8%;
    border-bottom: 2px solid #b8bdbffc;
    margin-top: 10px;
}
.cms-index-index #nav #nav-home > a, #nav > li.active > a, .vertnav-top li.current > a:hover {
    background-color: #44d6e4;
    color: #fff;
}
.cms-index-index #nav #nav-home > a, #nav > li.active > a, .vertnav-top li.current > a {
    color: #fff;
}
#nav > li > a:first-child {
    margin-left: 0px;
}
#nav > li > a {
    color: #BEBEBE;
    height: 56px;
}
#nav > li > a {
	height:50px;
}
#search {
	height:50px;
    margin: 0 59 0 0;
	font-size:18px
	}
	#search.search-bar-input {
    padding-right: 15%;
 
}
	@media (max-width: 991px) and (min-width: 768px)
#search {
    width: 74%;
	
}
	.search-icon, .search-bar-submit {
	
		  padding-top: 23px;
  padding-left: 4px;
    padding-right: 3px;
	}

@media only screen and (max-width:480px)
{
	#search {
    width: 60%;
		border: none;
	border-right: 1px solid #333;
	margin-left: 33px;
}
#search:focus {
	width: 60%;
	border: none;
	border-right: 1px solid #333;
	margin-left: 33px;
}
	.table-wrapper {
    width: auto;
    height: 90%;
        background-color: #f0eeee;
        padding: 0px 0px;
		    margin: 12px 0px 5px 0px;	 
		border-radius: 3px;
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }

	#containt{
		    height: 78%;
    overflow-x: scroll
	}
	.search-icon, .search-bar-submit {
		height:47px;
		  padding-top: 23px;
  padding-left: 4px;
    padding-right: 3px;
	}
#search.search-bar-input {height: 90%;}
 #mobile-content {display:contents;    border: none;    box-shadow: none;font-size:15px;padding-bottom:0px]}
 #mobile-form,mobile-map { width: 100%;  }
}
@media only screen and (min-width:480px)
{
	.table-wrapper {
    width: auto;
    height: 87%;
        background-color: #f0eeee;
        padding: 0px 0px;

		border-radius: 3px;
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
			    margin: 5px 0px 0px 0px;
    }
		#containt{
		    height: auto;
    overflow-x: scroll
	}
	
	.search-icon {
    padding-top: 23px;
  
    padding-right: 18px;
}
	#search.search-bar-input{
		padding-right:15%;
		height:90%;
		width:60%
	}

 #mobile-content {display:flex;    border: none;    box-shadow: none;    font-size: 16px;
    font-weight:600 ;padding-right:15px}
 #mobile-form{ width: 60%;  }
 #mobile-map{width: 40%; }
}

	


	
.leaflet-popup-content{
	margin: 1px;
	width:283px;
}
.leaflet-popup-content-wrapper{
	padding:1px 2px 1px 0px;
}
.leaflet-popup  leaflet-zoom-animated {
opacity: .9;transform: translate3d(613px, 389px, 0px);bottom: -7px;left: -134px;
	}
	
	
	.leaflet-container a.leaflet-popup-close-button {
    font:22px/14px Tahoma, Verdana, sans-serif;
	    padding: 15px 15px 0 0;
	}
	
.product-block .product-image .product-secondpic,.product-block .product-image .product-mainpic,.product-meta {

    max-width: 100%;

}
.product-block .product-meta {
    
	    height: 40px;
		margin-top: -40px;
}
.best-seller-pro{
	padding: 0px 10px 10px 10px;
		    box-shadow: 0 0 0 0;
				margin: 0 0 0 0px;
				height: 130px;
}


 .product-display img{
	display:contents;
}

.new_title{
	margin:0px;
}
.new_title.center {
 
    text-align: center;
	font-size:15px;
}

th{
 text-align:right;
 background-color: antiquewhite;
}
.status {
    font-size: 35px;
    margin: 2px 2px 0 0;
    display: inline-block;
    vertical-align: middle;
    line-height: 10px;
}
.text-success {
    color: #10c469;
	
}
.text-danger{
	  color: #ff5b5b;
}

.btn-group-lg>.btn, .btn-lg {
    padding: 6px 6px;
    font-size: 22px;
    line-height: 1.3333333;
    border-radius: 6px;
}
table.table tr td .action{
	display: inline;
}
#action{
	display:inline-flex;
}
#proggers{
	display:flex;
}
.table{
	margin-bottom:0px;
	    margin-bottom: 20px;
	    border-bottom:2px solid #ddd;
}
.table-title .addproject{
					   background-color :rgba(255, 255, 255, 0);
	color: #777;
}
.table-title .addproject:hover{
					   background-color :rgba(255, 255, 255, 0);
	color: #777;
}



.col-sm-6 div #list,#grade{
	min-width:20px
}

div .flex_item{

		    width: 320px;
    height: 100px;
      -webkit-box-flex: 1;
    flex: 1 1 300px;
    background-color: white;
    box-shadow: 0px 0px 1px 1px #666666;
    padding: 8px 8px;
    position: relative;
    min-width: 150px;
    max-width: 350px;
    margin: 4px;
	
	font-size: 13px;
    line-height: 1.42857143;
    color: #4c4c4c;
	cursor:pointer;
}

div .flex_container{
	display:flex;
	    padding: 4px 12px;
	    margin-top: -21px;
background-color: #f0eeee;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: flex-start;
	    align-content: stretch;
    overflow-x: visible;
}
</style>

<script type="text/javascript">
	
	 //console.log(projects[0]);
$(document).ready(function(){	
$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes


	$("#selectAll").click(function(){
			var checkbox = $('table tbody input[type="checkbox"]');
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
		
		checkbox.click(function(){
			if(this.checked){
				var countcheck=0;
				
				checkbox.each(function(){
				if(this.checked==true)  
					countcheck++;
			});
			
		    checkbox.checked;
				if(countcheck==10)
					$("#selectAll").prop("checked", true);
		 }
		if(!this.checked){
		
			$("#selectAll").prop("checked", false);
		}
	});	
	});


	
	// Activate tooltip
	
	$('#shortcut_icon').attr("href","../images/attach-location.png");
	$('#home').attr("href","../home.php");
	$('#home1').attr("href","../home.php");
//	$('#admin').attr("href","projects.php");
	$("#editEmployeeModal").hide();
	$('#research-ico').attr('src','../images/search-icon.png')	
	// Select/Deselect checkboxes
	


	
	var allpro;
	 var getjson;
var projects;
var allimages;
var msg='';
	// projects=<?php getallprojects() ?>;
		//initial  no ajax get project
	//  getjson=<?php getallprojects() ?>;
	 //projects=getjson[0];
//	 console.log(projects);

var op='dash';
function ref(){
			var refresh={};
		refresh.refresh="refresh";
	 $.post('../functions.php',refresh,function(rt,ts,xhr)
		{	
		 getjson=JSON.parse(rt);
		 allpro= getjson[0];
		 projects=allpro;
       //  allimages=getjson[4];
		 		//  console.log(allimages);
	     // var jeson=JSON.parse(rt);
		});
}
	function refresh(){
			var refresh={};
		refresh.refresh="refresh";
	 $.post('../functions.php',refresh,function(rt,ts,xhr)
		{	
		 getjson=JSON.parse(rt);
		 allpro= getjson[0];
		 projects=allpro;
		  		create_listbutton();
       //  allimages=getjson[4];
		 		//  console.log(allimages);
	     // var jeson=JSON.parse(rt);
		});
	}
////start load project from server using ajax technic and list it in the projects table
refresh();

	var files=0;
$("#mssg").css("font-size","20px");
		  $('#control-panel').addClass('level0 parent drop-menu active');
	$('#file').on('change',function(e){
		files=e.target.files.length;
		console.log(e);
		  $("#selectedimg").css("color","#b9b408").css("font-size","18px");
    $("#selectedimg").html(files+" صورة محددة");
	});
	
$('#formUpload').on('submit',function(e){
		
	e.preventDefault();
	
		   var formData=new FormData(this);
//console.log(formData);
	
	$.ajax({
		type:'POST',
		url: 'upload.php',
		data:formData,
		contentType: false,
		processData: false,
		success: function (data) {
			data=JSON.parse(data);
			if (data.images) {
				//console.log(data.images);
				addp(data.images);
				
			} else {
				alert('error uploading your file!!!!');
			}
			console.log(data);
			//data=JSON.parse(data);

		},
		error: function (data) {
			alert('There was an error uploading your file!');
		}
});
			
				
});


$('#rssearchspan').click(function(){
			$('#search').focus();
			if($('#search').val()!="")
			$('#search').keyup();
	});
	$('#research-ico').click(function(){
			$('#search').focus();
			if($('#search').val()!="")
			$('#search').keyup();
	});
	$('#searchdone').click(function(){
			$('#search').focus();
			if($('#search').val()!="")
			$('#search').keyup();
	});
	
	$('#searchdone').click(function(){
			$('#search').focus();
	});
	
		 $('#search').on('keyup',function(){
		 var result;
		 var search={};
		  search.search='search';
	   search.text=$(this).val();
        		
				 /*
				  var text=   $(this).val();
				 var pro=[];
				 var p;
 if(text!=""){
	 		 var coun=0;
			 
		  for(var i=0;i<allpro.length;i++)	{
			  p=allpro[i][0];
			 	console.log(p.toString()+"          "+text);
			
			  if(p["0"]==){
				     //	  	console.log(allpro[i][0]["0"]);	
					 for(i=0;i<p["1"].length;i++){
						 if(p["1"]==text)
							 
					 }
				   pro[count]=allpro[i];
			    	coun++;
					
				          }			  	
					  		//	  console.log(p);
		  }
						 	console.log(pro);	 
				//console.log(allpro);	
	               var cou=pro.length;
		  						projects=pro;
						if(pro.length>=1)	{
							 $("#title").hide();
							 $("#mssg").css("color","rgb(16, 196, 105)").css("font-size","20px");
							     $("#mssg").html(coun+" نتيجة بحث عن "+text);	   	
						}		 
                        else{
				
					 $("#title").hide();
			        $("#mssg").html("لايوجد نتائج مطابقة").css("color","rgb(249, 117, 113)").css("font-size","20px");
					//projects.length=0;
	              }										
  }
   else{
		 $("#title").show();
		 $("#mssg").html("");
			projects=allpro;			
	  }
				
				  		  create_listbutton();
						  */
	 	 $.post('../functions.php',search,function(rt,ts,xhr)
		   {	
		      result=JSON.parse(rt);

			   var count=result[1];
			   console.log(xhr);
			   console.log(count);
	            if(count>=1){  //if insert execute successfully 
			   	  // console.log(projects);	
			   projects= result[0];				  
					 if(search.text!=""){
						  $("#title").hide();
							 $("#mssg").css("color","rgb(16, 196, 105)").css("font-size","20px");
							     $("#mssg").html("<span style='color:#0397d6;'>"+count+"</span>"+" نتيجة بحث عن  <span style='color:#0397d6;'>"+search.text+"</span>");	
						      	
					 }
			       else{
					       $("#title").show();
						    $("#mssg").html("");
						
				   }
				   
				 }
			    else {
					 $("#title").hide();
			        $("#mssg").html("لايوجد نتائج مطابقة ل <span style='color:#0397d6;'>"+search.text+"</span>").css("color","rgb(249, 117, 113)").css("font-size","20px");
					projects.length=0;
	              }
		
				  create_listbutton();
				    // initial_pro();
	           });
			   
	 });
	 
	 
/*
	 $('#search').on('keyup',function(){
		 var result;
		 var search={};
		  search.search='search';
	      search.text=$(this).val();
	
	 	 $.post('../functions.php',search,function(rt,ts,xhr)
		   {	
		      result=JSON.parse(rt);

			   var count=result[1];
			   console.log(xhr);
			   console.log(count);
	            if(count>=1){  //if insert execute successfully 
			   	  // console.log(projects);	
			   projects= result[0];				  
					 if(search.text!=""){
						  $("#title").hide();
							 $("#mssg").css("color","rgb(16, 196, 105)").css("font-size","20px");
							     $("#mssg").html(count+" نتيجة بحث عن "+search.text);	
						      	
					 }
			       else{
					       $("#title").show();
						    $("#mssg").html("");
						
				   }
				   
				 }
			    else {
					 $("#title").hide();
			        $("#mssg").html("لايوجد نتائج مطابقة").css("color","rgb(249, 117, 113)").css("font-size","20px");
					//projects.length=0;
	              }
			if(xhr.readyState)
				  create_listbutton();
				    // initial_pro();
	           });
	 });
	 
*/

/////////////// loading custom project ///////////////////////////////
    var count;
	var view;
	var mode;
	var count_int;
	var group;
	var btns;
	var  listgroup_list;
	var initial_btn=0;
//refresh();
function create_listbutton(){
	
	$('#groups').html('<li id="prev" class="page-item disabled"><a href="#">السابق</a></li>');	   
     count=projects.length;
	// console.log(count);
     view=10;
	 mode=(count%view);
	 count_int=(count-mode);
	 group=count_int/view;
	 btns;
	 listgroup_list=[];
     var begin;var end;
	
	if(mode> 0){
		btns=group+1;
	}
   else if(mode==0)
	   btns=group;

   for(i=0;i< btns;i++){
	    begin=(view * i);
		
	   if(i<group)
	      end=begin+view;
	   else
		  end=count;
	   //  console.log(end);
	   var progroup=[];
	   var k=0;
	 for(j=begin;j< end;j++){
		   progroup[k]=projects[j][0];//project information
		 k++;
		  
	 }
	 //end inner for	   
	
      listgroup_list[i]=progroup; 

      $('#groups').append('<li id="btn'+i+'" data-list="'+i+'" class="page-item"><a href="#" class="page-link">'+(i+1)+'</a></li>');
         $('#btn'+i+'').click(function(){
	     var list=$(this).attr('data-list');
		 
	     initial(list);
		 initial_btn=list;
		 $("#selectAll").prop("checked", false);
         });
         //end btn click event 
  }
  //console.log(listgroup_list);
  //end outer for
 
       if(count>=1){
          $('#btn0').addClass('page-item active');
    	}
		else{
			count=0;
						 $('#groups').html('<li id="prev" class="page-item disabled"><a href="#">السابق</a></li>');	 
		}

 		initial(initial_btn);
	  $('#groups').append('<li id="next"class="page-item disabled"><a href="#" class="page-link">التالي</a></li>');

    }
   //end function create_listbutton
  

function initial(list){
	//console.log(listgroup_list[list]);
				projects=listgroup_list[list];
				initial_pro();
		 $('#show-hint').html(' <b id="count-group">'+projects.length+'</b> من أصل <b id="count-hint">'+count+'</b> مشروع');
		
		for(i=0;i<btns;i++){
		  $('#btn'+i+'').removeClass('page-item active');
	  }
	    $('#btn'+list+'').addClass('page-item active');
	
          }

	
	/////////////////////file upload////////////////////////////////
	function isUploadSupported() {
    if (navigator.userAgent.match(/(Android (1.0|1.1|1.5|1.6|2.0|2.1))|(Windows Phone (OS 7|8.0))|(XBLWP)|(ZuneWP)|(w(eb)?OSBrowser)|(webOS)|(Kindle\/(1.0|2.0|2.5|3.0))/)) {
        return false;
    }
    var elem = document.createElement('input');
    elem.type = 'file';
    return !elem.disabled;
};
//console.log(isUploadSupported());
if (window.File && window.FileReader && window.FormData) {	
		
	
	//var $inputField = $('#img1');
	/*$('#file1').on('change', function (e) {
		var file = e.target.files[0];
		if (file) {
			if (/^image\//i.test(file.type)) {
					console.log(file);
				$('#formUpload1').submit();
			//	readFile(file);
			//	sendFile(file);
			
			} else {
				alert('Not a valid image!');
			}
		}
	});*/
} else {
	alert("File upload is not supported!");
}

function readFile(file) {
	var reader = new FileReader();

	reader.onloadend = function () {
		processFile(reader.result, file.type);
		
	}

	reader.onerror = function () {
		alert('There was an error reading the file!');
	}

	reader.readAsDataURL(file);
}

function processFile(dataURL, fileType) {
	var maxWidth = 800;
	var maxHeight = 800;

	var image = new Image();
	image.src = dataURL;

	image.onload = function () {
		var width = image.width;
		var height = image.height;
		var shouldResize = (width > maxWidth) || (height > maxHeight);

		if (!shouldResize) {
			sendFile(dataURL);
			return;
		}

		var newWidth;
		var newHeight;

		if (width > height) {
			newHeight = height * (maxWidth / width);
			newWidth = maxWidth;
		} else {
			newWidth = width * (maxHeight / height);
			newHeight = maxHeight;
		}

		var canvas = document.createElement('canvas');

		canvas.width = newWidth;
		canvas.height = newHeight;

		var context = canvas.getContext('2d');

		context.drawImage(this, 0, 0, newWidth, newHeight);

		dataURL = canvas.toDataURL(fileType);

		sendFile(dataURL);
	};

	image.onerror = function () {
		alert('There was an error processing your file!');
	};
}


function sendFile(fileData) {
	var formData = new FormData(this);
	
	formData.append('imageData', fileData);
	var form={};
formData.name=fileData.name;
formData.path=fileData.tmp_name;
	  	console.log(fileData.tmp_name);

	$.ajax({
		type: 'POST',
		url: '../functions.php',
		data: formData,
		contentType: false,
		processData: false,
		success: function (data) {
			if (data.success) {
				alert('Your file was successfully uploaded!');
			} else {
				alert('There was an error uploading your file!!!!');
			}
			data=JSON.parse(data);
		//	console.log(data);
		},
		error: function (data) {
			alert('There was an error uploading your file!');
		}
		
			/*
var formData={};
formData.name=fileData.name;
formData.modify=fileData.lastModified;
formData.modifydate=fileData.lastModifiedDate;
formData.path=fileData.webkitRelativePath;
formData.size=fileData.size;
formData.type=fileData.type;
formData.fun="upload";
	//formData.append('imageData', fileData);
console.log(formData);
 	 $.post('../functions.php',formData,function(data,ts,xhr)
		   {	
		      result=JSON.parse(data);
			   	console.log(data);
			
		   });

	*/
	});
}
//////////////////////////////////////////////////////////////
//////////////list & grid projects display styles/////////////
function list_style(){
		if($('#list').attr('data-active')==0){
			     $('#list').css('background-color','#e6e6e6');	
                 $('#grade').css('background-color','white'); 
				 $('#grid').hide();		
                 $('#list').attr('data-active',"1");
		     	 $('#grade').attr('data-active',"0");			  
		  }
  }
$('#list').on('click',function(){
		 if($(this).attr('data-active')==0){
			     list_style();
                 initial(initial_btn);	
			}
 });
 
		var pro_grade;//
function initial_grid(){
var project=pro_grade;
//console.log(pro_grade);
     for(i=0;i<project.length;i++){
		$('#grid').append(' <div id="div'+project[i]["0"]+'" class="flex_item">  <div class="" style="float: right;width: 64px;"><img src="../images/men-img.png" style="max-width: 100%;box-shadow: none;vertical-align: middle;border: 0;"></div>       <div style="padding-right: 72px;    width: 100%;"><strong class="" style="font-weight: bold;    ">التنمية الريفية </strong>     <ul style="list-style-type: none;padding: 0; ">   <li>اليعر-الحيمة</li>  <li>ممول من منظمات اجنبية </li>  <li class="">hosamali.9.bh@gmail.com</li>   </ul></div>            </div>');
		
		$('#div'+project[i]["0"]+'').mouseover(function(){
			$(this).css("background-color","#efeff8");
		});
		$('#div'+project[i]["0"]+'').mouseleave(function(){
			$(this).css("background-color","white");
		});
			$('#div'+project[i]["0"]+'').click(function(){
			op="dash";
				
			//	P={lat:$(this).attr('data-lat'),lng:$(this).attr('data-lng')};
		
				getall_pro();
		});
       }
  }	
$('#grade').on('click',function(){
	   if($(this).attr('data-active')==0){
	     	$(this).css('background-color','#e6e6e6');
	     	$('#list').css('background-color','white'); 
			$(this).attr('data-active',"1");
		    $('#list').attr('data-active',"0");
            $('#addpro').attr('data-cont',$('#containt').html());
	        $('#tbl_body').hide();
	        $('#tbl_head').hide();
		    $('#grid').show();
			     $('#grid').html("");
			initial_grid();
		 }
   });
////////////////////////////////////////////////////////////////////////////
	  
		var mark; var map; 
	var latlng=[51.5,-0.09];
	var P={lat:15.36796776853800,lng:44.17505512598135};  

function initial_pro(){
		 pro_grade=projects;
	$('#refresh').show();
	$('#confadd').hide()
	$('#formUpload').hide();
	$('.table-title').css('border-bottom','1px solid #a8a8a8');
      $('#tbl_head').show();
	   $('#tbl_body').show();
	   	 $('#groping').show();
	//  $('#containt').css("height","70%");
		$('#addmodal').hide(); 
		$('#del').show();
		
		$('#grade').show();
		$('#list').show();
		$('#list').addClass('back-btn');
		$('#grade').addClass('back-btn');
		$('#grid').hide();
list_style();
			//$('#del').addClass('back-btn');
	 $('#tbl_body').html("");
	 	 /////show footer button

for(i=0;i<projects.length;i++){


var pro={};
 pro.id=projects[i]["0"];
		 pro.v_name=projects[i]["1"];
		 pro.v_lat=projects[i]["2"];
		 pro.v_lng=projects[i]["3"];
		 pro.v_info=projects[i]["4"];
		 pro.v_category=projects[i]["5"];
		  pro.v_start_date=projects[i]["6"];
		  pro.v_finish_date=projects[i]["7"];
		  pro.v_status=projects[i]["8"];
		  pro.v_progerss="منتهي";
		  pro.v_position=[v_lat,v_lng];
		var html_id="td"+pro.id;
/*	var v_photo=projects[i]["8"];
	var photo;var alt;
	var title=v_photo;
	if(v_photo){ photo=v_photo;alt="photo";}else{photo="/images/avatar.png";alt="no photo"}
	*/
	/*+'<img  class="w3-col" src="../'+photo+'" alt="'+alt+'" title='+title+' profile" style="width:50px;border-radius:50%">'+*/
	var classs;var status;
 if(pro.v_status==1) { classs="status text-success"; status="مؤكد";}else{  classs="status text-danger"; status="غير_مؤكد";}
		
         	$('#tbl_body').append(' <tr id="tr'+pro.id+'"> <td><span class="custom-checkbox"><input class="checkboxitem" id="checkbox'+ pro.id+'" name="options[]" value="1" type="checkbox"><label for="checkbox'+ pro.id+'"></label></span></td>                                                                                                        <td id="id'+pro.id+'">'+ pro.id+'</td>     <td id="name'+pro.id+'">'+ pro.v_name+'</td>     <td>'+ pro.v_info+'</td>     <td class="td-lnglat">'+ pro.v_lat+'</td>   <td class="td-lnglat">'+ pro.v_lng+'</td>		<td>'+ pro.v_progerss+'</td><td><div id="proggers"><span class="'+classs+'">•</span>'+ status+'</div></td><td id="action">                                                                               <a id="edit'+pro.id+'" data-id="'+pro.id+'" data-name="'+pro.v_name+'" data-info="'+pro.v_info+'" data-category="'+pro.v_category+'" data-start_date="'+pro.v_start_date+'"  data-finish_date="'+pro.v_finish_date+'"  data-lat="'+pro.v_lat+'"  data-lng="'+pro.v_lng+'" data-status="'+pro.v_status+'"    href="#"  class="edit"  >           <i class="glyphicon glyphicon-" data-toggle="tooltip" title="" data-original-title="تعديل" >✏</i></a>                                                                                 <a id="deletepro'+pro.id+'" data-proid="'+pro.id+'" href="#deletepro" class="delete" )><i class="glyphicon glyphicon-remove" data-toggle="tooltip" title="" data-original-title="حذف"></i></a></td></tr>');
			
				
			$('#deletepro'+pro.id+'').click(function(){
				var id=$(this).attr('data-proid');
				var name=$('#edit'+id+'').attr('data-name');
			//	console.log(id);
			    $(this).attr('data-toggle',"modal");
				$('#deletinfo').html('  هل انت متأكد من حذف مشروع  <b color="#ff5b5b">'+name+'</b><br> رقم<b color="#ff5b5b"> '+id+'</b>');
				
			  $('#delete').click(function(){
				  			  $(this).attr('data-dismiss',"modal").attr('aria-hidden',"true" );
							  
				deletepro(id);
						
		       });
			});
			
			$('#edit'+pro.id+'').click(function(){
				op="dash";
				
				P={lat:$(this).attr('data-lat'),lng:$(this).attr('data-lng')};
		
				getall_pro();
				var id=$(this).attr('data-id');
				var status=$(this).attr('data-status');
				//$(this).attr('data-toggle',"modal");
			   //console.log(id);
			//var pro=$(this).attr('data-pro');
				//console.log();
				
					 var status;
					 var lat=$(this).attr('data-lat');
					 var lng=$(this).attr('data-lng');
		// console.log("ijjn");
	    //id=$("#v_pid").val();
		  $("#pid").val(id);
	   $("#pname").val($(this).attr('data-name'));
	   $("#pinfo").val($(this).attr('data-info'));
	   $("#pcategory").val($(this).attr('data-category'));
	   $("#pstart_date").val($(this).attr('data-start_date'));
		$("#pfinish_date").val($(this).attr('data-finish_date'));
		$("#plat").val(lat);
		$("#plng").val(lng);
		   $("#p_lat").text(lat);
		   $("#p_lng").text(lng);
	//$("#p_lng").text(lng);
		//$("#pimg").val();
	
		confirmed=status == 1 ? 1 : 0;
		$("#pconfirmed").prop('checked',confirmed);
		
		//    $("#v_title").html('تفاصيل المشروع رقم : '+id) ;
	/*	
	 $("#v_pid").val(id);
	 $("#v_name").val($(this).attr('data-name'));
		$("#v_info").val($(this).attr('data-info'));
		$("#v_category").val($(this).attr('data-category'));
		$("#v_start_date").val($(this).attr('data-start_date'));
		$("#v_finish_date").val($(this).attr('data-finish_date'));
		$("#v_lat").text($(this).attr('data-lat'));
		$("#v_lng").text($(this).attr('data-lng'));
		
	$("#h_lat").text($(this).attr('data-lat'));
		$("#h_lng").text($(this).attr('data-lng'));

		confirmed=status == 1 ? 1 : 0;
		$("#pconfirmed").prop('checked',confirmed);
		
		if(status==1)
			$("#v_active").prop('checked',1);
		else
			$("#v_pasive").prop('checked',1);
*/
	$('#title').html(" <i class='glyphicon glyphicon-map-marker'  data-toggle='tooltip' title='' data-original-title='تعديل'></i> تعديل المشروع رقم "+id+" ");
			$('#addpro').html("رجوع");
			
			
			$('#addpro').addClass('back-btn');
			
				$('#addpro').attr('data-cont',$('#containt').html());	
				$('#save').html(" تعديل ");
				
				$('#add').hide();
				$('#edit').show();
				$('#edit').on('click',update);
				//$('#edite').html(" حفظ التغيرات ");
			});
		
	
}

	$('#tbl_body').append(' <tr id="final_tr" style="height:33px;"> <td></td>                                                                                                        <td ></td>    <td ></td>   <td ></td>   <td ></td>   <td ></td>   <td ></td>   <td ></td>   <td ></td>   </tr>');

		$('#title').html(" كل المشاريع"+msg);
			$('#addpro').addClass('back-btn');
	
			//$('#addpro').addClass('addproject');
			$('#del').addClass('addproject');
			$('#addpro').html("<img id='addpimg' src='../images/zz_emoji_plus.png' style='opacity:1;' height='25px'>مشروع جديد");
$('#addpro').on('mouseover',function(){
	$('#addpimg').css("opacity","2");

});
$('#addpro').on('mouseleave',function(){
	//$('#addpimg').css("height","35px");
		$('#addpro').css("color","rgb(119, 119, 119)").css("background-color", "transparent");
			$('#addpimg').css("opacity","1");
});



				$('#addpro').attr('data-cont',$('#containt').html());				
				//$('#addpro').attr('data-op','dash');
				op='dash';
}


var start=1;

function getall_pro(){
	 ref();	
	//	projects= refresh();	
		//var op=$('#addpro').attr('data-op');
				$('#mssg').html('');					       $("#title").show();
$("#selectAll").prop("checked", false);
//console.log(op);
		switch(op){
			case 'dash':
			$('#addpro').attr('data-cont',$('#containt').html());
	$('#tbl_body').hide();
	   $('#groping').hide();
	      $('#containt').css("height","85%");
   $('#addmodal').css('display','contents');
		$('#confadd').show();
		$('#formUpload').css('display','initial');
		$('.table-title').css('border-bottom','0px solid #a8a8a8');
		$('#refresh').hide();
		
	//	 console.log(content);
	$('#title').html(" <i class='glyphicon glyphicon-map-marker'  data-toggle='tooltip' title='' data-original-title='إضافة مشروع جديد'></i> مشروع جديد");
		$('#addpro').html("رجوع");
		//console.log($("[name='file[]']").target.files);
	//	files=e.target.files.length;
	//	console.log( files);
/*if(  $("#file").attr('file')){
	
	    $("#mssg").append( $("#file").files.length+" صور محدده ");
}*/
			$('#addpro').addClass('back-btn');
		$('#del').hide();
		$('#save').html("حفظ");
		$('#edit').hide();
				$('#add').show();
			//	$('#pname').focus();
				

			
			//$('#addpro').attr('data-op','add');
                  op='add';
		$('#tbl_head').hide();
	    $('#grid').hide();
	$('#grade').hide();
		$('#list').hide();
		if(start==1){
          $('#add').on('click',function(){
				$('#upload').submit();
				});
		getmap();
		}
		else{
		clearLayer(P);
		}
        	//$("button[name='save']").click()		
               break;	
	case 'add':
		//console.log($('#addpro').attr('data-cont'));	
	      $('#containt').css("height","78%");
		  initial(initial_btn);
		  for(i=0;i<projects;i++){
			   pro_grade[i]=projects[i][0];
		  }
		 
           // create_listbutton();
			//$('#containt').html($('#addpro').attr('data-cont'));		
			break;
		}
		// var content=$('#table-hover').html();

		}	

$('#addpro').click(getall_pro);

/*	var option=<?php  if(isset($_GET['section']))echo 1;else echo 0;?>;	
	if(option==1){
getall_pro();
	}*/


	

	
	/////map////
	var satellite=L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
	attribution: '',
	maxZoom: 18,
	//icon:'images/marker blue.png',
	id: 'mapbox/satellite-streets-v11',
	accessToken: 'pk.eyJ1IjoiaG9zYW1hbGkiLCJhIjoiY2s2NWo3OGc4MTdpMTNscTEyd2toM3k0dyJ9.WbmuwS_Wy0O-t1rJWu8O9A'
	});
	var streets=L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
	attribution: '',
	maxZoom: 18,
	//icon:'images/marker blue.png',
	id: 'mapbox/streets-v11',
	accessToken: 'pk.eyJ1IjoiaG9zYW1hbGkiLCJhIjoiY2s2NWo3OGc4MTdpMTNscTEyd2toM3k0dyJ9.WbmuwS_Wy0O-t1rJWu8O9A'
	}) ;
	var baseMaps = {
	"خطوط السير": streets,
	"قمرصناعي":satellite
	};
	
	var overlayMaps = {
	"Cities": cities
	}; 
	
	var school_icon; var blue_icon;
	var green_icon;var red_icon;
	var add_icon; 
	 function set_icons(){
    blue_icon=L.icon({
	iconUrl:'..images/marker_blue.png',
	iconSize:[40,41],
	iconAnchor:[18,42],
	popupAnchor:[5,-38],
	});
    green_icon=L.icon({
	iconUrl:'../images/marker_green.png',
	iconSize:[40,41],
	iconAnchor:[18,42],
	popupAnchor:[5,-38],
	//iconAnchor:[-20,-20]
	//padding:50
	});
    red_icon=L.icon({
	iconUrl:'../images/marker_red.png',
	iconSize:[40,41],
	iconAnchor:[18,42],
	popupAnchor:[5,-38],
	});
	add_icon=L.icon({
	iconUrl:'../images/maps/ic_add_location_24px.svg',
	iconSize:[40,41],
	iconAnchor:[18,42],
	popupAnchor:[5,-38],
	});
	school_icon=L.icon({
	iconUrl:'../images/maps/ic_school_24px.svg',
	iconSize:[40,41],
	iconAnchor:[18,42],
	popupAnchor:[5,-38],
	});
	}

	   var mark;
	var   layergroup;
function clearLayer(p){
	   layergroup.clearLayers();
     layer=L.marker(p,{icon:green_icon}).addTo(map);
	 layergroup.addLayer(layer);
	 
}	
function getmap(){
//layer control 

$('#mapdiv').html('');

    map = L.map('mapdiv', {
    center: P,
    zoom: 14,
	//markers:'../images/marker red.png',
    layers: [streets, satellite]
    });

    L.control.layers(baseMaps).addTo(map);
	
    	    set_icons();
    layer=L.marker(P,{icon:green_icon}).addTo(map);
	   layergroup=L.layerGroup(layer).addTo(map);	
    start=0;
// mark=L.marker(P,{icon:green_icon} ).addTo(map);
   // mark.bindPopup();

	

	
	   layergroup.addLayer(layer);
	 //  layer.bindPopup();
	   
      $("#pstart_date").val("<?php echo getdate_now();?>");	

	
    map.on('click', function onMapClick(e) {
		


    var lat=e.latlng.lat;
    var lng=e.latlng.lng;
		$("#plat").val(lat);
	$("#plng").val(lng);
	
    $("#p_lat").text(lat);
	$("#p_lng").text(lng);
	
   clearLayer(e.latlng);
	 
    });
	
	
	}
/*	
	$(".edit").click(function(){

<?php

$get_uid="document.getElementById('getuid').value";
   $sq="select * from user where user_id=".$get_uid;
   $su=$db->query($sq);	 
?>  
});
*/
function addp(images){
		   
      $("#pstart_date").val("<?php echo getdate_now();?>");	

	
	 //$("button[name='save']").toggle();
		 var pro={};var status;
		// console.log("ijjn");
	    id=$("#v_pid").val();
	    pro.name=$("#pname").val();
	    pro.info=$("#pinfo").val();
	    pro.category=$("#pcategory").val();
		pro.start_date=$("#pstart_date").val();
		pro.finish_date=$("#pfinish_date").val();
		pro.lat=$("#plat").val();
		pro.lng=$("#plng").val();
		pro.images=images;
	
	if($("#pconfirmed").prop('checked')==true){ status=1;}else{ status=0;}
	   pro.status=status;
	   pro.fun='insert';
	   
		$.post('../functions.php',pro,function(rt,ts,xhr)
		{	
	      var jes=JSON.parse(rt);
		  //	console.log(jes);
			var msg=jes[3];
		     projects=jes[0];
		  if(jes[1]===true){  //if insert execute successfully 
		      
	 		   $('#tbl_head').show();
			   create_listbutton();
			   
			    if(jes[2]==1){  //if project is confirmed
				   $("#mssg").css("color","rgb(16, 196, 105)");
				   $("#mssg").html(jes[1]+"✔  تمت الإضافة ◀ "+msg);	
				   	 $('#containt').css("height","72%");
				}
			    else{   //if project is not confirmed
				  $("#mssg").css("color","#b9b408");
			      $("#mssg").html(jes[1]+"✔ تمت الإضافة ◀ "+msg+" : ستتم الموافقه والإشعار من قبل الإدارة ");
				  	 $('#containt').css("height","68%");
				}		
				
		  } 
		  else {//if insert not execute  	
			   $("#mssg").html("❌لم تتم الإضافة  ◀ قد يوجد مشورع بنفس الإسم").css("color","#e65651");
		
		  }
			//if(ts=="error"){
				// $("#mssg").css("color","red");
			//}
		
	    });	
		
}

function deletepro(id){
	var delet={};
	delet.fun='del';
	delet.pid=id;
	$.post('../functions.php',delet,function(result,ts,xhr)
		{	
			if(ts=="error"){
				  $("#mssg").html("لم يتم الحذف").css("color","#e65651");
			}
			else{
				// console.log(result);
	      var json=JSON.parse(result);
		     projects=json[0];
		  if(json[1]>0){  //if insert execute successfully 
	 		   //$('#tbl_head').show();
			    create_listbutton();
			   		$("#mssg").css("color","rgb(16, 196, 105)").css("font-size","20px");
$("#title").hide();
				   $("#mssg").html("تم حذف المشروع رقم : "+json[1]);
				   
				 /*  $('#tr'+id+'').hide();
				   	 $('#count-hint').html(count-1);
					 count=count-1;
					 	 $('#count-group').html(($('#count-group').html())-1);
						 project.length=$('#count-group').html();*/
					
	 /////show footer button
	 $('#groping').show();
	 // $('#containt').css("height","70%");	

		  } 
		  else if(json[1]==0){//if insert not execute  	
			   $("#mssg").html("لم يتم الحذف").css("color","#e65651").css("font-size","20px");

		  }	
			}
			//create_listbutton();
			
		//	   initial_pro();
		 	  //$('#containt').css("height","72%");
		
	    });	
}

 function update(){

	 	
	    id=$("#pid").val();
	    name=$("#pname").val();
	   info=$("#pinfo").val();
	    category=$("#pcategory").val();
		start_date=$("#pstart_date").val();
		finish_date=$("#pfinish_date").val();
		lat=$("#plat").val();
		lng=$("#plng").val();
		img=$("#pimg").val();
	if($("#pconfirmed").prop('checked')==true){ status=1;}else{ status=0;}
	   status=status;
	
	  
	 var xmlhttp;
	 if(window.XMLHttpRequest)
		 xmlhttp=new XMLHttpRequest();
	 else
	xmlhttp=new ActiveXobject("Microsoft.XMLHTTP");	 

xmlhttp.onreadystatechange=function(status){
	if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
			//	console.log(JSON.parse(xmlhttp.responseText));
			var jeson=JSON.parse(xmlhttp.responseText);
	
				$("#mssg").text("تم التعديل بنجاح");
				  projects=jeson[0];
	 		   $('#tbl_head').show();
			   create_listbutton();
			   
				   $("#mssg").css("color","rgb(16, 196, 105)");
				   $("#mssg").html("تم التعديل بنجاح");	
				     $('#containt').css("height","78%");
				//console.log(jeson);
			//map.removeLayer(ly);
	//layergroup.clearLayers();
//getmarkers(jeson);	
	}
	else {//if insert not execute  
		//var jeson=JSON.parse(xmlhttp.responseText);
   	  	  //  projects=jeson[0];	
			   $("#mssg").html("لم يتم التعديل").css("color","#e65651");
		
		  }
		 
}
		
xmlhttp.open("POST","../functions.php",true);
xmlhttp.setRequestHeader("content-type","application/x-www-form-urlencoded");
xmlhttp.send('pid='+id+'&name='+name+'&info='+info+'&category='+category+'&start_date='+start_date+'&finish_date='+finish_date+'&lat='+lat+'&lng='+lng+'&confirmed='+status+'&fun=update');
 }

 
 
});



	

</script>
</head>
<body >


     
	
        <div id="table-wrapper"  class="table-wrapper" >
		
            <div class="table-title">
                <div class="row">
					 
			
		
										
					
					 
					  <b id="title" style="font-size: 20px;">	
			  
						كل المشاريع</b>
						 <span id="mssg" style="color:#fff937;font-size:20px;"></span>
					<div class="col-sm-6" >
				<div>
					<button id="addpro" data-cont="" data-op="dash"style="font-size:16px;font-weight:600;text-align:center;margin-left:5px;					   background-color :rgba(255, 255, 255, 0);
	color: #777;" class="btn btn-success" >مشروع جديد<img src="../images/zz_emoji_plus.png" height="25px"></button>
					</div>
						<div>
						
					<form  id="formUpload" enctype="multipart/form-data" style="display:none" >	
					              <input  id="back" type="button" class="btn btn-success" style="font-size:16px; font-weight: 600;"   data-dismiss="modal" value="تهيئة" onclick="$('#reset').click(); ">
	
					<a href="#conf" id="confadd" data-toggle="modal" style="display:none">
					<button id="save" class="btn btn-info" style="font-size:16px;font-weight: 600;" value="save" >حفظ</button></a>	
					
	   
			         <img src="../images/electronics-img.png" width="40px" title="إضافة صور" style="cursor:pointer;    " onclick="$('#file').click();"  >
			 		 <span  style="vertical-align: text-top;" id="selectedimg"></span>
					 <input type="file" id="file" name="file[]" multiple="multiple" style="display:none" accept="image/*" browse="gallery"  >
					 
			  <input type="submit" id="upload" name="upload" value="رفع" hidden>
				</form>

			
				
			<a href="projects.php" id="refresh" class="btn-lg " style="text-align:center;margin-right:0px" ><img src="../images/ic_settings_reset.png" height="25px"></a>
					
						<button id="del" class="btn btn-del" style="font-size:16px;font-weight:600;text-align:center;margin-right:0px;background-color :rgba(255, 255, 255, 0);color: #777;margin-left:10px">
						<img src="../images/sticker_store_delete.png" width="22px" height="22px">حذف </button>	
	             
			
							<button id="list" data-active="1" class="btn btn-success" style="    text-align:center;	margin-left:0px;				    background-color :#e6e6e6;color: #4c4c4c;border-top-right-radius: 3px;border-bottom-right-radius: 4px">
						    <img src="../images/icon_list.png" width="13px"> 
						   </button>	
							
							<button id="grade" data-active="0" class="btn btn-success" style=" margin-right: -0.2px;text-align:center;margin-left:0px;
							background-color:white;color:#4c4c4c;border-top-left-radius:5px; border-bottom-left-radius: 4px;">
						    <img src="../images/icon_grid.png" width="13px"> 
						</button>	
	     </div>
		   </div>
					<div class="col-sm-6">
					<b><?php if(isset($_GET['msg'])){$msg=$_GET['msg']; echo $msg;}else echo $msg?></b>
					
					</div>
			
                </div>
            </div>
			<div class="containt" id="containt" >
            <table id="table-hover" class="table table-striped table-hover" style="border-collapse:collapse; width:100%"  >
                <thead id="tbl_head">
                    <tr >
						<th>
							<span class="custom-checkbox">
	                            <input id="selectAll" type="checkbox">
								<label for="selectAll"></label>
							</span>
						</th>
						<th >الرقم </th>
						<th > اسم المشروع</th>
                        <th>معلومات</th>
						<th>Lat</th>
						<th>Lng</th>
                       <th>التقدم</th>
					    <th>الحالة</th>
						 <th>الحدث</th>
                    </tr>
                </thead>
                <tbody id="tbl_body">
			
	 
				
				
                </tbody>
				
				<div  id="addmodal" class="modal" style="display:none"   >
					<form  class = "w3-container" role ="form" style="margin-top:-14px">
					<input  id="reset" class="btn btn-success" style="font-size:16px; font-weight: 600;"   data-dismiss="modal" value="تراجع" type="reset" hidden>
				<div id="mobile-content" class="modal-content"    border-radius: 22px;">

		<div id="mobile-form" style="padding:2px 2px;border:">
				<div class="modal-body" style="width:-webkit-fill-available;padding:2% 3% 5px 3%">
			
				<input class="form-control" id="pid"  type="hidden" name="pid"  >إسم المشروع<textarea id="pname" class = "form-control"  type="text" name="pname" required autofocus></textarea> 	التصنيف <select id="pcategory" class = "form-control" name="pcategory"><option>صحي</option><option>إجتماعي</option><option>تعليمي</option><option>تنموي</option><option>محلي</option><option>sport</option></select>التفاصيل <textarea id="pinfo" class = "form-control"  type="text" name="pinfo" rows="3" required> </textarea>	تاريخ البداء <input id="pstart_date" class = "form-control" DIR="rtl" type="text" name="pstart_date" > تاريخ الإنتهاء من المشروع <input id="pfinish_date" class = "form-control"  DIR="rtl" type="text" name="pfinish_date"  ><input id="pstatus"  type="hidden" name="pstatus"  value="0">
				
		
				</div>  
						
</div>
				
				<div id="mobile-map"class="" style="padding:1% 3% 0px 3%;border-right:solid 1px #dddddd">
				<h5 style="text-align:right;margin-right:1%"><img src='../images/attach-location.png' height='40px'> إختر الموقع</h5>
				<div id="mapdiv" style="width:100%;height: 200px;margin:0px 2% 0px 0px 0px;text-align:center;border:solid 1px #dddddd;"></div> 
				
<div class="" style="width:95%;margin:5px;display:inline-block">
<input id="plat"  type="hidden" name="plat" value="" >  
 <input  id="plng"  type="hidden" name="plng" value="" >
 <div style="width:42%;height:30px;;margin-bottom:-11px;display:inline">
 lat:<label class = "form-control"   id="p_lat"   dir="rtl" name="p_lat"   ></div>
 <div style="width:42%;height:30px;;margin-bottom:-11px;display:inline">
 lng:<label  class = "form-control" width="50%"   id="p_lng"   name="p_lng"   ></div>	<br> 


				<label> حالة المشرروع</label>		
			<span class="custom-checkbox"><input id="pconfirmed" name="pconfirmed" value="1" type="checkbox"><label for="pconfirmed"></label></span>
	</div>
		
		

				
				</div> 
</form>
				</div>      

			</div>

			
				<div id="conf" class="modal fade" style="display: none;"><div class="modal-dialog"><div class="modal-content"><div class="modal-header">						<h4  class="modal-title">حفظ بيانات المشروع</h4><button type="button" class="w3-button w3-xlarge w3-transparent w3-display-topright" data-dismiss="modal" aria-hidden="true" title="Close Modal"> X</button></div><div class="modal-body">					<p>هل انت متأكد من حفظ بيانات المشروع</p><p class="text-warning"><small>أو إلغاء لعدم الحفظ</small></p></div><div class="modal-footer">	<button id="add"  class="btn btn-info" type="button"  data-dismiss="modal" aria-hidden="true" title="save new project" name="save"   >حفظ </button>	<button id="edit"  style="display:none" class="btn btn-info" type="button"  data-dismiss="modal" aria-hidden="true" title="save new project" name="edit"    >حفظ التغيرات </button><input class="btn btn-default"  name="cancel" data-dismiss="modal"		title="CloseModel" value="تراجع" type="button"></div></div></div></div> 
				
<div id="deletepro" class="modal fade" style="display: none;"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4 class="modal-title">حذف المشروع</h4><button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove"></i></button></div><div class="modal-body"><p id="deletinfo">?</p><p class="text-warning"><small> إلغاء لعدم الحذف</small></p></div><div class="modal-footer"><input   name="u_name" value="'+v_name+'" type="hidden">
<input   name="u_id" value="'+id+'" type="hidden"><input class="btn btn-danger" id="delete"  name="delete" value="حذف" type="submit"><input class="btn btn-default" name="cancel" data-dismiss="modal" value="إلغاء" type="button"></div></div></div></div>				
		  </table>
		  
<div id="grid" class="flex_container" style="display: none;">


</div> 
				
			
</div>
		  		<div id="groping" class="clearfix" style="    padding: 5px;">
                <div id="show-hint" class="hint-text"style="float:right"></div>
                <div style="display: grid;">  
				   <ul id="groups" class="pagination">
                   </ul>
				</div>
            </div>
    </div>


                 

<?php
//include"../footer.php"
?>

<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/common.js"></script>
<script type="text/javascript" src="../js/slider.js"></script>
<script type="text/javascript" src="../js/owl.carousel.min.js"></script>
<script type="text/javascript">
    //<![CDATA[
$('#imgbtn').click(function(){
$('#addimg').toggle();
});
	jQuery(function() {
		jQuery(".slideshow").cycle({
			fx: 'scrollHorz', easing: 'easeInOutCubic', timeout: 10000, speedOut: 800, speedIn: 800, sync: 1, pause: 1, fit: 0, 			pager: '#home-slides-pager',
			prev: '#home-slides-prev',
			next: '#home-slides-next'
		});
	});
    //]]>
    </script>

<script>

		new UISearch( document.getElementById( 'form-search' ) );


			
		</script>
		<script>
setTimeout(hidedive,5000);
function hidedive(){
var b= document.getElementsByTagName('body');
if(b[0].children[b[0].children.length-1].tagName=="DIV"){
b[0].children[b[0].children.length-1].style="display:none"
}
 
}
</script>
		
                                		                            </body></html>



