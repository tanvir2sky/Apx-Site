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
            <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>add-zone-action" name="basic_validate" id="basic_validate" novalidate="novalidate">
              <div class="control-group">
                <label class="control-label">Price List</label>
                <div class="controls">
                  <select name="list_name" class="span8">
                    <?php if(isset($price_list)){foreach ($price_list as $key => $value) {?>
                    <option <?php if(isset($_POST['add'])){ echo  set_select('list_name',$value->list_id, TRUE);}?> value="<?php echo $value->list_id; ?>"><?php echo $value->listName; ?></option>
                    <?php }} ?>
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Zone Name</label>
                <div class="controls">
                  <input type="text" class="span8" name="zone" value="<?php echo set_value('zone'); ?>" >
                </div>
              </div>
              <div class="form-actions">
               <input type="hidden" name="plid" value="<?php if(isset($_POST['add'])){ echo set_value('plid');}else{ echo $list_id;} ?>">
                <input type="submit" name="add" value="Save" class="btn btn-success pull-right">
                 <span class="pull-right"><a href="<?php echo base_url(); ?>list-zones/<?php if(isset($list_id) && $list_id!=""){echo $list_id;} ?>">
            <button type="button" class="btn btn-info pull-right" style="margin-right:5px;">Go Back</button></a></span>
            
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--end-main-container-part-->