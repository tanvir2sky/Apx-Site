<!DOCTYPE html>
<html lang="en">
<head>
<title>APX | Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?php echo base_url(); ?>uisrc/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>uisrc/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>uisrc/css/fullcalendar.css" />
<?php if($this->uri->segment(1)!='dashboard'){ ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>uisrc/css/uniform.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>uisrc/css/select2.css" />
<?php }?>
<link rel="stylesheet" href="<?php echo base_url(); ?>uisrc/css/datepicker.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>uisrc/css/matrix-style.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>uisrc/css/matrix-media.css" />
<link href="<?php echo base_url(); ?>uisrc/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url(); ?>uisrc/css/jquery.gritter.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo base_url(); ?>uisrc/datetimepicker/stylesheets/wickedpicker.css" />
<script type="text/javascript">
var base_url='<?php echo base_url(); ?>';
function confirmDelete(delUrl,value) {
  if (confirm("Are you sure to "+value+"?")) {
    document.location = delUrl;
  }
}
</script>
</head>
<body>
<!--Header-part-->
<div id="header">
    <div class="span2">
      <!-- <img src="<?php //echo base_url(); ?>uisrc/img/logo.gif" alt="Logo"  width="100" height="24"/> -->
    </div>
</div>
<!--close-Header-part--> 
<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li class="dropdown" id="menu-messages"><a href="#" data-toggle="dropdown" data-target="#menu-messages" class="dropdown-toggle"><i class="icon icon-envelope"></i> <span class="text">Messages</span> <span class="label label-important">5</span> <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a class="sAdd" title="" href="#"><i class="icon-plus"></i> new message</a></li>
        <li class="divider"></li>
        <li><a class="sInbox" title="" href="#"><i class="icon-envelope"></i> inbox</a></li>
        <li class="divider"></li>
        <li><a class="sOutbox" title="" href="#"><i class="icon-arrow-up"></i> outbox</a></li>
        <li class="divider"></li>
        <li><a class="sTrash" title="" href="#"><i class="icon-trash"></i> trash</a></li>
      </ul>
    </li>
    <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text">Welcome User</span><b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="my-profile.php"><i class="icon-user"></i> My Profile</a></li>
        <li class="divider"></li>
        <li><a href="#"><i class="icon-check"></i> My Tasks</a></li>
         <li class="divider"></li>
        <li><a href="login.php"><i class="icon icon-cog"></i>Settings</a></li>
        <li class="divider"></li>
        <li><a href="<?php echo base_url(); ?>logout"><i class="icon icon-share-alt"></i> Log Out</a></li>
      </ul>
    </li>
  </ul>
</div>
<!--close-top-Header-menu-->
<!--sidebar-menu-->
<?php $this->load->view('common_pages/sidebar'); ?>
<!--sidebar-menu-->