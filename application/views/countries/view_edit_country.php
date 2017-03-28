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
            <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>add-country-action" name="basic_validate" id="basic_validate" novalidate="novalidate">
               <div class="control-group">
                <label class="control-label">Country Name</label>
                <div class="controls">
                  <input type="text" class="span8" name="country_name" value="<?php if(isset($_POST['update'])){ echo set_value('country_name');}else{ echo $edit_view->countryName;} ?>" required>
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">Country Code</label>
                <div class="controls">
                  <input type="text" class="span8" name="country_code" value="<?php if(isset($_POST['update'])){ echo set_value('country_code');}else{ echo $edit_view->countryCode;} ?>" required>
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">Continent Name</label>
                <div class="controls">
                 <select name="continent_name" class="span8">
                     <option <?php if(isset($_POST['update'])){ echo  set_select('continent_name','Asia', TRUE); }else { if($edit_view->continentName=='Asia'){echo 'selected="selected"';}}?> value="Asia">Asia</option>

                     <option <?php if(isset($_POST['update'])){ echo  set_select('continent_name','Africa', TRUE); }else { if($edit_view->continentName=='Africa'){echo 'selected="selected"';}}?> value="Africa">Africa</option>

                     <option <?php if(isset($_POST['update'])){ echo  set_select('continent_name','Antarctica', TRUE); }else { if($edit_view->continentName=='Antarctica'){echo 'selected="selected"';}}?> value="Antarctica">Antarctica</option>

                     <option <?php if(isset($_POST['update'])){ echo  set_select('continent_name','Europe', TRUE); }else { if($edit_view->continentName=='Europe'){echo 'selected="selected"';}}?> value="Europe">Europe</option>

                     <option <?php if(isset($_POST['update'])){ echo  set_select('continent_name','North America', TRUE); }else { if($edit_view->continentName=='North America'){echo 'selected="selected"';}}?> value="North America">North America</option>

                     <option <?php if(isset($_POST['update'])){ echo  set_select('continent_name','Oceania', TRUE); }else { if($edit_view->continentName=='Oceania'){echo 'selected="selected"';}}?> value="Oceania">Oceania</option>

                     <option <?php if(isset($_POST['update'])){ echo  set_select('continent_name','South America', TRUE); }else { if($edit_view->continentName=='South America'){echo 'selected="selected"';}}?> value="South America">South America</option>
                  </select>
                </div>
              </div>
              <div class="form-actions">
              <input type="hidden" name="cid" value="<?php if(isset($_POST['update'])){ echo set_value('cid');}else{ echo $edit_view->country_id;} ?>">
                <input type="submit" name="update" value="Update" class="btn btn-success pull-right">
                <button class="btn btn-info pull-right" onclick="history.go(-1);" type="button" style="margin-right:5px;">Go Back</button>
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