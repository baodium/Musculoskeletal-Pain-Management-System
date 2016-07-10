<?php
session_start();
include 'includes/class.Db.php';

 
$handle=new Db();
if(isset($_POST['login'])){
$username=strip_tags($_POST['username']);
$password=strip_tags($_POST['password']);
$param=array('username'=>$username,'password'=>$password);
$done=$handle->login($param);

if(count($done)>0){
$_SESSION['ergouser']=$done;
header("location:test.php");
}else{
//var_dump($done);
echo '<script>alert("Invalid username or password");</script>';
}
//var_dump($done);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>MPMS</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/coin-slider.css" />
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/droid_sans_400-droid_sans_700.font.js"></script>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/coin-slider.min.js"></script>
</head>
<body style="background:#fff url(images/main_bg2.jpg) repeat-x center 112px;">
<div class="main" style="">
  <div class="header" style="background:#6A9FBE; height:112px;">
    <div class="header_resize">
      <div class="menu_nav">
        <ul >
          <li><a href="index.php" style="color:#FFFFFF"><span>Home</span></a></li>
          <li><a href="test.php" style="color:#FFFFFF"><span>Disorder Test</span></a></li>
          <li><a href="disorders.php" style="color:#FFFFFF"><span>Disorders</span></a></li>
          <li><a href="statistics.php" style="color:#FFFFFF"><span>Statistics</span></a></li>
          <?php if(isset($_SESSION['ergouser'])){ echo  ' <li class="active" ><a href="logout.php" style="color:#FFFFFF"><span>Logout</span></a></li>'; }else {echo  ' <li class="active" ><a href="login.php" style="color:#FFFFFF"><span>Login</span></a></li>'; } ?>
        </ul>
      </div>
      <div class="logo" >
      <h1><a href="index.html" style="color:#FFFFFF"><span>MPMS</span><br/> <small style="padding-bottom:20px; color:#FFFFFF ">Musculoskeletal Pain Management System</small></a></h1>
         </div>
      <div class="clr"></div>
      <div class="clr"></div>
    </div>
  </div>
  <div class="content">
    <div class="content_resize">
      <div class="mainbar">
        <div class="article">
          <h2><span>login Form</span></h2>
          <div class="clr"></div>
          <form action="#" method="post" id="sendemail" name="login-form" >
          <br/>
          <fieldset style="border-radius:5px; border:1px solid #999999">
         <br/>
            <ol style="padding-left:60px" >
             
             
              <li>
                <label for="website">Username</label>
                <input id="website" name="username" class="text" />
              </li><br/>
              <li>
                <label for="message">Password</label>
                <input  type="password" id="website" name="password" class="text" />
                
              </li><br/>
             
              <li>
              <p style="float:right; margin-right:70px"> <span style="margin-bottom:50px"><a href="register.php">You don't have an account? Register Here</a> &nbsp;</span><input type="submit" name="login" id="button" value="Login"   class="send" /></p>
              </li>
            </ol>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <ol>
              <li></li>
              <li>
                <div class="clr"></div>
              </li>
            </ol>
            </fieldset>
          </form>
        </div>
      </div>
      <div class="sidebar">
        <div class="searchform">
          <form id="formsearch" name="formsearch" method="post" action="#">
            <span>
            <input name="editbox_search" class="editbox_search" id="editbox_search" maxlength="80" value="Search our ste:" type="text" />
            </span>
            <input name="button_search" src="images/search.gif" class="button_search" type="image" />
          </form>
        </div>
        <div class="clr"></div>
        <div class="gadget">
          
         <h2 class="star"><span>Menu</h2>
          <div class="clr"></div>
          <ul class="sb_menu" style="font-size:130%; ">
          <li class="active"><a href="index.php"><span>Home</span></a></li>
          <li><a href="test.php"><span>Disorder Test</span></a></li>
           <li><a href="disorders.php"><span>Disorders</span></a></li>
          <li><a href="statistics.php"><span>Statistics</span></a></li>
         <?php if(isset($_SESSION['ergouser'])){ echo  ' <li  ><a href="logout.php" ><span>Logout</span></a></li>'; }else {echo  ' <li  ><a href="login.php" ><span>Login</span></a></li>'; } ?>
          </ul>
        </div>
      </div>
      <div class="clr"></div>
    </div>
  </div>
  <div class="fbg">
    <div class="fbg_resize">
      <div class="col c1">
        <h2><span>Image</span> Gallery</h2>
        <a href="#"><img src="images/gal1.jpg" width="75" height="75" alt="" class="gal" /></a> <a href="#"><img src="images/gal2.jpg" width="75" height="75" alt="" class="gal" /></a> <a href="#"><img src="images/gal3.jpg" width="75" height="75" alt="" class="gal" /></a>   </div>
      <div class="col c2">
        <h2><span>Services</span> Overview</h2>
        <p>Curabitur sed urna id nunc pulvinar semper. Nunc sit amet tortor sit amet lacus sagittis posuere cursus vitae nunc.Etiam venenatis, </p>
        
      </div>
      <div class="col c3">
        <h2><span>Contact</span> Us</h2>
        <p>Nullam quam lorem, tristique non vestibulum nec, consectetur in risus. Aliquam a quam vel leo gravida gravida eu porttitor dui.</p>
       
      </div>
      <div class="clr"></div>
    </div>
  </div>
  
</div>
</body>
</html>
