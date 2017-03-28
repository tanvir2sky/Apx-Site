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
            <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>add-branch-action" name="basic_validate" id="basic_validate" novalidate="novalidate">
            <div class="control-group">
                <label class="control-label">Branch Code</label>
                <div class="controls">
                  <input type="text" name="code" value="<?php echo set_value('code'); ?>" required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Branch Name</label>
                <div class="controls">
                  <input type="text" name="name" value="<?php echo set_value('name'); ?>" required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Manager Name</label>
                <div class="controls">
                  <input type="text" name="mname" value="<?php echo set_value('mname'); ?>" required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Branch Contact 1</label>
                <div class="controls">
                  <input type="text" name="bphone1" value="<?php echo set_value('bphone1'); ?>" required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Branch Contact 2</label>
                <div class="controls">
                  <input type="text" name="bphone2" value="<?php echo set_value('bphone2'); ?>">
                </div>
              </div>
             <div class="control-group">
                <label class="control-label">Branch Contact 3</label>
                <div class="controls">
                  <input type="text" name="bphone3" value="<?php echo set_value('bphone3'); ?>">
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">Manager Contact</label>
                <div class="controls">
                  <input type="text" name="mphone" value="<?php echo set_value('mphone'); ?>">
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
              <div class="form-actions">
                <input type="submit" name="add" value="Save" class="btn btn-success pull-right">
                <button class="btn btn-info pull-right" onclick="history.go(-1);" type="button" style="margin-right:5px;">Go Back</button>
            
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--end-main-container-part-->