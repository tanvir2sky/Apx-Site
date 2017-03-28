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
           <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>add-customer-action" name="basic_validate" id="basic_validate" novalidate="novalidate">
             <div class="row-fluid">
              <div class="span12">
              <div class="control-group alert-info">
              <h5>&nbsp;Basic Info</h5>
              </div>
               <div class="control-group">
                <label class="control-label">Account Number</label>
                <div class="controls">
                  <input type="text" name="acnumber" value="<?php echo set_value('acnumber'); ?>" required>
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">Account Type</label>
                <div class="controls">
                <select name="actype" class="span4">
                  <option <?php if(isset($_POST['add'])){ echo  set_select('actype','cash', TRUE); }?> value="Cash">Cash</option>
                  <option <?php if(isset($_POST['add'])){ echo  set_select('actype','Credit', TRUE); }?> value="Credit">Credit</option>
                </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Company Name</label>
                <div class="controls">
                  <input type="text" name="company" value="<?php echo set_value('company'); ?>" required>
                </div>
              </div>
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
                  <input type="text" name="email1" value="<?php echo set_value('email1'); ?>" required>
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
               <div class="control-group alert-info">
              <h5>&nbsp;Detail Info</h5>
              </div>
            </div>
            </div>
            <div class="row-fluid">
            <div class="span5">
             <div class="control-group">
                <label class="control-label">Phone</label>
                <div class="controls">
                  <input type="text" name="phone" value="<?php echo set_value('phone'); ?>">
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">Alternate Email</label>
                <div class="controls">
                  <input type="text" name="email2" value="<?php echo set_value('email2'); ?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Mobile Number 1</label>
                <div class="controls">
                  <input type="text" name="mobile1" value="<?php echo set_value('mobile1'); ?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Mobile Number 2</label>
                <div class="controls">
                  <input type="text" name="mobile2" value="<?php echo set_value('mobile2'); ?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Address Line 1</label>
                <div class="controls">
                  <input type="text" name="address1" value="<?php echo set_value('address1'); ?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Address Line 2</label>
                <div class="controls">
                  <input type="text" name="address2" value="<?php echo set_value('address2'); ?>">
                </div>
              </div>
              </div>
              <div class="span5">
              <div class="control-group">
                <label class="control-label">Contact Person</label>
                <div class="controls">
                  <input type="text" name="cperson" value="<?php echo set_value('cperson'); ?>">
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">Branch Name</label>
                <div class="controls">
                  <select name="bname">
                    <?php if(isset($branch)){foreach ($branch as $key => $value) {?>
                    <option <?php if(isset($_POST['add'])){ echo  set_select('bname',$value->branch_id, TRUE); }else { if($value->branch_id==1){echo 'selected="selected"';}}?> value="<?php echo $value->branch_id; ?>"><?php echo $value->name; ?></option>
                    <?php }} ?>
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Country</label>
                <div class="controls">
                  <select name="country">
                    <?php if(isset($country)){foreach ($country as $key => $value) {?>
                    <option <?php if(isset($_POST['add'])){ echo  set_select('country',$value->countryCode, TRUE); }else { if($value->countryCode=='GB'){echo 'selected="selected"';}}?> value="<?php echo $value->countryCode; ?>"><?php echo $value->countryName; ?></option>
                    <?php }} ?>
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">State / Province</label>
                <div class="controls">
                  <input type="text" name="state" value="<?php echo set_value('state'); ?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">City</label>
                <div class="controls">
                  <input type="text" name="city" value="<?php echo set_value('city'); ?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Zip Code</label>
                <div class="controls">
                  <input type="text" name="zipcode" value="<?php echo set_value('zipcode'); ?>">
                </div>
              </div>
            </div>
          </div>
          <div class="row-fluid">
            <div class="span12">
             <div class="form-actions">
              <input type="submit" name="add" value="Save" class="btn btn-success pull-right">
              <button class="btn btn-info pull-right" onclick="history.go(-1);" type="button" style="margin-right:5px;">Go Back</button>
              </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
</div>
</div>
<!--end-main-container-part-->