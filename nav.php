  
  <!-- Navbar -->
  <nav>
    <div class="container">
      <div class="nav-inner">
        <!-- mobile-menu -->
        <div class="hidden-desktop" id="mobile-menu">
          <ul class="navmenu">
            <li>
              <div class="menutop">
                <div class="toggle"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></div>
                <h2>Menu</h2>
              </div>
              <ul style="display:none;" class="submenu">
                <li>
				
                  <ul class="topnav">
				  <li class="level0 nav-6 level-top first parent"> <a id="home" class="level-top" href="home.php"> <span>الرئيسية</span> </a>
                      <ul class="level0">
                        <li class="level1"><a href="../../layout-1/red/index.html"><span>حسام اليعري</span></a> </li>
                        <li class="level1"><a href="../../layout-2/red/index.html"><span> نظام ادارة مشاريع</span></a> </li>
                      
                         </ul>
                    </li>
					     <li class="level0 level-top parent"> <a class="level-top" id="admin" href="projects.php"><span>لوحة التحكم</span></a></li>
						 
                    <li class="level0 nav-1 level-top first parent"> <a href="grid.html" class="level-top"> <span>التصنيفات</span> </a>
					 <ul class="level1" style="display: none;">
					 
					 			    <li class="level0 parent drop-menu"><a href="#"><span>حسب التاريخ</span></a>
        <ul class="level1" style="display: none;">
          <li><a href="#">01-01-2020 - 01-01-2021 </a></li>
          <li><a href="#">01-01-2021 - 01-01-2022</a></li>
          <li><a href="#">01-01-2022 - 01-01-2023</a></li>
          <li><a href="#">01-01-2023 - 01-01-2024</a></li>
        </ul>
      </li>
  <li><a href="#" >كل المشاريع</a></li>       
	   <li><a href="#">صحية</a></li>
       <li><a href="#">اجتماعية</a></li>
		  <li><a href="#">تعليمية</a></li> 
          <li><a href="#">تنموية</a></li>
          <li><a href="#">محلي</a></li> 
		  </ul>
                    </li>
		


                    <li class="level0 nav-2 level-top parent"> <a href="#" class="level-top"> <span>تسجيل الدخول</span> </a>

                    </li>
                    <li class="level0 nav-3 level-top parent"> <a href="#" class="level-top"> <span>حول الموقع</span> </a>
         
                    </li>
              
                
                  </ul>
                </li>
		
              </ul>
            </li>
          </ul>
          <!--navmenu-->
        </div>
        <!--End mobile-menu -->
        <ul id="nav" class="hidden-xs">	
          <li id="nav-home" class="level0 parent drop-menu"><a id="home1" href="home.php"><span>الرئيسية</span> </a>
         
          </li>
		  			
					<?php if(isset($_SESSION['u_name'])){	?>
   <li class="level0 parent drop-menu"><a href="#"><span>حسابي</span></a>
           <ul class="level1" style="display: none;">
		  <li><a  href="index.php" title="<?php  echo $_SESSION['u_name']; ?>">صفحتي الشخصية </a></li>
				 <li><a href="#edituserModal" title="<?php echo ' البيانات الشخصية ل '.$_SESSION['u_name']?>" data-toggle="modal" >ملفي الشخصي</a></li>
     
		  <?php if(isset($_SESSION['status'])) {  
		  echo "<li><a href='admin/ad.php'>Content Manag</a></li>";
		  echo"<li><a href='admin/modifyusers.php'>users managment</a></li>";
		} ?> 

          </ul>
      </li>
	   <?php 
		  }?>

      <li class="level0 parent drop-menu"><a href="#"><span>التصنيفات</span></a>
        <ul class="level1" style="display: none;">
          <li><a href="#">كل المشاريع</a></li>
          <li><a href="#">تنموية</a></li>
          <li><a href="#">اجتماعية</a></li>
          <li><a href="#">تعليمية</a></li>
        </ul>
      </li>

         <li class="level0 parent drop-menu"><a href="#"><span>حسب التاريخ</span></a>
        <ul class="level1" style="display: none;">
          <li><a href="#">01-01-2020 - 01-01-2021 </a></li>
          <li><a href="#">01-01-2021 - 01-01-2022</a></li>
          <li><a href="#">01-01-2022 - 01-01-2023</a></li>
          <li><a href="#">01-01-2023 - 01-01-2024</a></li>
        </ul>
      </li>

<!-- Navbar (sit on top) -->

          <li class="level0 nav-7 level-top parent"> <a href="#" class="level-top"> <span>سجل في الموقع</span> </a>
        
          </li>

        <li id="control-panel" class="nav-custom-link level0 level-top parent"> <a class="level-top" id="admin1" href="projects.php"><span>لوحة التحكم</span></a></li>

          <li class="nav-custom-link level0 level-top parent"> <a class="level-top" href="#"><span>حول الموقع</span></a>
            <div style="display: none; left: 0px;" class="level0-wrapper">
              <div class="header-nav-dropdown-wrapper clearer">
                <div class="grid12-5">
                  <h4 class="heading">أخر الأخبار</h4>
                  <div class="ccs3-html5-box"><em class="icon-html5">&nbsp;</em> <em class="icon-css3">&nbsp;</em></div>
                  <p>Our designed to deliver almost everything you want to do online without requiring additional plugins.CSS3 has been split into "modules".</p>
                </div>
                <div class="grid12-5">
                  <h4 class="heading">عرض المشاريع القريبة منك</h4>
                  <a href="#">
                  <div class="icon-custom-reponsive"></div>
                  </a>
                  <p>Responsive design is a Web design to provide an optimal navigation with a minimum of resizing, and scrolling across a wide range of devices.</p>
                </div>
                <div class="grid12-5">
                  <h4 class="heading">الإنتقال الى عرض المشاريع</h4>
                  <a href="#//">
                  <div class="icon-custom-google-font"></div>
                  </a>
                  <p>Our font delivery service is built upon a reliable, global network of servers. Our flexible solution provides multiple implementation options.</p>
                </div>
                <div class="grid12-5">
                  <h4 class="heading">كافة المشاريع  </h4>
                  <a href="#//">
                  <div class="icon-custom-grid"></div>
                  </a>
                  <p>Smart Product Grid is uses maximum available width of the screen to display content. It can be displayed on any screen or any devices.</p>
                </div>
                <br>
              </div>
            </div>
          </li>
        </ul>
        <div id="form-search" class="search-bar">
          <form id="search_mini_form" action="#" method="get">
		              <span class="search-icon"style="font-size:20px" id="rssearchspan">🔎</span>
            <input class="search-bar-input" placeholder="إبحث هنا" type="text" value="" name="search" id="search">
            <input id="searchdone"class="search-bar-submit" type="button" value="">

          </form>
        </div>
      </div>
    </div>
  </nav>
 
  <!-- end nav -->