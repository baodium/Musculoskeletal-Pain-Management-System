<?php
session_start();
include '../includes/class.Db.php';
$handle=new Db();
$disorders=$handle->loadDisorders();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>MPMS</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="../css/coin-slider.css" />
<script type="text/javascript" src="../js/cufon-yui.js"></script>
<script type="text/javascript" src="../js/droid_sans_400-droid_sans_700.font.js"></script>
<script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../js/script.js"></script>
<script type="text/javascript" src="../js/coin-slider.min.js"></script>
</head>
<body style="background:#fff url(../images/main_bg2.jpg) repeat-x center 112px;">
<div class="main" style="">
  <div class="header" style="background:#6A9FBE; height:112px;">
    <div class="header_resize">
      <div class="menu_nav">
        <ul >
          <li><a href="index.php" style="color:#FFFFFF"><span>Musculoskeletal Pains</span></a></li>
          <li><a href="test.php" style="color:#FFFFFF"><span>Musculoskeletal Pain Test</span></a></li>
          <li class="active" ><a href="logout.php" style="color:#FFFFFF"><span>Logout</span></a></li>
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
          <h2><span>Admin Home</span><span style="float:right"><input type="button" name="register"  style="float:right; cursor:pointer" value="Add New Musculoskeletal Pain" id="button" onClick="loadUrl('new.php');" class="send" /></span></h2><br/><br/>
          <div class="clr"></div>
          <table name="" style="width:650px; font-size:16px;"  border="0px">
         <tr>
         <th>Musculoskeletal Pain</th><th>Body Part</th><th>View Full Detail</th><th>Edit</th><th>Delete</th>
         </tr>
         <?php 
		 $i=0;
		 foreach($disorders as $disorder){ 
		 $i++;
		 ?>
         <tr class="<?php echo $i%2==0?'even':'odd'; ?>" style="border:0px;">
         <td><?php echo $disorder['name'];?></td><td><center><?php echo $disorder['part_id'];?></center></td><td><center><a href="detail.php?id=<?php echo $disorder['d_id']; ?>"><img src="../images/down.png" style="width:32px; height:32px" /></a></center></td><td><center><a href="edit.php?id=<?php echo $disorder['d_id']; ?>"><img src="../images/korganizer_todo.png" style="width:32px; height:32px" /></a></center></td><td><center><a href="#" onclick="delete('<?php echo $disorder['d_id']; ?>')"><img src="../images/messagebox_critical.png" style="width:32px; height:32px" /></a></center></td>
         </tr>
         <?php } ?>
         </table>
        </div>
      </div>
      <div class="sidebar">
        <div class="searchform">
          <form id="formsearch" name="formsearch" method="post" action="#">
            <span>
            <input name="editbox_search" class="editbox_search" id="editbox_search" maxlength="80" placeholder="Search" type="text" />
            </span>
            <input name="button_search" src="../images/search.gif" class="button_search" type="image" />
          </form>
        </div>
        <div class="clr"></div>
        <div class="gadget">
          <h2 class="star">Menu</h2>
          <div class="clr"></div>
          <ul class="sb_menu" style="font-size:130%; ">
          <li><a href="index.php" style=""><span>Musculoskeletal Pains</span></a></li>
          <li><a href="test.php" style=""><span>Musculoskeletal Pain Test</span></a></li>
          <li class="active" ><a href="logout.php" style=""><span>Logout</span></a></li>
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
        <a href="#"><img src="../images/gal1.jpg" width="75" height="75" alt="" class="gal" /></a> <a href="#"><img src="../images/gal2.jpg" width="75" height="75" alt="" class="gal" /></a> <a href="#"><img src="../images/gal3.jpg" width="75" height="75" alt="" class="gal" /></a>   </div>
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
