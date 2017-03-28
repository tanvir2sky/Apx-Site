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
            <table  class="table table-bordered  with-check" id="ship_table">
              <thead>
                <tr>
                 <th width="3%"><input type="checkbox" id="title-table-checkbox" name="title-table-checkbox" /></th>
                  <th width="7%">Sr. no</th>
                  <th>Air Way Bill #</th>
                  <th>Account Number</th>
                  <th>Shipper Company</th>
                  <th>Receiver Company</th>
                  <th width="12%">Service</th>
                  <th>Balance</th>
                  <th>Status</th>
                  <th width="18%">Action</th>
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