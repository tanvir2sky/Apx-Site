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
            }else if(isset($edit_view) && $edit_view!=""){?>
           <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>add-customer-action" name="basic_validate" id="basic_validate" novalidate="novalidate">
             <div class="row-fluid">
              <div class="span12">
              <div class="control-group alert-info">
              <h5>&nbsp;Basic Info</h5>
              </div>
               <div class="control-group">
                <label class="control-label">Account Number</label>
                <div class="controls">
                  <input type="text" name="acnumber" value="<?php if(isset($_POST['update'])){ echo set_value('acnumber');}else{ echo $edit_view->accountNumber;} ?>" required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Account Type</label>
                <div class="controls">
                <select name="actype" class="span4">
                  <option <?php if(isset($_POST['update'])){ echo  set_select('actype','cash', TRUE); }else { if($edit_view->accountType=='Cash'){echo 'selected="selected"';}}?> value="Cash">Cash</option>
                  <option <?php if(isset($_POST['update'])){ echo  set_select('actype','Credit', TRUE); }else { if($edit_view->accountType=='Credit'){echo 'selected="selected"';}}?> value="Credit">Credit</option>
                </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Company Name</label>
                <div class="controls">
                  <input type="text" name="company" value="<?php if(isset($_POST['update'])){ echo set_value('company');}else{ echo $edit_view->companyName;} ?>" required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">First Name</label>
                <div class="controls">
                  <input type="text" name="fname" value="<?php if(isset($_POST['update'])){ echo set_value('fname');}else{ echo $edit_view->firstName;} ?>" required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Last Name</label>
                <div class="controls">
                  <input type="text" name="lname" value="<?php if(isset($_POST['update'])){ echo set_value('lname');}else{ echo $edit_view->lastName;} ?>" required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">User Name</label>
                <div class="controls">
                  <input type="text" name="uname" value="<?php if(isset($_POST['update'])){ echo set_value('uname');}else{ echo $edit_view->user_name;} ?>" required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Email</label>
                <div class="controls">
                  <input type="text" name="email1" value="<?php if(isset($_POST['update'])){ echo set_value('email1');}else{ echo $edit_view->email;} ?>" required>
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
                  <input type="text" name="phone" value="<?php if(isset($_POST['update'])){ echo set_value('phone');}else{ echo $edit_view->phone;} ?>">
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">Alternate Email</label>
                <div class="controls">
                  <input type="text" name="email2" value="<?php if(isset($_POST['update'])){ echo set_value('email2');}else{ echo $edit_view->email2;} ?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Mobile Number 1</label>
                <div class="controls">
                  <input type="text" name="mobile1" value="<?php if(isset($_POST['update'])){ echo set_value('mobile1');}else{ echo $edit_view->mobileNumber1;} ?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Mobile Number 2</label>
                <div class="controls">
                  <input type="text" name="mobile2" value="<?php if(isset($_POST['update'])){ echo set_value('mobile2');}else{ echo $edit_view->mobileNumber2;} ?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Address Line 1</label>
                <div class="controls">
                  <input type="text" name="address1" value="<?php if(isset($_POST['update'])){ echo set_value('address1');}else{ echo $edit_view->addressLine1;} ?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Address Line 2</label>
                <div class="controls">
                  <input type="text" name="address2" value="<?php if(isset($_POST['update'])){ echo set_value('address2');}else{ echo $edit_view->addressLine2;} ?>">
                </div>
              </div>
              </div>
              <div class="span5">
              <div class="control-group">
                <label class="control-label">Contact Person</label>
                <div class="controls">
                  <input type="text" name="cperson" value="<?php if(isset($_POST['update'])){ echo set_value('cperson');}else{ echo $edit_view->contactPerson;} ?>">
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">Branch Name</label>
                <div class="controls">
                  <select name="bname">
                    <?php if(isset($branch)){foreach ($branch as $key => $value) {?>
                    <option <?php if(isset($_POST['update'])){ echo  set_select('bname',$value->branch_id, TRUE); }else { if($value->branch_id==$edit_view->branch_id){echo 'selected="selected"';}}?> value="<?php echo $value->branch_id; ?>"><?php echo $value->name; ?></option>
                    <?php }} ?>
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Country</label>
                <div class="controls">
                  <select name="country">
                    <?php if(isset($country)){foreach ($country as $key => $value) {?>
                    <option <?php if(isset($_POST['update'])){ echo  set_select('country',$value->countryCode, TRUE); }else { if($value->countryCode==$edit_view->countryCode){echo 'selected="selected"';}}?> value="<?php echo $value->countryCode; ?>"><?php echo $value->countryName; ?></option>
                    <?php }} ?>
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">State / Province</label>
                <div class="controls">
                  <input type="text" name="state" value="<?php if(isset($_POST['update'])){ echo set_value('state');}else{ echo $edit_view->state;} ?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">City</label>
                <div class="controls">
                  <input type="text" name="city" value="<?php if(isset($_POST['update'])){ echo set_value('city');}else{ echo $edit_view->city;} ?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Zip Code</label>
                <div class="controls">
                  <input type="text" name="zipcode" value="<?php if(isset($_POST['update'])){ echo set_value('zipcode');}else{ echo $edit_view->zipCode;} ?>">
                </div>
              </div>
            </div>
          </div>
          <div class="row-fluid">
            <div class="span12">
             <div class="form-actions">
             <input type="hidden" name="cid" value="<?php if(isset($_POST['update'])){ echo set_value('cid');}else{ echo $edit_view->customer_id;} ?>">
              <input type="submit" name="update" value="Update" class="btn btn-success pull-right">
              <button class="btn btn-info pull-right" onclick="history.go(-1);" type="button" style="margin-right:5px;">Go Back</button>
              </div>
          </div>
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