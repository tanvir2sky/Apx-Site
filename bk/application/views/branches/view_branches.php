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
            <span class="pull-right"><a href="<?php echo base_url(); ?>add-branch"><button class="btn btn-primary" style="margin:5px;">Add New</button></a></span>
          </div>
          <div class="widget-content nopadding">
            <table  class="table table-bordered data-table with-check">
              <thead>
                <tr>
                 <th><input type="checkbox" id="title-table-checkbox" name="title-table-checkbox" /></th>
                  <th>Sr. no</th>
                  <th>Branch Code</th>
                  <th>Branch Name</th>
                  <th>Manager Name</th>
                  <th>Contact #</th>
                  <th>Branch Country</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              if(isset($branches_data) && !empty($branches_data)){ 
                $count=1;
                foreach ($branches_data as $key => $value) {
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
                  <td><?php  echo $value['code']; ?></td>
                  <td><?php  echo $value['name']; ?></td>
                  <td><?php  echo $value['manager']; ?></td>
                  <td><?php  echo $value['contactNu1']; ?></td>
                  <td><?php  echo $value['country']; ?></td>
                  <td><?php if($status!='Error'){ ?><a title="<?php echo $action; ?>" href="javascript:confirmDelete('<?php echo base_url(); ?>change-branch-status/<?php echo $value['branch_id']; ?>','<?php echo $action; ?>')"><?php echo '<span class="label label-sm label-'.$statusclass.'">'.$status.'</span>'; ?></a><?php }else{ echo '<span class="label label-sm label-'.$statusclass.'">'.$status.'</span>'; }?></td>
                  <td class="center"><a title="Edit" href="<?php echo base_url(); ?>edit-branch/<?php echo $value['branch_id']; ?>"><i class="icon-edit"></i> Edit</a>&nbsp;&nbsp;<a title="Trash" href="javascript:confirmDelete('<?php echo base_url(); ?>trash-branch/<?php echo $value['branch_id']; ?>','Trash')"><i class="icon-trash"></i> Trash</a>&nbsp;&nbsp;
                  <a href="<?php echo base_url(); ?>branch-detail/<?php echo $value['branch_id']; ?>" title="Detail"><i class="icon-eye-open"></i> Detail</a>
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