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
      <?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message');} ?>
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5><?php if(isset($title)){echo $title;} ?></h5>
            <span class="pull-right"><a href="<?php echo base_url(); ?>add-country"><button class="btn btn-primary" style="margin:5px;">Add New</button></a></span>
          </div>
          <div class="widget-content nopadding">
            <table  class="table table-bordered data-table with-check">
              <thead>
                <tr>
                 <th><input type="checkbox" id="title-table-checkbox" name="title-table-checkbox" /></th>
                  <th>Sr. no</th>
                  <th>Country Name</th>
                  <th>Country Code</th>
                   <th>Continent Name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              if(isset($countries_data) && !empty($countries_data)){ 
                $count=1;
                foreach ($countries_data as $key => $value) {
                ?>
                <tr class="gradeX">
                 <td><input type="checkbox" /></td>
                  <td><?php  echo $count++; ?></td>
                  <td><?php  echo $value['countryName']; ?></td>
                  <td><?php  echo $value['countryCode']; ?></td>
                  <td><?php  echo $value['continentName']; ?></td>
                  <td class="center">
                  <?php if($value['lock']==1){ echo '<label class="badge badge-warning"><i class="icon-lock"></i> Locked</label>';}else{?>
                  <a title="Edit" href="<?php echo base_url(); ?>edit-country/<?php echo $value['country_id']; ?>"><i class="icon-edit"></i> Edit</a>&nbsp;&nbsp;<a title="Trash" href="javascript:confirmDelete('<?php echo base_url(); ?>delete-country/<?php echo $value['country_id']; ?>','Delete')"><i class="icon-trash"></i> Delete</a>
                  <?php } ?>
                  </td>
                </tr>
                <?php }}?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--end-main-container-part-->