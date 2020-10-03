<?php
  @session_start();

  	require_once"functions.php";
	 require_once"connectdb.php";//connect to db newsdb
    require_once"modal.php";
  //  include"images_count.php";
 

 $nid='';
 $msg="";
 $pid='';

 
 ////////////add project/////////////////
if(isset($_POST['send']) ){
$name=$_POST['name'];
$lat=$_POST['lat'];
$lng=$_POST['lng'];
$info=$_POST['info'];
$category=$_POST['category'];
//$start_date=date('y-m-d h:m');

$start_date=$_POST['start_date'];

$finish_date=$_POST['finish_date'];;
$status=$_POST['status'];
try{
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

	 if(!$exe){
	   $msg="لم تتم إضافة المشروع قد يوجد مشورع بنفس الإسم";	
		}
	  else{
		  $msg=" <br> تمت إضافة المشروع بنجاح ستتم الموافقه والإشعار من قبل الإدارة";
	  }
}
CATCH(PDOException $e){
 $msg ="invalid connection";
die($e->getMessage());
			 }
			 echo $msg;
}
//////////////////edit project/////////////////
if(isset($_POST['save']) ){
	try{
$pid=$_POST['pid'];
$name=$_POST['name'];
$lat=$_POST['lat'];
$lng=$_POST['lng'];
$info=$_POST['info'];
$category=$_POST['category'];
//$start_date=date('y-m-d h:m');

$start_date=$_POST['start_date'];

$finish_date=$_POST['finish_date'];
if(isset($_POST['confirmed']))
$status=1;
else
	$status=0;
	      $sql="update projects set name=?,info=?,category=?,start_date=?,finish_date=?,status=? where id=?";

         $state=$db->prepare($sql);	
		 $state->bindValue(1,$name);
		 $state->bindValue(2,$info);
		 $state->bindValue(3,$category);
		 $state->bindValue(4,$start_date);
		 $state->bindValue(5,$finish_date);
		 $state->bindValue(6,$status);
		 $state->bindValue(7,$pid);
		 $exe=$state->execute();

	 if(!$exe){
	   $msg="لم يتم التعديل".$status;	
		}
	  else{
		  $msg=" تم التعديل بنجاح ".$status;
	  }
}
CATCH(PDOException $e){
 $msg ="invalid connection";
die($e->getMessage());
			 }
			 echo $msg;
}
///////////////////////////////////


?>

<!DOCTYPE html>
<html dir="rtl" >
<head>
  <title>الرئيسية <<PMS</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 		<meta name="description" content="">
		<meta name="author" content="">
 
<!-- Mobile Specific -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

 	<!-- Put favicon.ico and apple-touch-icon(s).png in the images folder -->
	     <link type="image/x-icon" rel="shortcut icon" href="images/attach-location.png">
	 

       <script src="bootstrap/js/jquery.min.js"></script>
       <script src="bootstrap/js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="css/my.css">
		<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
  	    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		
		<link rel="stylesheet" href="css/style.css" type="text/css">

		<link rel="stylesheet" href="bootstrap/css/icon.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/font-awesome.css" type="text/css">

<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/slider.css" type="text/css">
<link rel="stylesheet" href="css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="css/owl.theme.css" type="text/css">



<!-----------------leaflet maps Api--------------->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
   
     <!-- Make sure you put this AFTER Leaflet's CSS -->
  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin="">
   </script>
   
  <style>
   #map{height:89%;margin: 0px 0px 0px 0px}
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
//////////////////////////////////////////@media//////////////////////////////////////////////////
@media only screen and (max-width:480px)
{

	#search {
    width: 50%;

}
#search:focus {
	width: 55%;

}
	.search-icon, .search-bar-submit {
		height:47px;
	  padding-left: 4px;
    padding-right: 3px;
	}
#search.search-bar-input {height: 80%;}

}
@media only screen and (min-width:480px)
{
	.search-icon {
    padding-top: 23px;
  
    padding-right: 18px;
}
	#search.search-bar-input{
		padding-right:15%;
		height:90%;
		width:60%
	}
	
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

.product-block .product-image, .product-block .product-image a, .product-block .product-image .product-display, .product-block .product-image .product-display img{
	display:contents;
}
.product-block:hover .product-image .product-mainpic {
    -webkit-transform: rotateY(-180deg);
    -moz-transform: rotateY(-180deg);
    -ms-transform: rotateY(-180deg);
    -o-transform: rotateY(-180deg);
    transform: rotateY(-180deg);
    opacity: 1;
}
.sale-label {
	padding:0px 5px;
	
}
.sale-top-right {

    right: -8px;
}
.new_title{
	margin:0px;
}
.new_title.center {
 
    text-align: center;
	font-size:15px;
}

a:hover, a:focus {
    color: #44d6e4;
    text-decoration: none;
}
.price {
		font-size: 12px;
		color: #333;
		white-space: initial;
	}

  </style>
   <!--end leaflet map api-->
   
<script type="text/javascript">

$(document).ready(function(){
	// Activate tooltip
		//$('#home').attr("href","admin/projects.php");
			$('#admin').attr("href","admin/projects.php");
				$('#admin1').attr("href","admin/projects.php");
	$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});
</script>

  </head>
  
<body id="body">

<?php 
  require_once"nav.php";
/*if($msg!=""){
	echo"<script> alert(.$msg.); </script>";
}*/
?>
<span id="mssg" height="5px" font="size:20px" style=" margin:30%"></span >

<div class="page" id="map">

<!-- End page content -->


<?php
//require_once"footer1.php"
?>

</div>


<div id="imgcontent" style="display:none">
	
			</div>
	
<!--my script javascript-->
 <script>
$(function(){
	$('#shortcut_icon').attr("href","images/attach-location.png");
	function addPro(images){
		 var pro={};
	    //id=$("#v_pid").val();
	    pro.name=$("#l_name").val();
	    pro.info=$("#info").val();
	    pro.category=$("#category").val();
		pro.start_date=$("#start_date").val();
		pro.finish_date=$("#finish_date").val();
		pro.lat=$("#html_lat").val();
		pro.lng=$("#html_lng").val();
		pro.img=$("#img").val();
		pro.images=images;
		pro.fun='insert';

	   
		$.post('functions.php',pro,function(rt,ts,xhr)
		{	
			var jes=JSON.parse(rt);
		  //	console.log(jes);
			var msg=jes[3];
		     projects=jes[0];
		  if(jes[1]===true){  //if insert execute successfully 
		      
	 		      layergroup.clearLayers();
               getmarkers(jes[0]);
			   
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
	    });	

}
 ///////////////////////////////////////
		var files=0;
	$('#file1').on('change',function(e){
		files=e.target.files.length;
		console.log( e);
		  $("#selectedimg1").css("color","#b9b408").css("font-size","18");
    $("#selectedimg1").html(files+" صورة محددة");
	});
	///////////////////////////////////////////
$('#formUpload1').on('submit',function(e){
			 
	e.preventDefault();
	
		   var formData=new FormData(this);
//console.log(formData);
	
	$.ajax({
		type:'POST',
		url: 'admin/upload.php',
		data:formData,
		contentType: false,
		processData: false,
		success: function (data) {
			data=JSON.parse(data);
			if (data.images) {
				//console.log(data.images);
	
				addPro(data.images);
				
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
////////////////////////////////////

	//////////////////////////////////////////
		$('#searchdone').click(function(){
			$('#search').focus();
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
	
	
	
	$('#nav-home').addClass('level0 parent drop-menu active');
});
var point=0;
  var  current='marker';
  var path=[];
 var latlng=[51.5,-0.09];
  var P={lat:15.36796776853800,lng:44.17505512598135};
  

    var conflocations=<?php getconfirmed() ?>;
	  var unconflocations=<?php getunconfirmed() ?>;
	  
//var map = L.map('map').setView([51.505, -0.09], 13);

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

//layer control 
	
     map = L.map('map', {
    center: P,
    zoom: 14,
	//markers:'images/marker blue.png',
    layers: [streets, satellite]
    });
    
    var baseMaps = {
    "خطوط السير": streets,
    "قمرصناعي":satellite
    };
    
    var overlayMaps = {
    "Cities": cities
    }; 
    L.control.layers(baseMaps).addTo(map); 
	


//////get all marker
var i;var position;var marker;
//var name; var pid;var info;var category;
//var start_date;var v_lat;var v_lng;
//var name=new Array();
//var pid=new Array();
//var info=new Array();
//var category=new Array();
//var start_date=new Array();
//var v_lat=new Array();
//var v_lng=new Array();
	var default_icon=L.icon({
	iconUrl:'images/marker-icon.png',
			iconAnchor:[18,42],
			popupAnchor:[5,-38],
});
	var blue_icon=L.icon({
	iconUrl:'images/marker_blue.png',
		iconSize:[40,41],
			iconAnchor:[18,42],
			popupAnchor:[5,-38],
});
	var green_icon=L.icon({
	iconUrl:'images/marker_green.png',
	iconSize:[40,41],
	iconAnchor:[18,42],
	popupAnchor:[5,-38],
	//iconAnchor:[-20,-20]
	//padding:50
});
	var red_icon=L.icon({
	iconUrl:'images/marker_red.png',
		iconSize:[40,41],
		iconAnchor:[18,42],
			popupAnchor:[5,-38],
});
	var add_icon=L.icon({
	iconUrl:'images/maps/ic_add_location_24px.svg',
		iconSize:[40,41],
			iconAnchor:[18,42],
			popupAnchor:[5,-38],
});
	var school_icon=L.icon({
	iconUrl:'images/maps/ic_school_24px.svg',
		iconSize:[40,41],
			iconAnchor:[18,42],
			popupAnchor:[5,-38],
});
 var locations;
var confirmed;
var layer;
var ly;


var mark=L.marker(P,{icon:default_icon}).addTo(map);
    mark. bindPopup('<a href="#AddProjectModal"  id="a" class="add" data-toggle="modal"> <button id="btn"  class="w3-button w3-black w3-section" ><i class="fa fa-paper-plane"></i> إنشاء مشروع جديد</button> </a><a href="#" ><button id="btn"  class="w3-button w3-black w3-section" onclick="createpath()">إنشاء مسار</button></a><button id="btn"  class="w3-button w3-black w3-section" onclick="mouse_event()">استعراض بتمرير الماوس</button>',{maxWidth:300,minWidth:200});
//	mark.on('click', info_toggle);
	///////////////////////////  
	  		 $('#h_add').on('click',function(){
				
				$('#upload1').submit();
		
				});
	///////////////////////////////
var   layergroup=L.layerGroup(mark).addTo(map);
 var mouse_enent='click';
 
 function mouse_event(){
	 if(mouse_enent=='click')
	 mouse_enent='mouseover';
    else if(mouse_enent=='mouseover')
	 mouse_enent='click';
 
 layergroup.clearLayers();
 all_locations=<?php getallprojects() ?>;
getmarkers(all_locations[0]);	
 }
 
 var all_locations=<?php getallprojects() ?>;
  console.log( all_locations[0]);
getmarkers(all_locations[0]);


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
	

$('#search').on('keyup',function(){
		 var result;
		 var search={};
		  search.search='search';
	      search.text=$(this).val();
	
	 	 $.post('functions.php',search,function(rt,ts,xhr)
		   {	
		      result=JSON.parse(rt);
			   projects= result[0];
			//   console.log(result[2]);
	            if(result[1]>=1){  //if insert execute successfully 
			   	  // console.log(projects);		   
					 if(search.text!=""){
						  $("#title").hide();
							 $("#mssg").css("color","rgb(34, 171, 34)").css("font-size","20px");
						       $("#mssg").html(result[1]+" نتيجة بحث عن "+search.text);	
					 }
			       else{
					       $("#title").show();
						    $("#mssg").html("");
						
				   }
				 }
			    else {
					 $("#title").hide();
			        $("#mssg").html("لايوجد نتائج مطابقة").css("color","#e65651").css("font-size","20px");
	              }
				  	layergroup.clearLayers();
					
					console.log(result[0]);
				     getmarkers(result[0]);
	           });
	 });

function getmarkers(locations,event){

var images;
for(i=0;i<locations.length;i++){
	// console.log( locations[i]);
	var project=locations[i][0];
var pro={};
		pro.pid=project["0"];
		pro.name=project["1"];
		pro.v_lat=project["2"];
		pro.v_lng=project["3"];
		pro.info=project["4"];
		pro.category=project["5"];
		pro.start_date=project["6"];
		pro.finish_date=project["7"];
		pro.status=project["8"];
		pro.position=[pro.v_lat,pro.v_lng];
		pro.i=0;
		pro.image=[];
		
	//console.log(project["11"]);
		//	var i[pro.pid]=0;
if(pro.status==0){icon=blue_icon;}else{icon=green_icon;}
var k;var images=[];var img;

if(locations[i][1]!==undefined){
pro_img=locations;//for search
}else{
	pro_img=all_locations[0];//for on_load
	//images[0]="products-images/product1.jpg";
}

if(pro_img[i][1].length==0)
images[0]="products-images/product1.jpg";
else{
	for(k=0;k<pro_img[i][1].length;k++){
	img=pro_img[i][1][k]["img_path"];
if(img===null){
	images[k]="products-images/product1.jpg";
	
	}
else{images[k]=img;}
}
}
 pro.image=images;
 //"<?php $images='+images+'?>";
// console.log( pro.image);
/*
var content=  '<div class="item-price"><div class="price-box" style="overflow: hidden;margin:8px 35px 5px 35px ;"> <span class="regular-price"> <span class="price" dir="rtl">'+pro.name+'</span> </span> </div></div><div class="page" ><div class="container" style="display:block;height:150px; width:284px;overflow:auto"   ><div class="std"><div class="best-seller-pro wow bounceInUp animated" ><div class="slider-items-products"><div id="best-seller-slider" class="product-flexslider hidden-buttons"><div  id="items'+pro.pid+'" class="slider-items slider-width-col4">'+
                     for(var i=0;i<pro.image.length;i++){
	  +'<div class="item" ><div class="item-inner"><div class="product-block"><div class="product-image"> <a href="#ViewProjectModal" class="add" data-toggle="modal" ><figure class="product-display"><div class="sale-label sale-top-right">'+pro.category+'</div><img src="'+pro.image[i]+'" height="126px" width="180px" class="lazyOwl product-mainpic" alt="صورة المشروع" style="display: block;"> <img  src="'+pro.image[i]+'" class="product-secondpic" height="126px" width="180px" alt="صورة المشروع"> </figure></a> </div><div class="product-meta"><div class="product-action"> <a class="addcart" href="shopping_cart.html"> <i class="icon-heart">&nbsp;</i> اعجبني </a> <a class="wishlist" href="wishlist.html"> <i class="icon-heart">&nbsp;</i>متابعة </a> </div></div></div><div class="item-info"><div class="info-inner"><div class="item-content"><div class="item-price"><div class="price-box"> <span class="regular-price"> <span class="price">1 صورة من ..</span> </span> </div></div><div class="rating"><div class="ratings"><div class="rating-box"><div class="rating" style="width:80%"></div></div><p class="rating-links"> <a href="#">1 صورة من ..</a> <span class="separator">|</span> <a href="#">اعجبني</a> </p></div></div></div></div></div></div> </div>'+
	   
   }+
   '</div></div></div></div></div></div></div>';
   //   this.options.content=content;
  // console.log($('#'+this.options.p.pid+''));
  
  
  var contents;
function gethtml(pro){
$.post('images_count.php',pro,function(rt,ts,xhr)
		{	
	 	contents=rt;
	     });
		 console.log(pro.image.length);

		 return contents;
	 
}
   */

$('#item').html("");
$('#imgcontent').html('	<div class="item-price"><div class="price-box" style="overflow: hidden;margin:8px 35px 5px 35px ;"> <span class="regular-price"> <span class="price" dir="rtl">'+pro.name+'</span> </span> </div></div><div class="page" ><div class="container" style="display:block;height:150px; width:284px;overflow:auto"   ><div class="std"><div class="best-seller-pro wow bounceInUp animated" ><div class="slider-items-products"><div id="best-seller-slider" class="product-flexslider hidden-buttons"><div  id="item" class="slider-items slider-width-col4">                                  </div></div></div></div></div></div></div>');
for(var j=0;j<pro.image.length;j++){
	$('#item').append('<div class="item" ><div class="item-inner"><div class="product-block"><div class="product-image"> <a href="#ViewProjectModal" class="add" data-toggle="modal" ><figure class="product-display"><div class="sale-label sale-top-right">'+pro.category+'</div><img src="'+pro.image[j]+'"  height="126px" width="180px" class="lazyOwl product-mainpic" alt="صورة المشروع" style="display: block;"><img  src="'+pro.image[j]+'"class="product-secondpic" height="126px" width="180px" alt="صورة المشروع"> </figure></a> </div><div class="product-meta"><div class="product-action"> <a class="addcart" href="shopping_cart.html"> <i class="icon-heart">&nbsp;</i> اعجبني </a> <a class="wishlist" href="wishlist.html"> <i class="icon-heart">&nbsp;</i>متابعة </a> </div></div></div><div class="item-info"><div class="info-inner"><div class="item-content"><div class="item-price"><div class="price-box"> <span class="regular-price"> <span class="price">'+(j+1)+' صورة من '+pro.image.length+'</span> </span> </div></div><div class="rating"><div class="ratings"><div class="rating-box"><div class="rating" style="width:80%"></div></div><p class="rating-links"> <a href="#">'+j+' صورة من '+pro.image.length+'</a> <span class="separator">|</span> <a href="#">اعجبني</a> </p></div></div></div></div></div></div> </div> ');
}
pro.content=$('#imgcontent').html();
layer=L.marker(pro.position,{
	p:pro,icon:icon,name:pro.name,
	title:pro.name,
		alt:pro.name,
		content:pro.content,
	riseOnHover:true});

	// layer.bindPopup(this.content);

  layer.on('mouseout',function(e){
	  
//this.bindPopup(this.options.content).closePopup();
          // this.options.p.i=1;
		            
  })
	
layer.on(mouse_enent,function(e){
       
	estart=e;

	$("#v_pid").val(this.options.p.pid);
	$("#v_name").val(this.options.p.name);
		$("#v_info").val(this.options.p.info);
		$("#v_category").val(this.options.p.category);
		$("#v_start_date").val(this.options.p.start_date);
		$("#v_finish_date").val(this.options.p.finish_date);
		$("#v_lat").text(this.options.p.v_lat);
		$("#v_lng").text(this.options.p.v_lng);
	$("#h_lat").text(this.options.p.v_lat);
		$("#h_lng").text(this.options.p.v_lng);
		
		confirmed=this.options.p.status == 1 ? 1 : 0;
		$("#confirmed").prop('checked',confirmed);
		
		if(this.options.p.status==1)
			$("#v_active").prop('checked',1);
		else
			$("#v_pasive").prop('checked',1);

	    $("#v_title").html('تفاصيل المشروع رقم : '+this.options.p.pid) ;
		
			
//  <?php  $j="<script><>"?>;


	//this.bindPopup(content).openPopup();
	var pop;
	//console.log(contents);
		if(this.options.p.i==0&&mouse_enent=='click'){
			pop=this.bindPopup(this.options.p.content).openPopup();
		   this.options.p.i=1;
		}
		else if(mouse_enent=='mouseover'){
			pop=this.bindPopup(this.options.p.content).openPopup();
           this.options.p.i=1;
		}
		//layer.bindPopup('<div id="itm'+pro.pid+'">hhhhhhhhhhh</div>');

/*	layer.content.load('images_count.php',pro.image.length,function(rt){
	
});*/
		
		
	/*
if(!pop.isOpen)
pop.openPopup();
else{
		pop.closePopup();
	pop.openPopup();
}

*/
		});
			 
   layergroup.addLayer(layer);
}
}

	 var id;var name;var info;var start_date;
	 var finish_date;var category;var status;
	 var lat;var lng;var img;
	 
function update(){

	 
	    id=$("#v_pid").val();
	    name=$("#v_name").val();
	    info=$("#v_info").val();
	    category=$("#v_category").val();
		start_date=$("#v_start_date").val();
		finish_date=$("#v_finish_date").val();
		lat=$("#v_lat").text();
		lng=$("#v_lng").text();
		
		if($("#confirmed").prop('checked')==true){
       status=1;
		}
      else{
		     status=0;
	  }
	
	 var xmlhttp;
	 if(window.XMLHttpRequest)
		 xmlhttp=new XMLHttpRequest();
	 else
	xmlhttp=new ActiveXobject("Microsoft.XMLHTTP");	 

xmlhttp.onreadystatechange=function(status){
	if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
			var jeson=JSON.parse(xmlhttp.responseText);
			 $("#mssg").css("color","#b9b408");
				$("#mssg").html("تم التعديل بنجاح");
				//console.log(jeson);
			//map.removeLayer(ly);
	layergroup.clearLayers();
getmarkers(jeson[0]);	
	}
}
		
xmlhttp.open("POST","functions.php",true);
xmlhttp.setRequestHeader("content-type","application/x-www-form-urlencoded");
xmlhttp.send('pid='+id+'&name='+name+'&info='+info+'&category='+category+'&start_date='+start_date+'&finish_date='+finish_date+'&lat='+lat+'&lng='+lng+'&confirmed='+status+'&fun=update');
 }
/*
function get_info(){
var i=10;
pid=locations[i][0];
	name=locations[i][1];
	info=locations[i][4];
	category=locations[i][5];
	start_date=locations[i][6];
	v_lat=locations[i][2];
	v_lng=locations[i][3];
	
 $("#v_name").val(name);
 $("#v_info").val(info);
 $("#v_start_date").val(start_date);
 $("#v_lat").text(v_lat);
 $("#v_lng").text(v_lng);
 
 $("#ViewProjectModal").toggle();
	
}*/

function view_toggle(e){
		onMapClick(e);
var p_lat;
	  var pro_lat=estart.latlng.lat;   
  for(i=0;i<locations.length;i++){
	  p_lat=info[i];
	if(true){
			$("#v_name").val(name[i]);
				
	$("#v_info").val(info[i]);
		$("#v_start_date").val(start_date[i]);
		$("#v_lat").text(v_lat[i]);
		$("#v_lng").text(v_lng[i]);
		
		$("#ViewProjectModal").toggle();
		break;
	   }
	  $("#ViewProjectModal").toggle();
  }	
}

var z;
var estart;
 var p;
 
 function onMapClick(e) {
   console.log(e)
   estart=e;
   switch (current){
     case 'marker':
    // L.marker().removeFrom(map)	;
     mark.remove();
     p=[e.latlng.lat,e.latlng.lng];    
     mark=L.marker(p,{icon:default_icon}).addTo(map);
   var popup=mark.bindPopup('<a href="#AddProjectModal"  id="a" class="add" data-toggle="modal"> <button id="btn"  class="w3-button w3-black w3-section" ><i class="fa fa-paper-plane"></i> إنشاء مشروع جديد</button> </a><a href="#" ><button id="btn"  class="w3-button w3-black w3-section" onclick="createpath()">إنشاء مسار</button></a><button id="btn"  class="w3-button w3-black w3-section" onclick="mouse_event()">استعراض بتمرير الماوس</button>',{maxWidth:300,minWidth:200});
   //	<div  id="ViewProjectModal" class="modal" style="display:contents"   ><div class="modal-dialog" style="max-width: 100%;@media (min-width: 768px).modal-dialog{width:100%} ;border-radius: 32px;margin:-4px 0px 0px 0px;"  ><div class="modal-content" > <div class="modal-header" align="center">		<h4 class="modal-title" id="v_title">معلومات المشروع</h4></div>			 <div class="modal-body"><input class="form-control" id="v_pid"  type="hidden" name="pid"  >إسم المشروع<input id="v_name" class = "form-control"  type="text" name="name" required ="true"> 	التصنيف <select id="v_category" class = "form-control" name="category"><option>صحي</option><option>إجتماعي</option><option>تعليمي</option><option>تنموي</option><option>محلي</option><option>sport</option></select>التفاصيل <textarea id="v_info" class = "form-control"  type="text" name="info" rows="3" required> </textarea>	تاريخ البداء <input id="v_start_date" class = "form-control" DIR="rtl" type="text" name="start_date" > تاريخ الإنتهاء من المشروع <input id="v_finish_date" class = "form-control"  DIR="rtl" type="text" name="finish_date"  ><input id="v_status"  type="hidden" name="v_status"  value="0"><div class="w3-center"  dir="ltr"><label dir="rtl">الموقع</label><input id="h_lat"  type="hidden" name="lat" value="" >   <input  id="h_lng"  type="hidden" name="lng" value="" > lat:<label id="v_lat"  type="text" name="lat" ></label>  &nbsp;lng:<label  id="v_lng"  type="text" name="lng" ></label></div><label> حالة المشرروع :</label> &nbsp; <input id="confirmed" type="checkbox" name="confirmed"  > تفعيل</div></div></div></div>
  //  .openPopup();
	var lat=e.latlng.lat;
	var lng=e.latlng.lng;
		$("#html_lat").val(lat);
	$("#html_lng").val(lng);
	
    $("#l_lat").text(lat);
	$("#l_lng").text(lng);
		  ////// date by php ///////
	   $("#start_date").val("<?php echo getdate_now();?>");
	
	//mark.on('click', info_toggle);
    break;

    case 'path': 
    createpath();
       z=p;
   }
}
map.on('click', onMapClick);

//var body=document.getElementById("body");

function info_toggle(e){

	$("#AddProjectModal").toggle();
	

	/*
	var datetime=new Date();
	var date=datetime.getDate();
	var month=datetime.getMonth();
	var day=datetime.getDay();
	var year=datetime.getFullYear();
		var full_datet=date+"-"+month+"-"+year;
		/////date by javascript ////////
		//  $("#start_date").val(full_datet);
		
	var hour=datetime.getHours();
	var minute=datetime.getMinutes;
	var second=datetime.getSeconds;
	      var full_time=hour+":"+minute+":"+second;
*/
//	$("#start_date").val("<?php echo getdate_now();?>");
	 

}


function addMarker(){
  current='marker';
}
function createpath(){
if(current!='path'){
point=0;
addPath();
}
point=point+1;
 
    var p=[estart.latlng.lat,estart.latlng.lng];    
    var m=L.marker(p,{icon:default_icon}).addTo(map);
    m.bindPopup('<span id="options">point: '+point+'<br>lat:'+estart.latlng.lat+'<br>lng:'+estart.latlng.lng+'</span><button id="btn-save'+point+'" style="display:none"  class="w3-button w3-black w3-section" onclick="savePath()" >حفظ المسار</button> ')
    .openPopup();
	   if(point>1){	
				document.getElementById("btn-save"+point).style.display='block';
	   }
   
    path.push(p);
    drow();
}

function addPath(){
  current='path';
  path=[];
}
function savePath(){
	        document.getElementById("btn-save"+point).innerHTML='تم الحفظ ';
      current='marker';
      point=0;
    //   drow();
       // zoom the map to the polyline
    map.fitBounds(polyline.getBounds());
    }
   var polyline; 
    function drow(){
       polyline = L.polyline(path, {color: 'red'}).addTo(map);
  
    console.log(path);
    }
    
    //layer group 
    var littleton = L.marker([39.61, -105.02]).bindPopup('This is Littleton, CO.'),
    denver    = L.marker([39.74, -104.99]).bindPopup('This is Denver, CO.'),
    aurora    = L.marker([39.73, -104.8]).bindPopup('This is Aurora, CO.'),
    golden    = L.marker([39.77, -105.23]).bindPopup('This is Golden, CO.');
    var cities = L.layerGroup([littleton, denver, aurora, golden]);
    
</script>


<!-- JavaScript -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/slider.js"></script>
<script type="text/javascript" src="js/owl.carousel.min.js"></script>
<script type="text/javascript">
    //<![CDATA[
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
		
</body>
</html>
