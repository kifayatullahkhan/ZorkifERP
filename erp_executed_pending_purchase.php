<?php require_once("include_code/PAGE_TOP_MOST_GLOBAL_INC.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="EN" lang="EN" dir="ltr"><!-- InstanceBegin template="/Templates/ZB1_DetailPageFullWidth.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head profile="http://gmpg.org/xfn/11">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Zorkif Business One | Zorkif ERP</title>
<!-- InstanceEndEditable -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="imagetoolbar" content="no" />
<link rel="stylesheet" href="styles/layout.css" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
    
    <!-- --------------------these lines for importing jcalander files-------------------------------------------- -->
	<script type="text/javascript" src="external_resources/j_calandar/javascript/calendar.js"></script>
    <script type="text/javascript" src="external_resources/j_calandar/javascript/calendar-setup.js"></script>
    <script type="text/javascript" src="external_resources/j_calandar/lang/calendar-en.js"></script>
    <style type="text/css"> @import url("external_resources/j_calandar/css/calendar-tas.css"); </style>
	<!----------------------------------------------------------------------------------------------------------- -->
    
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/my_custom_js.js"></script>
    
<script src="SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script>
<link href="SpryAssets/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css" />
<?php require_once "external_resources/tinymce/jscript_tnymce_head_section.php"; ?>
  <script src="external_resources/jquery-1.6.2.min.js"></script>
 
<!-- Fancy Box For Picture Galary View -->
<script type="text/javascript" src="external_resources/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="external_resources/fancybox/jquery.easing-1.4.pack.js"></script>
<script type="text/javascript" src="external_resources/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>

<link rel="stylesheet" href="external_resources/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />

</head>
<body id="top">
<div class="wrapper col1">
  <div id="header">
    <div id="logo">
      <h1><a href="#"><img src="images/zorkif_logo.jpg" width="300" height="140" alt="Zorkif Technology Center" longdesc="http://www.zorkif.com" /></a></h1>
      <p align="right"><strong>PEOPLE MAKING TECHNOLOGY WORK</strong></p>
    </div>
    <div id="newsletter">
      <p>Sign up to our newsletter for the latest news, updates and offers.</p>
      <form action="news_letter_add.php" method="post">
        <fieldset>
          <legend>NewsLetter</legend>
          <input name="FullName" type="text" id="FullName"  onfocus="this.value=(this.value=='Name&hellip;')? '' : this.value ;" value="Name&hellip;" />
          <input name="Email" type="text" id="Email"  onfocus="this.value=(this.value=='Email&hellip;')? '' : this.value ;" value="Email&hellip;" />
          <input type="submit" name="news_go" id="news_go" value="Sign Up" />
        </fieldset>
      </form>
    </div>
    <br class="clear" />
  </div>
</div>
<div class="wrapper DarkHeaderRow">
  <div id="topbar">
    <div id="topnav">
            <?php require_once("include_code/page_top_menu_bar.php"); ?>
    </div>
    <div id="search">
      <form action="" method="post">
        <fieldset>
          <legend>Site Search</legend>
          <input type="text" name="SearchText" value="Search Record&hellip;"  id="SearchText" onfocus="this.value=(this.value=='Search Record&hellip;')? '' : this.value ;" />
          <input type="submit" name="go" id="go" value="Search" />
        </fieldset>
      </form>
    </div>
    <br class="clear" />
  </div>
</div>
<div class="wrapper col3">
  <div id="breadcrumb"><!-- InstanceBeginEditable name="ER_ConentPageLocation" -->
    <ul>
      <li class="first">Quick Links</li>
      <li>&#187;</li>
      <li><a href="cpanel.php">Home</a></li>
      <li>&#187;</li>
      <li><a href="#">Grand Parent</a></li>
      <li>&#187;</li>
      <li><a href="#">Parent</a></li>
      <li>&#187;</li>
      <li class="current"><a href="#">Child</a></li>
    </ul>
  <!-- InstanceEndEditable --></div>
</div>
<div class="wrapper col5">
  <div id="container">
  <!-- InstanceBeginEditable name="ER_CONTENT1" -->
   
   
   
   
   <?php require_once('erp_include_code/erp_executed_pending_purchase.php'); ?>
   
<!-- InstanceEndEditable -->  </div></div>
<div class="wrapper col6">
  <div id="footer">
    <div id="login">
      <h2><strong>Welcome to Zorkif ERP</strong></h2>
      Thanks for choosing Zorkif Technology Center as your ERP Solution Company. You can get access to different online documentations and user manuals from our web site at: <a href="http://www.zorkif.com">www.zorkif.com</a></div>
    <div class="footbox">
      <h2>ERP Solutions</h2>
      <ul>
        <li><a href="http://www.zorkif.com/payroll_system.php">Payroll System</a></li>
        <li><a href="http://www.zorkif.com/attendance_system.php">Attendance System</a></li>
        <li><a href="http://www.zorkif.com/attendance_system_timex.php"> TimeX</a></li>
        <li><a href="http://www.zorkif.com/factory_production_unit.php">Factory Prodcution Unit</a></li>
        <li class="last"><a href="http://www.zorkif.com/enterprise_erp.php">Enterprise ERP</a></li>
      </ul>
    </div>
    <div class="footbox">
      <h2>Desktop Application</h2>
      <ul>
        <li><a href="http://www.zorkif.com/zelab_laboratory_mis.php">ZeLab - Labority MIS</a></li>
        <li><a href="http://www.zorkif.com/hospital_mis.php">Hospital MIS</a></li>
        <li><a href="http://www.zorkif.com/school_mis.php">School MIS</a></li>
        <li><a href="http://www.zorkif.com/university_mis.php">Univeristy MIS</a></li>
        <li class="last"><a href="http://www.zorkif.com/pharmacy_point_of_sale.php">Pharmacy POS</a></li>
      </ul>
    </div>
    <div class="footbox">
      <h2>Web Applications</h2>
      <ul>
        <li><a href="http://www.zorkif.com/zorkif_business_one.php">Zorkif Business One</a></li>
        <li><a href="http://www.zorkif.com/task_management_system.php">Task Management System</a></li>
        <li><a href="http://www.zorkif.com/reports_sharing.php">Report Sharing</a></li>
        <li><a href="http://www.zorkif.com/picture_gallery.php">Picture Gallery</a></li>
        <li class="last"><a href="http://www.zorkif.com/ticket_system.php">Ticket System</a></li>
      </ul>
    </div>
    <br class="clear" />
  </div>
</div>
<div class="wrapper col7">
  <div id="copyright">
    <p class="fl_left">Copyright &copy; 2011 - All Rights Reserved - zorkif.com</p>
    <p class="fl_right">Zorkif Technology Center</p>
    <br class="clear" />
  </div>
</div>
</body>
<!-- InstanceEnd --></html>
<?php

ob_end_flush();

?>