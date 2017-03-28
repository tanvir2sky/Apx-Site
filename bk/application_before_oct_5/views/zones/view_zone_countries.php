<!--main-container-part-->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url(); ?>dashboard" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="javascript:void(0)" class="current"><?php if(isset($breadcromb)){echo $breadcromb;} ?></a> </div>
    <h1><?php if(isset($header)){echo $header;} ?></h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
      <?php 
      if($this->session->flashdata('message')){ echo $this->session->flashdata('message');} 
      if(is_array(validation_errors_array())){
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>".current(validation_errors_array())."</div>";
              }
        ?>
        <div class="widget-box">
         <form method="post" action="<?php echo base_url(); ?>delete-zone-countries">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5><?php if(isset($title)){echo $title;} ?></h5>
            <span class="pull-right"><a href="<?php echo base_url(); ?>list-zones/<?php if(isset($list_id) && $list_id!=""){echo $list_id;} ?>">
            <button type="button" class="btn btn-info pull-right" style="margin:5px;">Go Back</button></a></span>
            <span class="pull-right"><a href="<?php echo base_url(); ?>add-zone-countries/<?php if(isset($zone)){ echo $zone;}else{ echo $this->uri->segment(2);} ?>"><button type="button" class="btn btn-primary" style="margin:5px;">Add New</button></a></span>
             <button type="submit" onclick="return confirm('Are you sure to Delete?')" class="btn btn-danger pull-right" style="margin:5px;">Delete Selected</button>
          </div>
          <div class="widget-content nopadding">
            <table  class="table table-bordered data-table with-check">
              <thead>
                <tr>
                 <th><input type="checkbox" id="title-table-checkbox" name="title-table-checkbox"/></th>
                  <th>Sr. no</th>
                  <th>Country</th>
                  <th>Country Code</th>
                  <th>Created By</th>
                  <th>Created Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              if(isset($zone_countries_data) && !empty($zone_countries_data)){ 
                $count=1;
                foreach ($zone_countries_data as $key => $value) {
                ?>
                <tr class="gradeX">
                 <td><input type="checkbox" name="zones[]" value="<?php echo $value['zc_id'] ?>" /></td>
                  <td><?php  echo $count++; ?></td>
                  <td><?php  echo $value['countryName']; ?></td>
                  <td><?php  echo $value['countryCode']; ?></td>
                  <td><?php  echo $value['created_name']; ?></td>
                  <td><?php  echo $value['created_date']; ?></td>
                  <td class="center"><a title="Trash" href="javascript:confirmDelete('<?php echo base_url(); ?>delete-zone-country/<?php echo $value['zc_id']; ?>','Delete')"><i class="icon-trash"></i> Delete</a>
                  </td>
                </tr>
                <?php }}?>
              </tbody>
            </table>
          </div>
          <input type="hidden" name="znid" value="<?php if(isset($zone)){ echo $zone;} ?>">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!--end-main-container-part-->