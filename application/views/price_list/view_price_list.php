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
            <span class="pull-right"><a href="<?php echo base_url(); ?>add-pricelist"><button class="btn btn-primary" style="margin:5px;">Add New</button></a></span>
            <span class="pull-right"><a href="<?php echo base_url(); ?>upload-wp-csv">
            <button type="button" class="btn btn-info pull-right" style="margin:5px;">
            <i class="icon-upload-alt"></i> Rates Upload</button></a></span>
          </div>
          <div class="widget-content nopadding">
            <table  class="table table-bordered data-table with-check">
              <thead>
                <tr>
                 <th><input type="checkbox" id="title-table-checkbox" name="title-table-checkbox" /></th>
                  <th>Sr. no</th>
                  <th>Price List Name</th>
                  <th>Price List Code</th>
                   <th>Zone</th>
                  <th>Created By</th>
                  <th>Created Date</th>
                  <th>Modified By</th>
                  <th>Modified Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              if(isset($price_list_data) && !empty($price_list_data)){ 
                $count=1;
                foreach ($price_list_data as $key => $value) {
                  switch($value['status']){
                    case -1:
                        $status='Trashed';
                        $statusclass='danger';
                        $action='Restore';
                        break;
                    case 0:
                        $status='De-active';
                        $statusclass='warning';
                        $action='Enable';
                        break;
                    case 1:
                        $status='Active';
                        $statusclass='success';
                        $action='Block';
                        break;
                    case 2:
                        $status='Blocked';
                        $statusclass='danger';
                        $action='Activate';
                        break;
                    default:
                        $status='Error';
                        $statusclass='warning';
                        $action='Error';
                        break;
                    }

                ?>
                <tr class="gradeX">
                 <td><input type="checkbox" /></td>
                  <td><?php  echo $count++; ?></td>
                  <td><?php  echo $value['listName']; ?></td>
                  <td><?php  echo $value['listCode']; ?></td>
                  <td><a href="<?php echo base_url(); ?>list-zones/<?php echo $value['list_id']; ?>"><span class="label label-sm label-success">Total Zone (<?php  echo $value['total_zone']; ?>)</span></a></td>
                  <td><?php  echo $value['created_name']; ?></td>
                  <td><?php  echo $value['created_date']; ?></td>
                  <td><?php  echo $value['modified_name']; ?></td>
                  <td><?php  echo ($value['modified_date']!='0000-00-00 00:00:00'?$value['modified_date']:""); ?></td>
                   <td><?php if($status!='Error'){ ?><a title="<?php echo $action; ?>" href="javascript:confirmDelete('<?php echo base_url(); ?>change-pricelist-status/<?php echo $value['list_id']; ?>','<?php echo $action; ?>')"><?php echo '<span class="label label-sm label-'.$statusclass.'">'.$status.'</span>'; ?></a><?php }else{ echo '<span class="label label-sm label-'.$statusclass.'">'.$status.'</span>'; }?></td>
                  <td class="center"><a title="Edit" href="<?php echo base_url(); ?>edit-pricelist/<?php echo $value['list_id']; ?>"><i class="icon-edit"></i> Edit</a>&nbsp;&nbsp;<a title="Trash" href="javascript:confirmDelete('<?php echo base_url(); ?>delete-pricelist/<?php echo $value['list_id']; ?>','Delete')"><i class="icon-trash"></i> Delete</a>
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