<style>
.datepicker{z-index:1151 !important;}
</style>
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
  <a href="<?php echo base_url(); ?>add-open-balance"><button class="btn btn-info pull-left" type="button" style="margin:5px;"><i class="icon-abc-alt"></i> Account Opening Balance</button></a>
  
  <a href="<?php echo base_url(); ?>add-credit-balance"><button class="btn btn-info pull-left" type="button" style="margin:5px;"><i class="icon-abc-alt"></i> Credit Note</button></a>
  
  <a href="<?php echo base_url(); ?>add-payment-balance"><button class="btn btn-info pull-left"  type="button" style="margin:5px;"><i class="icon-abc-alt"></i> Post Payment</button></a>
   <?php
      if(access_control_apx('ship_manage','Excel')==true){?>
      <button class="btn btn-info pull-right" id="ledger_excel" type="button" style="margin:5px;"><i class="icon-download-alt"></i> Excel</button>
      <?php }?>
      <?php
      if(access_control_apx('ship_manage','Pdf')==true){?>
      <button class="btn btn-danger pull-right" id="ledger_pdf" type="button" style="margin:5px;"><i class="icon-download-alt"></i> Pdf</button>
      <?php }?>
  </div>
  </div>
    <div class="row-fluid">
      <div class="span12">
      <?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message');} ?>
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5><?php if(isset($title)){echo $title;} ?></h5>
            <span class="span2 pull-left" style="margin-top: 5px;">

            <select id="group_select" name="group_action">
            <?php if(isset($customer) && !empty($customer)){
                echo '<option value="Error">-Select Account-</option>';
                foreach ($customer as $key => $value) {
                  if(($this->session->userdata('acc_session')) && ($this->session->userdata('acc_session')==$value->accountNumber)){
                  $selected='selected="selected"';
                  }else{
                    $selected='';
                  }
                  echo '<option '.$selected.' value="'.$value->accountNumber.'">'.$value->companyName.'</option>';
                }
             }
            ?>
            </select>
            </span>

            <span class="span2"><input type="text" name="from_date" id="from_date" class="datepicker span12" style="margin:5px;"/></span><span class="span2"><input type="text" name="to_date" id="to_date" class="datepicker span12" style="margin:5px;"></span>
            <span class="span3">

            <input type="button" name="dtrange" id="dtrange" class="btn btn-default" value="Search" style="margin:5px;">
            <input type="button" name="reset pull-right" id="reset" class="btn btn-default" value="Reset" style="margin:5px;">
            </span>
          </div>
          <div class="widget-content nopadding">
            <table  class="table table-bordered  with-check" id="ledger_table">
              <thead>
                <tr>
                  <th width="5%">Sr. no</th>
                  <th>Date</th>
                  <th>Awb Number</th>
                  <th>Account Number</th>
                  <th>Payment Type</th>
                  <th>Description</th>
                  <th>Country</th>
                  <th>Service</th>
                  <th>Shipment Type</th>
                  <th>Weight</th>
                  <th>Pcs</th>
                  <th>Debit</th>
                  <th>Credit</th>
                  <th>Balance</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <!--load data by ajax-->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--end-main-container-part-->
<!-- Modal -->
<div id="opnModel" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Opening balance</h4>
      </div>
      <div class="modal-body" id="opnModel_body">
          <!--loading ajax-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" aria-hidden="true" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>