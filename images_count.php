<?php  

    @session_start();

				$im=array();
	if(isset($_GET['lengths'])){
		
		 $im[1]=$_GET['lengths'];
	    if(isset( $_SESSION['lengths'] )){
		   unset($_SESSION['lengths']);
	     }
		 
		  $_SESSION['lengths']=$_GET['lengths'];
	    
          $im[0]=$_SESSION['lengths'];
	}
	else
        $im[0]=0;

	$pro=0;
	if(isset($_POST['image'])){
	$pro=count($_POST['image']);
	}
?>

			<div class="item-price"><div class="price-box" style="overflow: hidden;margin:8px 35px 5px 35px ;"> <span class="regular-price"> <span class="price" dir="rtl"><?php echo $_POST['name']?></span> </span> </div></div><div class="page" ><div class="container" style="display:block;height:150px; width:284px;overflow:auto"   ><div class="std"><div class="best-seller-pro wow bounceInUp animated" ><div class="slider-items-products"><div id="best-seller-slider" class="product-flexslider hidden-buttons">
			<div  id="item<?php echo $_POST['pid']?>" class="slider-items slider-width-col4">   <?php for($i=0;$i<$pro;$i++){?>
			<div class="item" ><div class="item-inner"><div class="product-block"><div class="product-image"> <a href="#ViewProjectModal" class="add" data-toggle="modal" ><figure class="product-display">
			<div class="sale-label sale-top-right"><?php echo $_POST['category'];?></div>
			<img src="<?php echo $_POST['image'][$i];?>"  height="126px" width="180px" class="lazyOwl product-mainpic" alt="صورة المشروع" style="display: block;">
			<img  src="<?php echo $_POST['image'][$i];?>"class="product-secondpic" height="126px" width="180px" alt="صورة المشروع"> </figure></a> </div><div class="product-meta"><div class="product-action"> <a class="addcart" href="shopping_cart.html"> <i class="icon-heart">&nbsp;</i> اعجبني </a> <a class="wishlist" href="wishlist.html"> <i class="icon-heart">&nbsp;</i>متابعة </a> </div></div></div><div class="item-info"><div class="info-inner"><div class="item-content"><div class="item-price"><div class="price-box"> <span class="regular-price"> <span class="price">1 صورة من ..</span> </span> </div></div><div class="rating"><div class="ratings"><div class="rating-box"><div class="rating" style="width:80%"></div></div><p class="rating-links"> <a href="#">1 صورة من ..</a> <span class="separator">|</span> <a href="#">اعجبني</a> </p></div></div></div></div></div></div> </div>'<?php ;}?>   </div></div></div></div></div></div></div>
