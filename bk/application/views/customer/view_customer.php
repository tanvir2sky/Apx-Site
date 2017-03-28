main-container-part-->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url(); ?>dashboard" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="javascript:void(0)" class="current"><?php if(isset($breadcromb)){echo $breadcromb;} ?></a> </div>
    <h1><?php if(isset($header)){echo $header;} ?></h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5><?php if(isset($title)){echo $title;} ?></h5>
            <span class="pull-right">
                <button class="btn btn-info" onclick="history.go(-1);" type="button" style="margin:5px;">Go Back</button>
            </span>    
          </div>
          <?php if(isset($no_data)){
            echo'<div class="widget-content">'.$no_data.'</div>';
            }else if(isset($detail_view) && $detail_view!=""){
              switch($detail_view->status){
                    case -1:
                        $Status='Trashed';
                        $class="badge badge-warning";
                        break;
                    case 0:
                        $Status='De-active';
                        $class="badge badge-info";
                        break;
                    case 1:
                        $Status='Active';
                        $class="badge badge-success";
                        break;
                    case 2:
                        $Status='Blocked';
                        $class="badge badge-inverse";
                        break;
                    default:
                        $Status='Invalid';
                        $class="badge badge-important";
                        break;
                  }
              ?>
            <div class="row-fluid">
            <div class="span12">
              <table  class="table table-bordered with-check">
              <tr><td width="20%">Customer Account #</td><td width="80%"><?php echo $detail_view->accountNumber; ?></td></tr>
              <tr><td>Company Name </td><td><?php echo $detail_view->companyName; ?></td></tr>
              <tr><td>Customer Name </td><td><?php echo $detail_view->firstName." ".$detail_view->lastName; ?></td></tr>
              <tr><td>User Name </td><td><?php echo $detail_view->user_name; ?></td></tr>
              <tr><td>Email Address </td><td><?php echo $detail_view->email; ?></td></tr>
              <tr><td>Alternate Email Address </td><td><?php echo $detail_view->email2; ?></td></tr>
              <tr><td>Phone </td><td><?php echo $detail_view->phone; ?></td></tr>
              <tr><td>Mobile Number 1</td><td><?php echo $detail_view->mobileNumber1; ?></td></tr>
              <tr><td>Mobile Number 1</td><td><?php echo $detail_view->mobileNumber2; ?></td></tr>
              <tr><td>Contact Person</td><td><?php echo $detail_view->contactPerson; ?></td></tr>
              <tr><td>Address Line 1 </td><td><?php echo $detail_view->addressLine1; ?></td></tr>
              <tr><td>Address Line 2 </td><td><?php echo $detail_view->addressLine2; ?></td></tr>
              <tr><td>Branch Name </td><td><?php echo $detail_view->branch_name; ?></td></tr>
              <tr><td>Country </td><td><?php echo $detail_view->country; ?></td></tr>
              <tr><td>State / Province </td><td><?php echo $detail_view->state; ?></td></tr>
              <tr><td>City </td><td><?php echo $detail_view->city; ?></td></tr>
              <tr><td>Zip Code</td><td><?php echo $detail_view->zipCode; ?></td></tr>
              <tr><td>Created at </td><td><?php echo $detail_view->created_date; ?></td></tr>
              <tr><td>Created By </td><td><?php echo $detail_view->created_name; ?></td></tr>
              <tr><td>Modified at </td><td><?php echo $detail_view->modified_date; ?></td></tr>
              <tr><td>Modified By </td><td><?php echo $detail_view->modify_name; ?></td></tr>
              <tr><td>Status </td>
                  <td>
                    <span class="<?php echo $class; ?>"><?php echo $Status; ?></span>
                  </td>
              </tr>
               </table>
            </div>
            </div>
          <?php }?>
        </div>
      </div>
    </div>
  </div>
</div>
<!--end-main-container-part