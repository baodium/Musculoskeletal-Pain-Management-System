<?php
session_start();
include '../includes/class.Db.php';
$handle=new Db();
$parts=$handle->loadParts();
if(isset($_POST['registered'])){
//var_dump($_POST);
$done=$handle->addUser($_POST);
if($done){
header('location:login.php');
}else{
echo '<script>alert("Username already exisit!")</script>';
}
}
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
          <h2><span>New Muskuloskeletal Pain</span></h2>
          <div class="clr"></div>
          <form action="" method="post" id="sendemail" name="new_m" >
          <br/>
          <fieldset style="border-radius:5px; border:1px solid #999999"><br/>
            <ol style="padding-left:60px">
              <li>
                <label for="name">Muskuloskeletal Pain</label>
                <input id="name" name="name" class="text" />
              </li>
              <li>
                <label for="sex">Body Part</label>
                <select name="part" id="select" >
                <?php
				foreach ($parts as $part){
				echo '<option name="'.$part['part_id'].'">'.$part['part_name'].'</option>';
				}
				?>
               
                </select>
              </li>
              <li>
                <label for="description">Description</label>
                <textarea  name="description" rows="3">                        
                </textarea>
              </li>
              <li>
                <label for="symptoms">Symptoms</label>
               <textarea  name="" rows="3">                   
                </textarea>
              </li>
              <li>
                <label for="treatment">Treatment</label>
               <textarea  name="" rows="3">                    
                </textarea>
              </li>
              <li>
                <label for="recommendation">Recommendation</label>
                <textarea  name="recommend" rows="3">                
                </textarea>
               
              </li>
          
              <li>
                <label for="question">Test Question1</label>
                <textarea  name="answer" rows="2"> 
                                  
                </textarea>             
              </li>
              <li>
                <label for="question">Option 1</label>
                <textarea  name="option1" rows="2"> 
               </textarea>             
              </li>
              <li>
                <label for="question">Option 2</label>
                <textarea  name="option2" rows="2"> 
               </textarea>             
              </li>
              <li>
                <label for="question">Option 3</label>
                <textarea  name="option3" rows="2"> 
               </textarea>             
              </li>
              <li>
                <label for="question">Option 4</label>
                <textarea  name="option4" rows="2"> 
               </textarea>             
              </li>
              <li>
                <label for="question">Answer for question 1</label>
                <select name="answer">
                <option name="" value="option1">Option 1</option>
                <option name="" value="option2">Option 2</option>
                <option name="" value="option3" >Option 3</option>
                <option name="" value="option4">Option 4</option>
                </select>             
              </li>
              <br/>
               <li>
                <label for="question">Test Question2</label>
                <textarea  name="answer" rows="2"> 
                                  
                </textarea>             
              </li>
              <li>
                <label for="question">Option 1</label>
                <textarea  name="option1" rows="2"> 
               </textarea>             
              </li>
              <li>
                <label for="question">Option 2</label>
                <textarea  name="option2" rows="2"> 
               </textarea>             
              </li>
              <li>
                <label for="question">Option 3</label>
                <textarea  name="option3" rows="2"> 
               </textarea>             
              </li>
              <li>
                <label for="question">Option 4</label>
                <textarea  name="option4" rows="2"> 
               </textarea>             
              </li>
              <li>
                <label for="question">Answer for question 2</label>
                <select name="answer">
                <option name="" value="option1">Option 1</option>
                <option name="" value="option2">Option 2</option>
                <option name="" value="option3" >Option 3</option>
                <option name="" value="option4">Option 4</option>
                </select>             
              </li>
              <li>
                <label for="question">Test Question3</label>
                <textarea  name="answer" rows="2"> 
                                  
                </textarea>             
              </li>
              <li>
                <label for="question">Option 1</label>
                <textarea  name="option1" rows="2"> 
               </textarea>             
              </li>
              <li>
                <label for="question">Option 2</label>
                <textarea  name="option2" rows="2"> 
               </textarea>             
              </li>
              <li>
                <label for="question">Option 3</label>
                <textarea  name="option3" rows="2"> 
               </textarea>             
              </li>
              <li>
                <label for="question">Option 4</label>
                <textarea  name="option4" rows="2"> 
               </textarea>             
              </li>
              <li>
                <label for="question">Answer for question 3</label>
                <select name="answer">
                <option name="" value="option1">Option 1</option>
                <option name="" value="option2">Option 2</option>
                <option name="" value="option3" >Option 3</option>
                <option name="" value="option4">Option 4</option>
                </select>             
              </li>
              <li>
                <input type="button" name="register" id="button" value="Submit" onclick="doSubmit('reg');" class="send" />
              </li>
            </ol><br/>
            
            
            </fieldset>
            <input type="hidden" name="registered" value="yes" />
          </form>
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
