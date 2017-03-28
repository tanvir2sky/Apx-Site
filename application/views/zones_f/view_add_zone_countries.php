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
            <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>add-zone-countries-action-f" name="basic_validate" id="basic_validate" novalidate="novalidate">
              <div class="control-group">
                <label class="control-label">Select Countries</label>
                <div class="controls">
                  <select multiple="yes" name="countries[]">
                  <?php 
                    if(isset($country) && $country!=""){
                      foreach ($country as $key => $value) {
                        echo '<option value="'.$value['countryCode'].'">'.$value['countryName'].'</option>';
                        }
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-actions">
               <input type="hidden" name="znid" value="<?php if(isset($_POST['add'])){ echo set_value('znid');}else{ echo $zone;} ?>">
                <input type="submit" name="add" value="Save" class="btn btn-success pull-right">
                <span class="pull-right"><a href="<?php echo base_url(); ?>zone-countries-f/<?php echo $zone; ?>">
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