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
            <button class="btn btn-info pull-right" onclick="history.go(-1);" type="button" style="margin:5px;"><i class="icon-download-alt"></i> Excel</button>
            <span class="pull-right"><a href="<?php echo base_url(); ?>new-shipment"><button class="btn btn-primary" style="margin:5px;">Add New</button></a></span>
          </div>
          <div class="widget-content nopadding">
            <table  class="table table-bordered data-table with-check">
              <thead>
                <tr>
                 <th><input type="checkbox" id="title-table-checkbox" name="title-table-checkbox" /></th>
                  <th>Sr. no</th>
                  <th>Air Way Bill #</th>
                  <th>Account Number</th>
                  <th>Shipper Company</th>
                  <th>Receiver Company</th>
                  <th>Service</th>
                  <th>Balance</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              if(isset($shipment_data) && !empty($shipment_data)){ 
                $count=1;
                foreach ($shipment_data as $key => $value) {
                  switch($value['status']){
                    case 'Intransit':
                        $status='In transit';
                        $statusclass='warning';
                        $action="Mark Delivered";
                        break;
                    case 'Delivered':
                        $status='Delivered';
                        $statusclass='success';
                        $action="Mark Billed";
                        break;
                    case 'Billed':
                        $status='Billed';
                        $statusclass='success';
                        $action="Mark UnBilled";
                        break;
                    case 'UnBilled':
                        $status='Un Billed';
                        $statusclass='warning';
                        $action="Mark Billed";
                        break;
                    case 'Partial':
                        $status='Partial';
                        $statusclass='info';
                        $action="Mark Intransit";
                        break;
                    default:
                        $status='Problem';
                        $statusclass='danger';
                        $action="Mark Intransit";
                        break;
                    }

                ?>
                <tr class="gradeX">
                 <td><input type="checkbox" /></td>
                  <td><?php  echo $count++; ?></td>
                  <td><?php  echo $value['air_way_number']; ?></td>
                  <td><?php  echo $value['accountNumber']; ?></td>
                  <td><?php  echo $value['companyName']; ?></td>
                  <td><?php  echo $value['receiverCompany']; ?></td>
                  <td><?php  echo $value['listName']; ?></td>
                  <td><?php  echo $value['shipBalance']; ?></td>
                  <td><?php if($status!='Error'){ ?><a title="<?php echo $action; ?>" href="javascript:confirmDelete('<?php echo base_url(); ?>change-shipment-status/<?php echo $value['ship_id']; ?>','<?php echo $action; ?>')"><?php echo '<span class="label label-sm label-'.$statusclass.'">'.$status.'</span>'; ?></a><?php }else{ echo '<span class="label label-sm label-'.$statusclass.'">'.$status.'</span>'; }?></td>
                  <td class="center"><a title="Edit" href="<?php echo base_url(); ?>edit-shipment/<?php echo $value['ship_id']; ?>"><i class="icon-edit"></i> Edit</a>&nbsp;&nbsp;<a title="Trash" href="javascript:confirmDelete('<?php echo base_url(); ?>trash-shipment/<?php echo 
                  $value['ship_id']; ?>','Trash')"><i class="icon-trash"></i> Trash</a>&nbsp;&nbsp;
                  <a href="<?php echo base_url(); ?>show-shipment/<?php echo $value['ship_id']; ?>" title="Detail"><i class="icon-eye-open"></i> Detail</a>
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