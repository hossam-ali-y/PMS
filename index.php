<?php
  @session_start();
	 require_once"connectdb.php";//connect to db newsdb
    require_once"modal.php";  		 	

 $nid='';
 $msg="";
 
 ////////////////get_all_projects////////////////
 function getallprojects(){ 
    global $db;
    $sql="select * from projects ";
    $result=$db->query($sql);
	$locations=array();
   foreach($result as $i){
	  $locations[]=$i;
    }
 	echo json_encode($locations);
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

$finish_date=$_POST['finish_date'];;
$status=$_POST['status'];

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
		  $msg=" تم التعديل بنجاح ";
	  }
}
CATCH(PDOException $e){
 $msg ="invalid connection";
die($e->getMessage());
			 }
			 echo $msg;
}
///////////////////////////////////

function getdate_now(){
	return date('D d-m-yy');
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <title>PMS</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 		<meta name="description" content="">
		<meta name="author" content="">

<!-- Mobile Specific -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

 	<!-- Put favicon.ico and apple-touch-icon(s).png in the images folder -->
	    <link rel="shortcut icon" href="assets/images/ws_logo.png">


       <script src="bootstrap/js/jquery.min.js"></script>
       <script src="bootstrap/js/bootstrap.min.js"></script>
  
	<link rel="stylesheet" href="css/my.css">
		<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
  	    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		
		<link rel="stylesheet" href="css/style.css" type="text/css">

		<link rel="stylesheet" href="bootstrap/css/icon.css">
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
   #map{height:89%;margin: 7px 0px 3px 0px}
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
		padding:0 0 0 3px;
		width:100%;
	}
	.page{
		margin:0 0 0 2px;
	}
.nav-inner {
	
	margin:0 -4 0 -3px;

	
}	
element.style {
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
	}
	.search-icon, .search-bar-submit {
		padding:15px;
		height:47px;
	}
	#search.search-bar-input{
		padding-right:15%;
		height:90%;
		width:60%
	}
  </style>
   <!--end leaflet map api-->
   
<script type="text/javascript">

$(document).ready(function(){
	// Activate tooltip
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
<div class="page" id="map">

  <div  >

     
  </div>
<!-- End page content -->


<?php
//require_once"footer1.php"
?>

</div>
<!--my script javascript-->
 <script>
var point=0;
  var  current='marker';
  var path=[];
 var latlng=[51.5,-0.09];
  var P={lat:15.369445,lng:44.191006};
  
  //var locations=<?php getallprojects() ?>;
    var locations=<?php getconfirmed() ?>;
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
	

var mark=L.marker(P).addTo(map);
    mark. bindPopup('<lable id="startmark">PMS نظام ادارة مشاريع</lable>')
    .openPopup();
	mark.on('click', info_toggle);
	
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
var confirmed;
for(i=0;i<locations.length;i++){
var pro={};

		pro.pid=locations[i][0];
		pro.name=locations[i][1];
		pro.v_lat=locations[i][2];
		pro.v_lng=locations[i][3];
		pro.info=locations[i][4];
		pro.category=locations[i][5];
		pro.start_date=locations[i][6];
		pro.finish_date=locations[i][7];
		pro.status=locations[i][8];
		
		pro.position=[pro.v_lat,pro.v_lng];
if(pro.status==0){icon=blue_icon;}else{icon=green_icon;}

marker=L.marker(pro.position,{
	p:pro,icon:icon,
	title:'مشروع رقم '+pro.pid,
	riseOnHover:true,
	bubblingMouseEvents:true}).addTo(map);
    marker. bindPopup('<a href="#ViewProjectModal" id="a" class="add" data-toggle="modal"> <button id="btn" class="w3-button w3-black w3-section">تفاصيل المشروع رقم '+pro.pid+'<i class="fa fa-paper-plane"></i></button> </a><a href="#" ><button id="btn"  class="w3-button w3-black w3-section" onclick="createpath()">إنشاء مسار</button></a>');
   // .openPopup();
   
	  marker.on('click',function(e){
	estart=e;
console.log(this.pro);
	$("#v_pid").val(this.options.p.pid);
	$("#v_name").val(this.options.p.name);
		$("#v_info").val(this.options.p.info);
		$("#v_start_date").val(this.options.p.start_date);
		$("#v_finish_date").val(this.options.p.finish_date);
		$("#v_lat").text(this.options.p.v_lat);
		$("#v_lng").text(this.options.p.v_lng);
	$("#h_lat").text(this.options.p.v_lat);
		$("#h_lng").text(this.options.p.v_lng);
		
		confirmed=this.options.p.status == 1 ? 'checked' : 0;
		$("#confirmed").prop(confirmed,this.options.p.status);
		
		if(this.options.p.status==1)
			$("#v_active").prop('checked',1);
		else
			$("#v_pasive").prop('checked',1);
		
		//	$(".status").val(this.options.p.v_lng);
			
	    $("#v_title").html('تفاصيل المشروع رقم : '+this.options.p.pid) ;
		//$("#ViewProjectModal").toggle();
		});
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
     mark=L.marker(p).addTo(map);
   mark.bindPopup('<a href="#AddProjectModal"  id="a" class="add" data-toggle="modal"> <button id="btn"  class="w3-button w3-black w3-section" ><i class="fa fa-paper-plane"></i> إنشاء مشروع جديد</button> </a><a href="#" ><button id="btn"  class="w3-button w3-black w3-section" onclick="createpath()">إنشاء مسار</button></a>');
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
    var m=L.marker(p).addTo(map);
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
