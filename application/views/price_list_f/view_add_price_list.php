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
            <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>add-pricelist-action-f" name="basic_validate" id="basic_validate" novalidate="novalidate">
              <div class="control-group">
                <label class="control-label">Price List Name</label>
                <div class="controls">
                  <input type="text" class="span8" name="list_name" value="<?php echo set_value('list_name'); ?>" >
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">Price List Code</label>
                <div class="controls">
                  <input type="text" class="span8" name="list_code" value="<?php echo set_value('list_code'); ?>" >
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Type</label>
                <div class="controls" class="span8">
                  <select name="type" class="span8">
                    <option value="N-DOX" >NON DOCUMENT</option>
                    <option value="Dox">DOCUMENT</option>
                  </select>

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