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
            <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>app-user-action" name="basic_validate" id="basic_validate" novalidate="novalidate">
              <div class="control-group">
                <label class="control-label">First Name</label>
                <div class="controls">
                  <input type="text" name="fname" value="<?php echo set_value('fname'); ?>" required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Last Name</label>
                <div class="controls">
                  <input type="text" name="lname" value="<?php echo set_value('lname'); ?>" required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">User Name</label>
                <div class="controls">
                  <input type="text" name="uname" value="<?php echo set_value('uname'); ?>" required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Email</label>
                <div class="controls">
                  <input type="text" name="email" value="<?php echo set_value('email'); ?>" required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Phone</label>
                <div class="controls">
                  <input type="text" name="phone" value="<?php echo set_value('phone'); ?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Password</label>
                <div class="controls">
                  <input type="password" name="pass" id="pwd" required>
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
                    <option <?php echo  set_select('level',$value->r_id, TRUE); ?> value="<?php echo $value->r_id; ?>"><?php echo $value->r_name; ?></option>
                   <?php }} ?>
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Detail</label>
                <div class="controls">
                  <textarea class="span11" name="summery"><?php echo set_value('summery'); ?></textarea>
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" name="add" value="Save" class="btn btn-success pull-right">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--end-main-container-part-->