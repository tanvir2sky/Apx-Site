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
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table with-check">
              <thead>
                <tr>
                 <th><input type="checkbox" id="title-table-checkbox" name="title-table-checkbox" /></th>
                  <th>Sr. no</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>User Name</th>
                  <th>Email</th>
                  <th>User Type</th>
                  <?php 
                  if(access_control_apx('users_manage','Status')==true){
                  ?>
                  <th>Status</th>
                  <?php }if(access_control_apx('users_manage','Delete')==true){ ?>
                  <th>Action</th>
                  <?php }?>
                </tr>
              </thead>
              <tbody>
              <?php 
              if(isset($trashed_admins_data) && !empty($trashed_admins_data)){ 
                $count=1;
                foreach ($trashed_admins_data as $key => $value) {
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
                  <td><?php  echo $value['first_name']; ?></td>
                  <td><?php  echo $value['last_name']; ?></td>
                  <td><?php  echo $value['user_name']; ?></td>
                  <td><?php  echo $value['email']; ?></td>
                  <td><?php  echo $value['role']; ?></td>
                  <?php 
                  if(access_control_apx('users_manage','Status')==true){
                  ?>
                  <td><?php if($status!='Error'){ ?><a title="<?php echo $action; ?>" href="javascript:confirmDelete('<?php echo base_url(); ?>change-status/<?php echo $value['id']; ?>','<?php echo $action; ?>')"><?php echo '<span class="label label-sm label-'.$statusclass.'">'.$status.'</span>'; ?></a><?php }else{ echo '<span class="label label-sm label-'.$statusclass.'">'.$status.'</span>'; }?></td>
                  <?php }if(access_control_apx('users_manage','Delete')==true){ ?>
                  <td class="center"><a title="Delete" href="javascript:confirmDelete('<?php echo base_url(); ?>delete-app-user/<?php echo $value['id']; ?>','Delete Parmanently')"><i class="icon-trash"></i> Delete</a>
                  </td>
                  <?php } ?>
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