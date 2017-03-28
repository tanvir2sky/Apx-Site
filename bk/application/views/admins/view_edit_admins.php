<!--main-container-part-->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url(); ?>dashboard" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="javascript:void(0)" class="current"><?php if(isset($breadcromb)){echo $breadcromb;} ?></a> </div>
    <h1><?php if(isset($header)){echo $header;} ?></h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
      <?php 
          if(is_array(validation_errors_array())){
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>".current(validation_errors_array())."</div>";
              }
            ?>
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5><?php if(isset($title)){echo $title;} ?></h5>
          </div>
          <div class="widget-content nopadding">
          <?php if(isset($no_data)){
            echo'<div class="widget-content">'.$no_data.'</div>';
            }else if(isset($user_view) && $user_view!=""){?>
            <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>app-user-action" name="basic_validate" id="basic_validate" novalidate="novalidate">
              <div class="control-group">
                <label class="control-label">First Name</label>
                <div class="controls">
                  <input type="text" name="fname" value="<?php if(isset($_POST['update'])){ echo set_value('fname');}else{ echo $user_view->first_name;} ?>" required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Last Name</label>
                <div class="controls">
                  <input type="text" name="lname" value="<?php  if(isset($_POST['update'])){ echo set_value('lname');}else{ echo $user_view->last_name;} ?>" required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">User Name</label>
                <div class="controls">
                  <input type="text" name="uname" value="<?php if(isset($_POST['update'])){ echo set_value('uname');}else{ echo $user_view->user_name;} ?>" required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Email</label>
                <div class="controls">
                  <input type="text" name="email" value="<?php if(isset($_POST['update'])){ echo set_value('email');}else{ echo $user_view->email;} ?>" required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Phone</label>
                <div class="controls">
                  <input type="text" name="phone" value="<?php if(isset($_POST['update'])){ echo set_value('phone');}else{ echo $user_view->phone;} ?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Password</label>
                <div class="controls">
                  <input type="password" name="pass" id="pwd">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Confirm password</label>
                <div class="controls">
                  <input type="password" name="repass" id="pwd2" />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Select input</label>
                <div class="controls">
                  <select name="level">
                    <?php if(isset($levels)){foreach ($levels as $key => $value) {?>
                    <option <?php if(isset($_POST['update'])){ echo  set_select('level',$value->r_id, TRUE);}else{ if($user_view->role_id==$value->r_id){echo 'selected="selected"';}} ?> value="<?php echo $value->r_id; ?>"><?php echo $value->r_name; ?></option>
                   <?php }} ?>
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Detail</label>
                <div class="controls">
                  <textarea class="span11" name="summery"><?php if(isset($_POST['update'])){ echo set_value('summery');}else{ echo $user_view->detail;} ?></textarea>
                </div>
              </div>
              <div class="form-actions">
              <input type="hidden" name="uid" value="<?php if(isset($_POST['update'])){ echo set_value('uid');}else{ echo $user_view->id;} ?>">
                <input type="submit" name="update" value="Update" class="btn btn-success pull-right">
              </div>
            </form>
            <?php }?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--end-main-container-part-->